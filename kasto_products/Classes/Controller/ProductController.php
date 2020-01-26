<?php
namespace Media711\KastoProducts\Controller;

use Media711\KastoProducts\Domain\Model\Product;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

use Media711\KastoProducts\Domain\Repository\ProductRepository;
use Media711\KastoProducts\Domain\Repository\AttributeValueRepository;
use Media711\KastoProducts\Domain\Repository\TableRepository;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * ProductController
 */
class ProductController extends ActionController
{

    /**
     * productRepository
     *
     * @var \Media711\KastoProducts\Domain\Repository\ProductRepository $productRepository
     */
    protected $productRepository = null;

    /**
     * @var  \Media711\KastoProducts\Domain\Repository\AttributeValueRepository
     */
    protected $attributeValuesRepository;

    /**
     * @var  \Media711\KastoProducts\Domain\Repository\TableRepository
     */
    protected $tableRepository;

    /**
     * @param \Media711\KastoProducts\Domain\Repository\ProductRepository $productRepository
     */
    public function injectProductRepository(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Repository\AttributeValueRepository $attributeValuesRepository
     */
    public function injectAttributeValueRepository(AttributeValueRepository $attributeValuesRepository)
    {
        $this->attributeValuesRepository = $attributeValuesRepository;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Repository\TableRepository $tableRepository
     */
    public function injectTableRepository(TableRepository $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    /**
     * Initialize view
     *
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view
     */
    public function initializeView(ViewInterface $view)
    {
        $view->assign('data', $this->configurationManager->getContentObject()->data);
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $result = [];

        // get stored page value from cookie
        $sessionPage = (int)$GLOBALS['TSFE']->fe_user->getKey('ses', 'kasto_products_page');
        $limit = $sessionPage ? ($this->settings['itemsPerPage'] * $sessionPage) : $this->settings['itemsPerPage'];

        if (!empty((int)$this->settings['type'])) {
            $result = $this->productRepository->findByTypeAndIsUsed(
                $this->settings['type'],
                $this->settings['isUsed'],
                $limit
            );
        }

        $this->view->assign('sawMachinesFilters', $this->buildSawFilters());
        $this->view->assign('products', $result['products']);
        $this->view->assign('isLast', $result['isLast']);
    }

    /**
     * action detail
     *
     * @param \Media711\KastoProducts\Domain\Model\Product $product
     * @return void
     */
    public function detailAction(Product $product)
    {
        // SEO stuff
        $this->objectManager->get(PageRenderer::class)->setTitle(
            $product->getTitle() . ' - ' .
            LocalizationUtility::translate(
                'LLL:EXT:kasto_content/Resources/Private/Language/locallang.xlf:main_site.title',
                $this->request->getPluginName()
            )
        );

        $this->response->addAdditionalHeaderData(
            '<meta name="description" content="' . $product->getTitle() . '. '
            . substr(strip_tags($product->getDescriptionLong()), 0, 170) . '"/>'
        );

        // fix to handle incorrect localization of table inline records
        if ($product->getLocalizedUid() && ($product->getUid() != $product->getLocalizedUid())) {
            /** var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Table> $tables */
            $tables = $this->fillOjectStorageFromQueryResult($this->tableRepository->findByProduct($product->getLocalizedUid()));
            $product->setTables($tables);
        }

        $this->view->assign('product', $product);
    }

    /**
     * action pdf
     *
     * @param \Media711\KastoProducts\Domain\Model\Product $product
     * @return void
     */
    public function pdfAction(Product $product)
    {
        $this->view->assign('product', $product);

        // generate PDF from rendered HTML
        try {
            $html2pdf = new Html2Pdf('P', 'A4', $GLOBALS['TSFE']->config['config']['language'] ?? 'de');
            //$html2pdf->setModeDebug();
            $html2pdf->setDefaultFont('Arial');
            // temporary disable image test
            $html2pdf->setTestIsImage(false);
            $html2pdf->pdf->SetTitle($product->getTitle());
            $html2pdf->writeHTML($this->view->render());

            $fileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '-', $product->getTitle()) . '.pdf';
            echo $html2pdf->output($fileName, 'D');
            exit;
        } catch (Html2PdfException $e) {
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }

    /**
     * action tabs, view for kastoWin sub-site
     */
    public function tabsAction()
    {
        //$products = $this->productRepository->findProductsFromList($this->settings['tabsSawMachines']);
        //TODO: hot fix before go live, should be removed in new versions
        foreach (explode(',', $this->settings['tabsSawMachines']) as $productUid) {
            $product = $this->productRepository->findByUid($productUid);
            if ($product) {
                // fix to handle incorrect localization of table inline records
                if ($product->getLocalizedUid() && ($product->getUid() != $product->getLocalizedUid())) {
                    /** var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Table> $tables */
                    $tables = $this->fillOjectStorageFromQueryResult($this->tableRepository->findByProduct($product->getLocalizedUid()));
                    $product->setTables($tables);
                }
                $products[] = $product;
            }
        }

        $this->view->assign('products', $products ?? []);
    }

    /**
     * build saw machines filters by static attributes
     *
     * @return array
     */
    public function buildSawFilters()
    {
        // list of attributes by which user could filter products
        $filtersAttributes = [
            ['cutting_option', 'cut_count', 'material'],
            ['material_width', 'material_height', 'material_diameter', 'material_square', 'cut_width', 'cut_length']
        ];

        foreach ($filtersAttributes as $filterKey => $attributes) {
            foreach ($attributes as $attr) {
                $groupedFilters[$filterKey][$attr] = $this->attributeValuesRepository->findByAttribute($attr)->toArray();
            }
        }

        return $groupedFilters ?? [];
    }

    /**
     * ajax load more action
     *
     * @return string
     */
    public function ajaxLoadMoreAction()
    {
        $response = [];
        $page     = $this->request->hasArgument('page') ? (int)$this->request->getArgument('page') : null;

        // get stored page value from cookie
        $sessionPage = $GLOBALS['TSFE']->fe_user->getKey('ses', 'kasto_products_page');

        if (($sessionPage > 1) && ($sessionPage > $page)) {
            $page = $sessionPage;
        }

        // store new page value in session cookie
        if ($page) {
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'kasto_products_page', ($page+1));
            $GLOBALS['TSFE']->fe_user->storeSessionData();
        }

        if ($page) {
            $response = $this->productRepository->findByTypeAndIsUsed(
                $this->settings['type'],
                $this->settings['isUsed'],
                $this->settings['itemsPerPage'],
                $page
            );

            $this->view->assignMultiple([
                'products' => $response['products'],
            ]);
        }

        return json_encode([
            'html'   => $this->view->render(),
            'isLast' => $response['isLast'],
            'page'   => $page + 1
        ]);
    }

    /**
     * ajax saw machines filter action
     *
     * filter products
     */
    public function ajaxSawMachinesFilterAction()
    {
        $filters = $this->request->hasArgument('filters') ? $this->request->getArgument('filters') : null;
        $page    = $this->request->hasArgument('page') ? (int)$this->request->getArgument('page') : null;

        if (!empty($filters)) {
            $result = $this->productRepository->filterSawMachinesByAttr(
                $filters,
                $this->settings['type'],
                $this->settings['isUsed'],
                $this->settings['itemsPerPage'],
                $page
            );
        } else {
            $result = $this->productRepository->findByTypeAndIsUsed(
                $this->settings['type'],
                $this->settings['isUsed'],
                $this->settings['itemsPerPage'],
                $page
            );
        }

        $this->view->assignMultiple([
            'products' => $result['products'],
        ]);

        return json_encode([
            'html'   => $this->view->render(),
            'isLast' => $result['isLast'],
            'page'   => $page + 1
        ]);
    }

    /**
     * Fill objectStorage from QueryResult
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    protected function fillOjectStorageFromQueryResult(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult = null)
    {
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

        if (null!==$queryResult) {
            foreach ($queryResult as $object) {
                $objectStorage->attach($object);
            }
        }

        return $objectStorage;
    }
}
