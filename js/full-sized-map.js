(function ($) {

  Drupal.behaviors.fullsizedmap = function(context) {
	
    $map = $('body.front .openlayers-map', context);
    $header = $('#header', context);

    $sidebarResults = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744', context);
    $sidebarResultsTop = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-header', context);
    $sidebarResultsContent = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-content', context);
    $sidebarResultsBottom = $('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .item-list', context);

    $sidebarAbout = $('#block-boxes-nossasp_contexts_about', context);
    $sidebarAboutTop = $('#block-boxes-nossasp_contexts_about .title', context);
  	$sidebarAboutContent = $('#block-boxes-nossasp_contexts_about .content', context);

    $sidebarRegister = $('#block-nossasp_contexts-0', context);

    $(window).resize(
      function(context) {
        $map.height($(window).height() - $header.height() - 2 + 'px');

        $sidebarAbout.height($(window).height() - ($header.height() + $sidebarRegister.height()) - 2 + 'px');
        $sidebarAboutContent.height($sidebarAbout.height() - $sidebarAboutTop.height() - 20 + 'px');

        if ($sidebarResults.length != 0) {
          $sidebarAbout.height($(window).height() - ($header.height() + $sidebarRegister.height()) - 4 + 'px');
          $sidebarAboutContent.height($sidebarAbout.height() - $sidebarAboutTop.height() - $sidebarResultsTop.height() - 22 + 'px');
          $sidebarResults.height($sidebarAboutContent.height() + 'px');
          $sidebarResultsContent.height($sidebarResults.height() - $sidebarResultsBottom.height());
          $sidebarAbout.height('');
          $sidebarResults.height('');
        }

      } );
	
    $map.addClass('full-sized');
	
//	$sidebarOqueE.height(0px);
	
    $(window).resize();

  } } )(jQuery);
