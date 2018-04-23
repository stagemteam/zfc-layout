StagemDatePicker = {
  body: $('body'),

  onlyOnce: {},

	datePickerTimeOptions: {
		language: 'en',
		startDate: new Date(),
		bootcssVer: 3,
		todayHighlight: 1,
		weekStart: 1,
		todayBtn: 1,
		autoclose: true,
		startView: 2,
		minView: 0,
		maxView: 1,
		forceParse: 0,
		format: 'yyyy-mm-dd HH:ii',
		pickerPosition: "top-right"
	},

	datePickerOptions : {
		//todayBtn:  1,
		language:  'en',
		bootcssVer: 3,
		weekStart: 1,
		autoclose: true,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		format: 'yyyy-mm-dd',
    linkFormat: 'yyyy-mm-dd 00:00:00', // this is important for jGrid filtration. If this is redundant move to jGrid configuration
    pickerPosition: "bottom-left"
		//String. Default: 'bottom-right' (supported values are: 'bottom-right', 'bottom-left', 'top-right', 'top-left')
	},

	attachEvents: function () {
		this.datetimepicker();
		this.datepicker();
		this.attachActivateDatePickerFocus();
	},

  attachActivateDatePickerFocus: function () {
    // Remove handler from existing elements
    this.body.off('focus', '.datepicker', this.activateDatePickerFocus);

    // Re-add event handler for all matching elements
    this.body.on('focus', '.datepicker', this.activateDatePickerFocus);
  },

	datetimepicker: function () {
		$('.datetimepicker').datetimepicker(this.datePickerTimeOptions);
	},
	datepicker: function () {
		$('.datepicker').datetimepicker(this.datePickerOptions);
	},

  /**
   * In most cases, this is related to jGrid but can be some specific exclusion
   */
  activateDatePickerFocus: function () {
    // @see https://stackoverflow.com/a/16885042/1335142
    // dynamic elements
    var self = StagemDatePicker;
    if (self.onlyOnce['focusOnce'] === undefined) {
      self.onlyOnce['focusOnce'] = true;

      var elm = $(this);
      var clone = elm.clone();
      clone.insertAfter(this);
      clone.hide();

      StagemDatePicker.datePickerOptions['linkField'] = clone.attr('id'); // @todo merge instead of replace

      // Rename the original field, used to contain the display value
      elm.attr('id', elm.attr('id') + '-display');
      elm.attr('name', elm.attr('name') + '-display');
      elm.datetimepicker(StagemDatePicker.datePickerOptions);
    }
  }

};

jQuery(document).ready(function ($) {
	StagemDatePicker.attachEvents();

	/*$(document).on('shown.bs.modal', function (e) {
		AgereDatePicker.attachEvents(); // reattach print barcode button
	});*/

});