
(function($){

$.widget( "ui.searchmenu", {
	options:{
		position: {
			my: "left top+15",
			at: "left bottom",
			collision: "flipfit flip"
		},
		hide: true,
		tooltipClass: null,
		close:null,//callbacks
		open:null,
	}
});
	
}(jQuery));