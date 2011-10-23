Drupal.behaviors.fullsizedmap = function() {
  $(window).resize(function(){
    $map = $('#openlayers-map-auto-id-0');
    $sidebar = $('.region-sidebar-first .section');
    $header = $('#header');
    
    $map.height($(window).height() - $header.height() + 'px');
    console.log($map.height());
  });
    $map = $('#openlayers-map-auto-id-0');
    $sidebar = $('.region-sidebar-first .section');
    $header = $('#header');
    
    $map.height($(window).height() - $header.height() + 'px');
    console.log($map.height());
}

