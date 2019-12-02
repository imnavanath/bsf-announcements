(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	// Single TR field hide / show support
    $(function() {
		$('input.parent-depend-meta-row').change(function(){
			var table_advance_data = $(this).closest('tr').next('tr.ultimate-portfolio-row');
			if( $(this).attr('checked') ) {
				table_advance_data.show();
			} else {
				table_advance_data.hide();
			}
		});
	});

	// Tooltip admin support
    $(function() {
		$('.portfolio-field-help').hover(function(){
			var tip_wrap = $(this).closest('.ultimate-portfolio-row');
			closest_tooltip = tip_wrap.find('.portfolio-tooltip-text');
			closest_tooltip.toggleClass('display_tool_tip');
	    });
	});

})( jQuery );
