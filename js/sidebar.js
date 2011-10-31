$(document).ready(function() {
  
	$('#block-boxes-nossasp_contexts_about .title').click(function() {
		$('#block-boxes-nossasp_contexts_about .content').toggle("slow");
		$('.content .view-content').toggle("slow");
		$('.item-list').toggle("slow");
	});

	$('.view-header').click(function () {
		$('#block-boxes-nossasp_contexts_about .content').toggle("slow");
		$('.content .view-content').toggle("slow");
		$('.item-list').toggle("slow");
	});
});
