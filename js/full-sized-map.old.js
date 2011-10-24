(function ($) {

  var resizemap = function(context) {
    $map = $('.openlayers-map.openlayers-preset-nossasp_search', context);
    $sidebar = $('.region-sidebar-first .section', context);
    $header = $('#header', context);

    $map.height($(window).height() - $header.height() + 'px');
  }

	Drupal.behaviors.fullsizedmap = function(context) {
    resizemap(context);
		$(window).resize(resizemap(context));
 	} } )(jQuery);
