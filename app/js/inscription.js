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

  $('.well form.span11').click(function(e){
    if($(e.target).is('a')){
      var query = $('input', this).val;
      console.log('Query send ! to '+$(e.target).attr("href"));
      $.post($(e.target).attr("href"), { 'query': query}, function(data){
        console.log(data);
      }, 'json');
      //console.log($('input', this).val());
      e.preventDefault();
    }

  });
});