(function ($) {

  Drupal.behaviors.fullsizedmap = function(context) {
    $map = $('body.front .openlayers-map, .sidebar', context);
    $header = $('#header', context);

    $sidebartop = $('#block-block-2', context);
    $sidebarcontent = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744, #block-block-6', context);
    $sidebarbottom = $('#block-nossasp_contexts-0', context);

    $resultstop = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-header', context);
    $resultscontent = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-content', context);
    $resultsbottom = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .item-list', context);

    $(window).resize(
      function(context) {
        $map.height($(window).height() - $header.height() - 2 + 'px');

        $sidebarcontent.height($(window).height() - ($header.height() + $sidebartop.height() + $sidebarbottom.height()) - 22 + 'px');
        $resultscontent.height($sidebarcontent.height() - ($resultstop.height() + $resultsbottom.height()));
      } );

    $map.addClass('full-sized');

    $(window).resize();
  } } )(jQuery);
