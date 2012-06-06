$(document).ready(function() {
  
  
  /*$('.detailBtn').click(function (e) {
    var href = $(this).attr("href");
    var eventIdArray = href.split('-');
    eventId = eventIdArray[1];
    var indexA = $('.detailBtn').index(this);
    
    $('.ajaxCont:eq('+indexA+')').load(href+'-ajax .detail', function() {
      $('#myModal'+eventId).modal('show');
      
      $('.ajaxCont .modal-footer .inscrire').click(function(e) {
        if(!$(this).hasClass("inscrit")){
          /* Mettre ici l'ajax pour l'inscription
          $(this).html('<span style="display: none;">Inscrit</span>');
          $('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>Se désinscrire</span>');});
          $(this).addClass("inscrit");
          }
        
        else{
          /* Mettre ici l'ajax pour la déinscription 
          $(this).html('<span style="display: none;">Désinscrit</span>');
          $('span',this).fadeIn(1000, function() {$('.modal .modal-footer .inscrire').html('<span>S\'inscrire</span>');});
          $(this).removeClass("inscrit");
        }
        e.preventDefault();
      });
    });
    
    e.preventDefault();
  });*/
  
  $.datepicker.regional['fr'] = {
    closeText: 'Fermer',
    prevText: '&#x3c;Préc',
    nextText: 'Suiv&#x3e;',
    currentText: 'Courant',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
    'Jul','Aoû','Sep','Oct','Nov','Déc'],
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
    weekHeader: 'Sm',
    dateFormat: 'DD d MM yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
  $.datepicker.setDefaults($.datepicker.regional['fr']);

   $('#input_eventDate').datepicker();
});