(function($) {

  $.fn.konami = function(callback, code) {
    if(code == undefined) code = "38,38,40,40,37,39,37,39,66,65";
    
    return this.each(function() {
      var kkeys = [];
      $(this).keydown(function(e){
        kkeys.push( e.keyCode );
        while (kkeys.length > code.split(',').length) {
          kkeys.shift();
        }
        if ( kkeys.toString().indexOf( code ) >= 0 ){
          $(this).unbind('keydown', arguments.callee);
          callback(e);
        }
      });
});
}

})(jQuery);


$(document).ready(function() {
  
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
    yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['fr']);

  $('.date').datepicker();

  $(window).konami(function(){ 
    $('body').append('<div class="modal fade" id="konamiMod"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h3>Good job /b/ro !</h3></div><div class="modal-body"><p>Bien joué ! Tu a trouvé un Easter Egg !<br />Va-tu trouver les autres....<br />Surtout, ne dit a personne que tu est venu ici. Ca restera notre petit secret ;)</p></div><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Fermer</a></div></div>');
    $('#konamiMod').modal("show");
  });
});