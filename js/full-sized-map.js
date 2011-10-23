(function ($) {

  Drupal.behaviors.fullsizedmap = function(context) {
    $map = $('.openlayers-map.openlayers-preset-nossasp_search', context);
    $sidebar = $('.region-sidebar-first .section', context);
    $header = $('#header', context);

    $(window).resize(
      function(context) {
        $map.height($(window).height() - $header.height() + 'px'); } );

    $(window).resize();
  } } )(jQuery);
