$(document).ready(function() {
	$('.modal .modal-footer .inscrire').click(function(e) {
		if(!$(this).hasClass("inscrit")){
			$(this).html('<span style="display: none;">Inscrit</span>');
			$('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>Se désinscrire</span>');});
			$(this).addClass("inscrit");
			}
		
		else{
			$(this).html('<span style="display: none;">Désinscrit</span>');
			$('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>S\'inscrire</span>');});
			$(this).removeClass("inscrit");
		}
		e.preventDefault();
	});
  
  /*$('.detailBtn').click(function (e) {
    var href = $(this).attr("href");
    alert(href);
    $('.ajaxCont').load( href + '.detail', function() {
      
      });
    
    e.preventDefault();
  });
});*/
