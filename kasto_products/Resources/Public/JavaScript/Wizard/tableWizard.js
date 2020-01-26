;(function ($) {
  $('body').on('click', '.product-table-wizard', function (e) {
    e.preventDefault();

    var parentOfToggledButton = $(this).parent('.form-wizards-items-aside');
    var wizardModalWrapper    = parentOfToggledButton.siblings('.modal');
    var expectedElement       = parentOfToggledButton.parent('.form-wizards-wrap').find('.table-wizard-textarea');

    /**
     * Condition for existing textarea in technical data element
     */
    if (!expectedElement.length)  return;

    var textareaEnterContent = expectedElement.html();
    var table                = '';
    var tableHeader          = '<table class="table-wizard table table-bordered table-hover"><colgroup><col class="col-sm-5">' +
                               '<col class="col-sm-5"><col class="col-sm-2"></colgroup>'+
                               '<thead><tr><td>Attribute</td><td>Value</td><td></td></tr></thead><tbody><tr>';
    var tableEditing         = '<span class="edit-values btn btn-default">Edit</span>  ' +
                               '<span class="save-values btn btn-default hidden">Save</span>  ' +
                               '<span class="delete-values btn btn-danger">Delete</span>';
    var modalBody            = wizardModalWrapper.find('.modal-body');

    /**
     * Checking for existing technical characteristics of element
     */
    if (textareaEnterContent.length) {
      /**
       * Cropping existing lines into array of strings
       */
      var characteristicLines = textareaEnterContent.split(/\r\n|\r|\n/g);
      var newObj              = {};

      /**
       *
       * @type {string}
       * Creating table with existing data
       */
      table += tableHeader;

      for (var i = 0; i < characteristicLines.length; i++) {
        newObj[i]  = characteristicLines[i].split(' | ');

        table     += '<td>' + newObj[i][0] + '</td><td>' + newObj[i][1] + '</td>';
        table     += '<td>' + tableEditing + '</td></tr>';
      }

      table += '</tbody></table>';
      table += '<span class="create-new-row btn btn-lg btn-default">+</span>';

      modalBody.html(table);
    } else {
      /**
       *
       * @type {string}
       * Creating table if no values in textarea
       */
      table += tableHeader;
      table += '<td><input type="text" /> </td>';
      table += '<td><input type="text" /> </td>';
      table += '<td>' + tableEditing + '</td></tr></tbody></table>';

      modalBody.html(table);
      modalBody.append('<span class="create-new-row btn-lg btn btn-default hidden">+</span>');

      var currentCreatedRow = wizardModalWrapper.find('.table-wizard tbody td');

      cellValueSaving(currentCreatedRow.eq(1), currentCreatedRow.eq(1).find('input'));
      cellValueSaving(currentCreatedRow.eq(0), currentCreatedRow.eq(0).find('input'));
    }

    /**
     *
     * @param index
     *
     *  Deletes row with current index from displayed table
     */
    deleteCell = function(index) {
      var currentTable = wizardModalWrapper.find('.table-wizard')[0];
      currentTable.deleteRow(index);
    };

    /**
     *
     * @param element
     *
     *  Changing usual text-content to input with same value
     */
    changingToInputCell = function (element) {
      var originalContent = element.text();

      element.addClass('cellEditing');
      element.html('<input type="text" value="' + originalContent + '" />');
    };

    /**
     *
     * @param parentRow
     *
     * Action that is performed when clicking on edit-button
     * calling function that is saving data from input
     */
    editingCell = function(parentRow) {
      var secondCell    = $(parentRow.find('td')[1]);
      var firstCell     = $(parentRow.find('td')[0]);

      changingToInputCell(secondCell);
      changingToInputCell(firstCell);

      cellValueSaving(secondCell, secondCell.find('input'));
      cellValueSaving(firstCell, firstCell.find('input'));
    };

    var newText = '';

    /**
     *  Parsing table back to textarea -- saving edited and added values
     */
    wizardModalWrapper.find('.save-table').click(function () {
      var tableSaveRow  = wizardModalWrapper.find('table tbody tr');
      var newTextObject = [];
      var unfocused     = tableSaveRow.find('input');

      if (unfocused.length) {
        unfocused.trigger('focusout');
      }

      tableSaveRow.each(function () {
        var innerCells = $(this).children('td:not(:last-child)');
        newText = innerCells.first().html() + ' | ' + innerCells.last().html();
        newTextObject.push(newText);
      });

      var newTextareaContent = newTextObject.join('\n');

      expectedElement.html(newTextareaContent);
    });

    /**
     *  Initializing Drag and Drop for table rows
     *
     * @type {*}
     */
    var tableDnD = $(".table-wizard tbody");

    tableDnD.tableDnD();
  });

  /**
   *  Saving entered value on moving focus out from element or pressing enter
    */
  cellValueSaving = function (element, input) {
    input.keypress(function (e) {
      if (e.which == 13) {
        var newContent = input.val();

        element.text(newContent);
        element.removeClass('cellEditing');
      }
    });

    element.on('focusout', function () {
      var newContent = input.val();

      element.text(newContent);
      element.removeClass('cellEditing');

      if (!element.siblings('td').find('input').length) {
        element.siblings('td').find('.save-values').addClass('hidden');
        element.siblings('td').find('.edit-values').removeClass('hidden');
      }
    });
  };

  /**
   *    Setting handlers for editing, adding and deleting functions
   */
  $(document).ajaxComplete(function() {
    $('.product-table-wizard').unbind().one('click', function() {
      var wrapperModal = $(this).parent().siblings('.modal');
      var modalBody    = wrapperModal.find('.modal-body');

      if (!wrapperModal.length) return;

      wrapperModal.unbind().on('click', '.create-new-row',  function (e) {
        $(this).addClass('hidden');
        var newTable = $(wrapperModal.find('.table-wizard'));
        var row      = newTable[0].insertRow(-1);
        var cell1    = row.insertCell(0);
        var cell2    = row.insertCell(1);
        var cell3    = row.insertCell(2);

        cell1.className = 'cellEditing';
        cell2.className = 'cellEditing';
        cell1.innerHTML = '<input type="text" /> ';
        cell2.innerHTML = '<input type="text" /> ';
        cell3.innerHTML = '<span class="edit-values btn btn-default hidden">Edit </span>  ' +
                          '<span class="save-values btn btn-default">Save</span>  ' +
                          '<span class="delete-values btn btn-danger">Delete</span>';

        var currentCreatedRow = wrapperModal.find('.table-wizard tbody tr').last();
        var currentCells      = currentCreatedRow.find('td');

        cellValueSaving(currentCells.eq(1), currentCells.eq(1).find('input'));
        cellValueSaving(currentCells.eq(0), currentCells.eq(0).find('input'));

        newTable.tableDnD();
      });

      wrapperModal.on('click', '.edit-values', (function (e) {
        var button = $(this);

        button.parents('table').find('input').trigger('focusout');
        button.addClass('hidden');
        button.next().removeClass('hidden');

        editingCell(button.parents('tr'));
      }));

      wrapperModal.on('click', '.delete-values', (function (e) {
        var parentRow = $(this).parents('tr');

        deleteCell(parentRow.index() + 1);
      }));

      wrapperModal.on('click', '.discard-changes', (function () {
        modalBody.html('');
      }));

      wrapperModal.on('click', '.save-values', (function () {
       $(this).parents('tr').find('input').focusout();
      }));

      /**
       *  When clicking on row in table, values in another rows from input are converting to cell-text
       */
      wrapperModal.on("click", "tr", function(e) {
        var index = $(e.currentTarget).index() + 1;

        wrapperModal.find('tr').not(':eq(' + index + ')').find('input').focusout();
      });

      wrapperModal.on('click', function(e) {
        var buttonNewRow = $('.create-new-row');
        var target       = $(e.target);

        /**
         *  When clicking on modal-window and there is now empty input and
         *  button to create new row is hidden, displaying it
         */
        if (buttonNewRow.hasClass('hidden') && wrapperModal.find('tr input').length == 0)
          buttonNewRow.removeClass('hidden');

        /**
         *  When clicking outside table and not new-row-button, values are converted from input to cell-text
         */
        if (target !== $('.table-wizard') && !target.is('.create-new-row') && !target.parents('.table-wizard').length) {
          wrapperModal.find('tr input').focusout();
        }

        /**
         *  Closing modal window if clicked outside modal-window, because data-backdrop isn't working
         */
        if (target !== $('.modal-content') && !target.parents('.modal-content').length && !target.is('.delete-values')) {
          $(wrapperModal).modal('hide');
        }

        /**
         *  Checking if there is row without data and removing it
         *
         * @type {*}
         */
        var tableRows = $('.table-wizard tbody').find('tr');

        tableRows.each(function () {
          var $this = $(this);
          var cell  = $this.find('td:not(:last-child)');
          var count = cell.eq(0).html().length + cell.eq(1).html().length;

          if (count) return;

          deleteCell($this.index() + 1);
          buttonNewRow.removeClass('hidden');
        })
      });
    });
  });

})(TYPO3.jQuery || jQuery);