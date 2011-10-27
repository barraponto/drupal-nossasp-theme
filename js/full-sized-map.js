(function ($) {

  Drupal.behaviors.fullsizedmap = function(context) {
    $map = $('body.front .openlayers-map', context);
    $sidebartop = $('#block-block-2', context);
    $sidebarcontent = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744, #block-block-6', context);
    $sidebarbottom = $('#block-block-3', context);
    $header = $('#header', context);

    $(window).resize(
      function(context) {
        $map.height($(window).height() - $header.height() + 'px');
        $sidebarcontent.height($(window).height() - (2 * $header.height() + $sidebartop.height() + $sidebarbottom.height()) + 'px');
      } );

    $map.addClass('full-sized');

    $(window).resize();
  } } )(jQuery);
