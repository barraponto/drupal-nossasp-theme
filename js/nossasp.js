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
