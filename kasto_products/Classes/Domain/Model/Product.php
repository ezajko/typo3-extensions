<?php
namespace Media711\KastoProducts\Domain\Model;

use Media711\KastoContacts\Domain\Model\Contact;
use Media711\KastoProducts\Domain\Repository\AttributeValueRepository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Product extends AbstractEntity
{
    /**
     * @var \Media711\KastoProducts\Domain\Repository\AttributeValueRepository
     */
    protected $attributeValuesRepository;

    /**
     * @param \Media711\KastoProducts\Domain\Repository\AttributeValueRepository $attributeValuesRepository
     */
    public function injectAttributeValueRepository(AttributeValueRepository $attributeValuesRepository)
    {
        $this->attributeValuesRepository = $attributeValuesRepository;
    }

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @var \Media711\KastoProducts\Domain\Model\Type
     */
    protected $type = null;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $modelSeries;

    /**
     * @var bool
     */
    protected $titleSkipCursive = false;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $systemName;

    /**
     * @var bool
     */
    protected $isUsed = false;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $applicationArea;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $sawType;

    /**
     * @var string
     */
    protected $cuttingOption;

    /**
     * @var string
     */
    protected $cutCount;

    /**
     * @var string
     */
    protected $cuttingArea;

    /**
     * @var string
     */
    protected $cuttingDirection;

    /**
     * @var string
     * @converter \Media711\KastoManager\Export\Generic\AttributeValuesUidListConverter
     */
    protected $material;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $materialWidth;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $materialHeight;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $materialDiameter;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $materialSquare;

    /**
     * @var string
     */
    protected $sawAutomation;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $storageType;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $storageStyle;

    /**
     * @var string
     */
    protected $descriptionShort;

    /**
     * @var string
     */
    protected $descriptionLong;

    /**
     * @var string
     */
    protected $materialShaping;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Table>
     * @dontexport
     */
    protected $tables = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images = null;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $documentBrochure = null;

    /**
     * @var  \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Url>
     */
    protected $videoUrls = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Product>
     */
    protected $addons = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Product>
     */
    protected $services = null;

    /**
     * @var \Media711\KastoContacts\Domain\Model\Contact
     */
    protected $contact = null;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Reference>
     * @cascade remove
     * @dontexport
     */
    protected $relatedReferences = null;

    /**
     * @var string
     */
    protected $variant;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $cutWidth;

    /**
     * @var \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    protected $cutLength;

    /**
     * @var int
     * @dontexport
     */
    protected $sorting;

    /**
     * @var \DateTime
     * @dontexport
     */
    protected $tstamp;

    /**
     * @var \DateTime
     * @dontexport
     */
    protected $crdate;

    /**
     * @var int
     */
    protected $l10nParent = 0;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->addons            = new ObjectStorage();
        $this->services          = new ObjectStorage();
        $this->relatedReferences = new ObjectStorage();
        $this->videoUrls         = new ObjectStorage();
        $this->tables            = new ObjectStorage();
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Type $type
     */
    public function setType(Type $type)
    {
        $this->type = $type;
    }

    /**
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string $alias
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return bool $titleSkipCursive
     */
    public function getTitleSkipCursive()
    {
        return $this->titleSkipCursive;
    }

    /**
     * @param bool $titleSkipCursive
     */
    public function setTitleSkipCursive($titleSkipCursive)
    {
        $this->titleSkipCursive = $titleSkipCursive;
    }

    /**
     * @return bool
     */
    public function isTitleSkipCursive()
    {
        return $this->titleSkipCursive;
    }

    /**
     * @return bool $isUsed
     */
    public function getIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @param bool $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;
    }

    /**
     * @return bool
     */
    public function isIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @return string $descriptionShort
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * @param string $descriptionShort
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }

    /**
     * @return string $descriptionLong
     */
    public function getDescriptionLong()
    {
        return $this->descriptionLong;
    }

    /**
     * @param string $descriptionLong
     */
    public function setDescriptionLong($descriptionLong)
    {
        $this->descriptionLong = $descriptionLong;
    }

    /**
     * @return string $cuttingArea
     */
    public function getCuttingArea()
    {
        return $this->cuttingArea;
    }

    /**
     * @param string $cuttingArea
     */
    public function setCuttingArea($cuttingArea)
    {
        $this->cuttingArea = $cuttingArea;
    }

    /**
     * @return string $cuttingDirection
     */
    public function getCuttingDirection()
    {
        return $this->cuttingDirection;
    }

    /**
     * @param string $cuttingDirection
     */
    public function setCuttingDirection($cuttingDirection)
    {
        $this->cuttingDirection = $cuttingDirection;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $images
     */
    public function setImages(ObjectStorage $images)
    {
        $this->images = $images;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $documentBrochure
     */
    public function getDocumentBrochure()
    {
        return $this->documentBrochure;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $documentBrochure
     */
    public function setDocumentBrochure(FileReference $documentBrochure)
    {
        $this->documentBrochure = $documentBrochure;
    }

    /**
     * @return string
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @param string $variant
     */
    public function setVariant(string $variant)
    {
        $this->variant = $variant;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function getStorageStyle()
    {
        return $this->storageStyle;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $storageStyle
     */
    public function setStorageStyle($storageStyle)
    {
        $this->storageStyle = $storageStyle;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function getStorageType()
    {
        return $this->storageType;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $storageType
     */
    public function setStorageType($storageType)
    {
        $this->storageType = $storageType;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function getModelSeries()
    {
        return $this->modelSeries;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $modelSeries
     */
    public function setModelSeries($modelSeries)
    {
        $this->modelSeries = $modelSeries;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $applicationArea
     */
    public function getApplicationArea()
    {
        return $this->applicationArea;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $applicationArea
     */
    public function setApplicationArea($applicationArea)
    {
        $this->applicationArea = $applicationArea;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $sawType
     */
    public function getSawType()
    {
        return $this->sawType;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $sawType
     */
    public function setSawType($sawType)
    {
        $this->sawType = $sawType;
    }

    /**
     * @return string $cuttingOption
     */
    public function getCuttingOption()
    {
        return $this->cuttingOption;
    }

    /**
     * @param string $cuttingOption
     */
    public function setCuttingOption($cuttingOption)
    {
        $this->cuttingOption = $cuttingOption;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function getCutWidth()
    {
        return $this->cutWidth;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $cutWidth
     */
    public function setCutWidth($cutWidth)
    {
        $this->cutWidth = $cutWidth;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue
     */
    public function getCutLength()
    {
        return $this->cutLength;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $cutLength
     */
    public function setCutLength($cutLength)
    {
        $this->cutLength = $cutLength;
    }

    /**
     * @return string $cutCount
     */
    public function getCutCount()
    {
        return $this->cutCount;
    }

    /**
     * @param string $cutCount
     */
    public function setCutCount($cutCount)
    {
        $this->cutCount = $cutCount;
    }

    /**
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param string $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $materialWidth
     */
    public function getMaterialWidth()
    {
        return $this->materialWidth;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $materialWidth
     */
    public function setMaterialWidth($materialWidth)
    {
        $this->materialWidth = $materialWidth;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $materialHeight
     */
    public function getMaterialHeight()
    {
        return $this->materialHeight;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $materialHeight
     */
    public function setMaterialHeight($materialHeight)
    {
        $this->materialHeight = $materialHeight;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $materialDiameter
     */
    public function getMaterialDiameter()
    {
        return $this->materialDiameter;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $materialDiameter
     */
    public function setMaterialDiameter($materialDiameter)
    {
        $this->materialDiameter = $materialDiameter;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $materialSquare
     */
    public function getMaterialSquare()
    {
        return $this->materialSquare;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $materialSquare
     */
    public function setMaterialSquare($materialSquare)
    {
        $this->materialSquare = $materialSquare;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getSawAutomation()
    {
        return $this->attributeValuesRepository->findAttributesFromList(explode(',', $this->sawAutomation));
    }

    /**
     * @param string $sawAutomation
     */
    public function setSawAutomation($sawAutomation)
    {
        $this->sawAutomation = $sawAutomation;
    }

    /**
     * Returns the materialShaping
     *
     * @return string $materialShaping
     */
    public function getMaterialShaping()
    {
        return $this->materialShaping;
    }

    /**
     * @param string $materialShaping
     */
    public function setMaterialShaping($materialShaping)
    {
        $this->materialShaping = $materialShaping;
    }

    /**
     * @return \Media711\KastoProducts\Domain\Model\AttributeValue $systemName
     */
    public function getSystemName()
    {
        return $this->systemName;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\AttributeValue $systemName
     */
    public function setSystemName($systemName)
    {
        $this->systemName = $systemName;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Product $addon
     */
    public function addAddon(Product $addon)
    {
        $this->addons->attach($addon);
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Product $addonToRemove The Product to be removed
     */
    public function removeAddon(Product $addonToRemove)
    {
        $this->addons->detach($addonToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Product> $addons
     */
    public function getAddons()
    {
        return $this->addons;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $addons
     */
    public function setAddons(ObjectStorage $addons)
    {
        $this->addons = $addons;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Product $service
     */
    public function addService(Product $service)
    {
        $this->services->attach($service);
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Product $serviceToRemove The Product to be removed
     */
    public function removeService(Product $serviceToRemove)
    {
        $this->services->detach($serviceToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Product> $services
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $services
     */
    public function setServices(ObjectStorage $services)
    {
        $this->services = $services;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Reference $relatedReference
     */
    public function addRelatedReference(Reference $relatedReference)
    {
        $this->relatedReferences->attach($relatedReference);
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Reference $relatedReferenceToRemove The Reference to be removed
     */
    public function removeRelatedReference(Reference $relatedReferenceToRemove)
    {
        $this->relatedReferences->detach($relatedReferenceToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Reference> $relatedReferences
     */
    public function getRelatedReferences()
    {
        return $this->relatedReferences;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedReferences
     */
    public function setRelatedReferences(ObjectStorage $relatedReferences)
    {
        $this->relatedReferences = $relatedReferences;
    }

    /**
     * @return \Media711\KastoContacts\Domain\Model\Contact $contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param \Media711\KastoContacts\Domain\Model\Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Url> $videoUrls
     */
    public function getVideoUrls()
    {
        return $this->videoUrls;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $videoUrls
     */
    public function setVideoUrls(ObjectStorage $videoUrls)
    {
        $this->videoUrls = $videoUrls;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Url $videoUrl
     */
    public function addVideoUrl(Url $videoUrl)
    {
        $this->videoUrls->attach($videoUrl);
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Url $videoUrl
     */
    public function removeVideoUrl(Url $videoUrl)
    {
        $this->videoUrls->detach($videoUrl);
    }


    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Media711\KastoProducts\Domain\Model\Table> $tables
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $tables
     */
    public function setTables(ObjectStorage $tables)
    {
        $this->tables = $tables;
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Table $table
     */
    public function addTable(Table $table)
    {
        $this->tables->attach($table);
    }

    /**
     * @param \Media711\KastoProducts\Domain\Model\Table $table The table to be removed
     */
    public function removeTable(Table $table)
    {
        $this->tables->detach($table);
    }

    /**
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting(int $sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param \DateTime $tstamp
     */
    public function setTstamp(\DateTime $tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @param \DateTime $crdate
     */
    public function setCrdate(\DateTime $crdate)
    {
        $this->crdate = $crdate;
    }

    /**
     * @return int
     */
    public function getL10nParent()
    {
        return $this->l10nParent;
    }

    /**
     * @param int $l10nParent
     */
    public function setL10nParent(int $l10nParent)
    {
        $this->l10nParent = $l10nParent;
    }

    /**
     * @return int
     */
    public function getLocalizedUid()
    {
        return $this->_localizedUid;
    }
}
