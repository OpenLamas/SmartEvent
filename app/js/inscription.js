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
      if($('#search form input:first').val() == ''){
        $('#search form div').addClass('error');
      }

      else{
        $('#search form div').removeClass('error');
        var query = $('#search form input:first').val();
        $('#search table').fadeOut('slow');
        $('#search .noResult').fadeOut('slow');
        $.post("search", { 'query': query }, function(data){
          $('#search tbody').empty();
          if(data != ''){
            var badgeInscit = '';
            var placesLibreTxt = ''
            for(var i=0;i<data.length;i++){
              console.log(data[i]['count']);
              if(data[i]["inscrit"]){
                badgeInscit = '<span class="badge badge-success">Inscrit</span>';
              }
              else{
                badgeInscit = '<span class="badge badge-info">Non inscrit</span>';
              }

              var placeLibre = data[i]['nbmaxinscritevenement']-data[i]['count'];
              if(placeLibre > 1){
                placesLibreTxt = placeLibre+' places libres';
              }
              else{
                placesLibreTxt = placeLibre+' place libre';
              }
              $('#search tbody').append('<tr><td><a href="session-'+data[i]['idsession']+'-list-'+data[i]['idevenement']+'-modal">'+data[i]['nomevenement']+'</a></td><td>'+data[i]['descevenement']+'</th><td><span class="badge badge-inverse">'+placesLibreTxt+'</span></td><td>'+badgeInscit+'</td></tr>');
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

  $('#btngroupe-listevents #buttonList').click(function(){
    if(!$('#listCalendar').hasClass('visible')){
      $('#calendar').fadeOut(function(){
        $('#listCalendar').fadeIn();
        $('#listCalendar').addClass('visible');
        $('#calendar').removeClass('visible');
      });
    }
  });

  $('#btngroupe-listevents #buttonCalendar').click(function(){
    if(!$('#calendar').hasClass('visible')){
      $('#listCalendar').fadeOut(function(){
        $('#calendar').fadeIn();
        $('#calendar').addClass('visible');
        $('#listCalendar').removeClass('visible');
      });
    }
  });

  /*$("#btngroupe-listevents button").click(function(){
    $('.span9').fadeToggle('slow');
  });*/
});