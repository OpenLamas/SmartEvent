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

  /* Recherche des events */
  $('#search form').click(function(e){
    if($(e.target).is('a')){
      console.log($('input', this).val())
      if($('input', this).val() == ''){
        console.log('pas ok');
        $('div', this).addClass('error');
      }

      else{
        console.log('ok');
        $('div', this).removeClass('error');
        var query = $('input', this).val();
        $('#search table').fadeOut('slow');
        $('#search .noResult').fadeOut('slow');
        $.post($(e.target).attr("href"), { 'query': query }, function(data){
          console.log(data);
          $('#search tbody').empty();
          if(data != ''){
            for(var i=0;i<data.length;i++){
              console.log(data[i]);
              $('#search tbody').append('<tr><td><a href="#">'+data[i]['nomevenement']+'</a></td><td>'+data[i]['descevenement']+'</th><td><span class="badge badge-inverse">'+(data[i]['nbmaxinscritevenement']-data[i]['count'])+' place(s) libres</span></td><td><span class="badge badge-success">Inscrit</span></td></tr>');
            }
            $('#search table').fadeIn('slow');
          }

          else{
            $('#search .noResult').fadeIn('slow');
          }
          
        }, 'json');
      }
      e.preventDefault();
    }

  });

  $("#btngroupe-listevents button").click(function(){
    $('.span9').fadeToggle('slow');
  });
});