(function ($) {

  Drupal.behaviors.nossaspSearchForm = function(context) {

    // workaround: por algum motivo, esse wrapper vem com um display:block
    $('#edit-circle-location-wrapper, context').attr('style', '');

    $('.vew-0 > label', context).click(function() {
      $('.active', context).removeClass('active').find('.form-text').val('');
      $(this).addClass('active');
      $(this).siblings('.views-widget').find('.form-text').addClass('active').focus();
    } );
    $('.vew-1 > label', context).click(function() {
      $('.active', context).removeClass('active').val('');
      $(this).addClass('active');
      $(this).siblings('.views-widget').find('#edit-circle-location-wrapper').addClass('active').children('.form-text').focus();
    } );

    $('.vew-0 > label').click();
  } 

  Drupal.behaviors.nossaspCheckboxes = function(context) { 
    $('#views-exposed-form-nossasp-organizations-map-page-2 .vew-3', context).click(function() {
      $(this).children('.views-widget').toggle(); 
    });

    $('#views-exposed-form-nossasp-organizations-map-page-2 .vew-3 .views-widget', context).hover(
      function(){},
      function() {
      $(this).hide();
    });
  }

	Drupal.behaviors.nossaspOQueEbox = function(context) {
		$('#block-boxes-nossasp_contexts_about .content', context).hide();
		
		if ($('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-header', context).length != 0) {
	    	$('#block-boxes-nossasp_contexts_about .title', context).click(function() {
				$('#block-boxes-nossasp_contexts_about .content',context).toggle("");
				$('.content .view-content', context).toggle("");
				$('.item-list', context).toggle("");
			});

			$('#block-views-ac1d059bc0aeabb5015c2d28f61ba744 .view-header', context).click(function () {
				$('#block-boxes-nossasp_contexts_about .content', context).toggle("");
				$('.content .view-content', context).toggle("");
				$('.item-list', context).toggle("");
			});
	  	} else {
	    	$('#block-boxes-nossasp_contexts_about .content', context).toggle("");
	  	}
	}
	
	
} )(jQuery);

//function area_atuacao(id) {
//  var e = document.getElementById(id);
//  if(e.style.display=='block') {
//    e.style.display = 'none';
//    document.forms['views-exposed-form-nossasp-organizations-map-page-2'].submit();
//  } else {
//    e.style.display = 'block';
//  }
//}
