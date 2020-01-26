// create global dkd object
var dkd = dkd || {};

/**
 * Javascript Application Module
 */
!(function(window, $, dkd) {
  /**
   * @module dkd.application
   */
  dkd.bsbhEventForm = {
    settings: {
      $extensionWrapper: $('.tx-bsbh-events'),
      $form: null,
      $eventTypeSwitch: null,
      $isFullDaySwitch: null,
      $timeInputs: null,
      $markdownTextarea: null,
      $markdownPreviewElement: null,
      $markdownPreviewButton: null,
      $oneTimeFields: null,
      $recurringFields: null
    },

    /**
     * create html representation of markdown input string and attach to $previewElement
     *
     * @param input - the string to convert
     * @param $previewElement
     */
    renderAndAttachMarkdown: function(input, $previewElement) {
      $.getJSON("/?type=110&markdown=" + encodeURIComponent(input), function(
        data
      ) {
        $previewElement.html(data.result);
      });
    },

    /**
     * Set variables for DOM element selectors
     */
    getDomElements: function() {
      this.settings.$form = $(".bsbh-events-new, .bsbh-events-edit");
      this.settings.$markdownPreviewElement = this.getDomElement(
        ".markdown-preview"
      );
      this.settings.$markdownPreviewButton = this.getDomElement(
        ".markdown-preview-button"
      );
      this.settings.$markdownTextarea = this.getDomElement("[data-markdown]");
      this.settings.$oneTimeFields = this.getDomElement(
        "[data-onetime-relevant]"
      );
      this.settings.$recurringFields = this.getDomElement(
        "[data-recurring-relevant]"
      );
      this.settings.$eventTypeSwitch = this.getDomElement(
        "[name=" +
          $.escapeSelector("tx_bsbhevents_show[newEvent][isRepeatingEvent]") +
          "], [name=" +
          $.escapeSelector("tx_bsbhevents_show[event][isRepeatingEvent]") +
          "]"
      );
      this.settings.$isFullDaySwitch = this.getDomElement(
        "#tx_bsbhevents-event-is-full-day"
      );
      this.settings.$timeInputs = this.getDomElement(
        "#eventStartTime, #eventEndTime, .time-label"
      );
    },

    /**
     * Returns jQuery Object for a given selector.
     * Limits the selection to elements in the form.
     *
     * @param selector
     */
    getDomElement: function(selector) {
      return this.settings.$form.find(selector);
    },

    /**
     * Attaches events to several elements of form
     */
    attachEvents: function() {
      var that = this;
      this.settings.$markdownPreviewButton.on("click", function() {
        that.renderAndAttachMarkdown(
          that.settings.$markdownTextarea.val(),
          that.settings.$markdownPreviewElement
        );
      });

      this.settings.$eventTypeSwitch.on("change", function() {
        that.setEventType($(this).val());
      });
      this.settings.$isFullDaySwitch.on("change", function() {
        that.setFullDay($(this).prop("checked"));
      });
    },

    /**
     *  depending on the state of the $isFullDaySwitch
     *  the inputs for start- and -endtime are enabled/disabled
     */
    setFullDay: function(val) {
      // set type of input
      if (val === true) {
        this.settings.$timeInputs.attr("disabled", "disabled");
      } else {
        this.settings.$timeInputs.removeAttr("disabled");
      }
    },

    /**
     *  enables/disables fields for one time events
     */
    showOneTimeOptions: function() {
      this.settings.$recurringFields.attr("disabled", "");
      this.settings.$oneTimeFields.removeAttr("disabled");
    },

    /**
     *  enables/disables fields for one recurring events
     */
    showRecurringOptions: function() {
      this.settings.$recurringFields.removeAttr("disabled");
      this.settings.$oneTimeFields.attr("disabled", "");
    },

    /**
     * sets shown/hidden form fields for given event type
     * 
     * @param val
     */
    setEventType: function(val) {
      switch (val) {
        case undefined:
          this.settings.$recurringFields.attr("disabled", "");
          this.settings.$oneTimeFields.attr("disabled", "");
          break;
        case "0":
          this.showOneTimeOptions();
          break;
        case "1":
          this.showRecurringOptions();
          break;
      }
    },

    /**
     * Calls all needed functions on document ready.
     * @name dkd.bsbhEventForm#initialize
     * @function
     */
    initialize: function() {
      if(!this.settings.$extensionWrapper.length) {
        return false;
      }
      this.getDomElements();
      this.attachEvents();
      this.setEventType(this.settings.$eventTypeSwitch.filter('[checked]').val());
      this.setFullDay(this.settings.$isFullDaySwitch.prop("checked"));
    }
  };
})(window, $, dkd);

if (typeof $ !== "undefined") {
  $(document).ready(function() {
    dkd.bsbhEventForm.initialize();
  });
}
