/* função que mostra/esconde o box do filtro "Área de atuação" */
function area_atuacao(id) {
    var e = document.getElementById(id);
    if(e.style.display=='block') {
        e.style.display = 'none';
        document.forms['views-exposed-form-nossasp-organizations-map-page-2'].submit();
    } else {
        e.style.display = 'block';
    }
}

WebFontConfig = {
          google: { families: [ 'Abel::latin' ] }
            };
              (function() {
                      var wf = document.createElement('script');
                          wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                                '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                                    wf.type = 'text/javascript';
                                        wf.async = 'true';
                                            var s = document.getElementsByTagName('script')[0];
                                                s.parentNode.insertBefore(wf, s);
                                                  })(); </script>
