// create global dkd object
var dkd = dkd || {};

/**
 * Javascript Application Module
 */
!(function(window, $, dkd) {
  /**
   * @module dkd.application
   */
  dkd.bsbhEventList = {
    settings: {
      $listWrapper: $('.tx-bsbh-events__list-view'),
      $deleteButtons: null
    },
    /**
     * Set variables for DOM element selectors
     */
    getDomElements: function() {
        this.settings.$deleteButtons = $('[data-delete-event]');
    },

    attachEvents: function () {
      var link = '#';
      this.settings.$deleteButtons.on('click',function (e) {
        e.preventDefault();
        link = $(e.target).attr('href');
        if(confirm("Eintrag wirklich löschen?")) {
          document.location.href = link;
        }
      });
    },
    /**
     * Calls all needed functions on document ready.
     * @name dkd.bsbhEventList#initialize
     * @function
     */
    initialize: function() {
      if(!this.settings.$listWrapper.length) {
        return false;
      }
      this.getDomElements();
      this.attachEvents();
    }
  };
})(window, $, dkd);

if (typeof $ !== "undefined") {
  $(document).ready(function() {
    dkd.bsbhEventList.initialize();
  });
}
