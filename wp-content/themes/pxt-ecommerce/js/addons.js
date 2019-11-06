(function( $ ) {
	'use strict';
	$(function() {
		var data = {};
		data.pxtPluginsList = 'yes';
		$.ajax({
			url: document.URL,
			cache: false,
			type: "get",
			data: data,
			success: function(response) {
				if( $( response ).find('.pxtt-addons-list').length > 0 ) {
					$('.pxtt-addons-list').replaceWith( $( response ).find('.pxtt-addons-list') );
				}
			}
		});
	});
})( jQuery );