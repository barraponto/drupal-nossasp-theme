(function ($) {

  Drupal.behaviors.fullsizedmap = function(context) {
    $map = $('.openlayers-map.openlayers-preset-nossasp_search', context);
    $sidebar = $('.region-sidebar-first .section', context);
    $sidebarcontent = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744', context);
    $header = $('#header', context);

    $(window).resize(
      function(context) {
        $map.height($(window).height() - $header.height() + 'px');
        $sidebarcontent.height($(window).height() - $header.height() - ($sidebar.height() - $sidebarcontent.height())+ 'px');
      } );

    $map.addClass('full-sized');

    $(window).resize();
  } } )(jQuery);
