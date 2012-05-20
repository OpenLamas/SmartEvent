$(document).ready(function() {
  
  
  $('.detailBtn').click(function (e) {
    var href = $(this).attr("href");
    var eventIdArray = href.split('-');
    eventId = eventIdArray[1];
    var indexA = $('.detailBtn').index(this);
    
    $('.ajaxCont:eq('+indexA+')').load(href+'-ajax .detail', function() {
      $('#myModal'+eventId).modal('show');
      
      $('.ajaxCont .modal-footer .inscrire').click(function(e) {
        if(!$(this).hasClass("inscrit")){
          /* Mettre ici l'ajax pour l'inscription*/
          $(this).html('<span style="display: none;">Inscrit</span>');
          $('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>Se désinscrire</span>');});
          $(this).addClass("inscrit");
          }
        
        else{
          /* Mettre ici l'ajax pour la déinscription */
          $(this).html('<span style="display: none;">Désinscrit</span>');
          $('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>S\'inscrire</span>');});
          $(this).removeClass("inscrit");
        }
        e.preventDefault();
      });
    });
    
    e.preventDefault();
  });
});