(function ($) {

  Drupal.behaviors.nossaspSearchForm = function(context) {

    // workaround: por algum motivo, esse wrapper vem com um display:block
    $('#edit-circle-location-wrapper, context').attr('style', '');

    $('.vew-0 > label, context').click(function() {
      $('.active', context).removeClass('active').find('.form-text').val('');
      $(this).addClass('active');
      $(this).siblings('.views-widget').find('input.form-text').addClass('active').focus();
    } );
    $('.vew-1 > label, context').click(function() {
      $('.active', context).removeClass('active').val('');
      $(this).addClass('active');
      $(this).siblings('.views-widget').find('#edit-circle-location-wrapper').addClass('active').children('.form-text').focus();
    } );

    $('.vew-0 > label').click();
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
