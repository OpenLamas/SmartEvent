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

  $('input.date').datepicker();

  /* Recherche des events */
  var recherche = function(e){
    console.log($('#search form input:first').val())
      if($('#search form input:first').val() == ''){
        console.log('pas ok');
        $('#search form div').addClass('error');
      }

      else{
        console.log('ok');
        $('#search form div').removeClass('error');
        var query = $('#search form input:first').val();
        $('#search table').fadeOut('slow');
        $('#search .noResult').fadeOut('slow');
        $.post("search", { 'query': query }, function(data){
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
  }

  $('#home-search').submit(function(e){
    recherche(e);
    e.preventDefault();
  });

  $('#search form').click(function(e){
    if($(e.target).is('a')){
      recherche();
      e.preventDefault();
    }
  });

  $("#btngroupe-listevents button").click(function(){
    $('.span9').fadeToggle('slow');
  });
});