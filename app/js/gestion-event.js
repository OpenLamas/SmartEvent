var idSessions = new Array();
var idEvents = new Array();
var openInputSession = 0;
var openInputEvent = 0;
var loadTrig = false;

/* Modif des modals event */
var updateModalEvents = function(){
  $('#events .modal li').click(function(e){
    if($(e.target).hasClass('icon-pencil')){
      openInputEvent++;
      
      if(!$('span', this).hasClass("date")){
        $('span',this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />')
        $('i', this).removeClass('icon-pencil');
        $('i', this).addClass('icon-ok');
      }

      else{
        var dateInput = $('span',this).text().split(' ');
        if(dateInput.length == 2){
          var heure = dateInput[1].split(':');
          $('span',this).replaceWith('<form class="form-horizontal" ><div class="controls"><input type="text" class="date" value="" /><div class="input-append input-prepend"><input type="text" class="input-micro" id="heureDebut"value="'+heure[0]+'"/><span class="add-on">:</span><input type="text" class="input-micro" id="minuteDebut" value="'+heure[1]+'"/></div></div></form>')
          $('input.date', this).datepicker();
          $('input.date', this).datepicker('setDate', $.datepicker.parseDate('yy-mm-dd', dateInput[0]));
          $('i', this).removeClass('icon-pencil');
          $('i', this).addClass('icon-ok');
        }

        else{
          openInputEvent--;
        }
      }
    }

    else if($(e.target).hasClass('icon-ok')){
      openInputEvent--;
      if(!$('input:eq(0)', this).hasClass('date')){
        $('input',this).replaceWith('<span>'+$('input',this).val()+'</span>')
      }

      else{
        $('form', this).replaceWith('<span class="date">'+$('input.date',this).val()+' '+$('input:eq(1)', this).val()+':'+$('input:eq(2)', this).val()+'</span>')
      }

      $('i', this).removeClass('icon-ok');
      $('i', this).addClass('icon-pencil');
      $(this).addClass('success');
    }
  });

  $('#events .modal h3').click(function(e) {
    if($(e.target).hasClass('icon-pencil')){
      openInputEvent++;
      $('span',this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />')
      $('i', this).removeClass('icon-pencil');
      $('i', this).addClass('icon-ok');
    }

    else if($(e.target).hasClass('icon-ok')){
      openInputEvent--;
      $('input',this).replaceWith('<span>'+$('input',this).val()+'</span>')
      $('i', this).removeClass('icon-ok');
      $('i', this).addClass('icon-pencil');
      $(this).addClass('success');
    }
  });

  /* Envoi des données modifié*/
  $('#events .modal').click(function(e){
    if($(e.target).hasClass('update')){
      if(!openInputEvent){
        var tmp = $(this).attr("id").split('-');
        var infoEvent = {
          'titre': $('.modal-header h3 span', this).html(),
          'description': $('li:eq(0) span', this).html(),
          'dateDebut': $('li:eq(2) span', this).html(),
          'dateFin': $('li:eq(3) span', this).html(),
          'emplacement': $('li:eq(4) span', this).html(),
          'idEvenement': tmp[1]
        };
        $(e.target).html('En cours...');
        $.post($(e.target).attr('href'), infoEvent, function(data){
          if(data.code == 'ok'){
            $(e.target).html('Modifications Enregistré !');
            $('#events .modal .success').removeClass("success");
          }
        }, 'json');
      }

      else{
        alert('Vous devez d\'abord valider tous les champs');
      }
      e.preventDefault();
    }
  });


};

/* Selection des Sessions */
var selectSession = function(){
  $('#session thead th input').click(function(){
    if($(this).attr('checked')){
      idSessions.splice(0, idSessions.length); //On purge le tableau 
      $('#session tbody tr').each(function(e){
        $(':checkbox', this).attr('checked', true);
        var tmp = $(this).attr('id').split('-');
        idSessions.push(tmp[1]);
      });
    }

    else{
      $('#session tbody :checkbox').each(function(){
        $(this).attr('checked', false);
      });
      idSessions.splice(0, idSessions.length); //On purge le tableau 
    }
  });

  $('#session tbody tr').click(function(e){
      if(!$(e.target).is('a')){
        if($(':checkbox', this).attr("checked")){
          $(':checkbox', this).attr('checked', false);
          $('#session thead :checkbox').attr("checked", false);
          var tmp = $(this).attr('id').split('-');
          idSessions.splice(idSessions.indexOf(tmp[1]),1);
        }
        else{
          var tmp = $(this).attr('id').split('-');
          idSessions.push(tmp[1]);
          $(':checkbox', this).attr("checked", true);
        }
      }
  });

  /* On rétablie les checkbox */
  $('#session tbody tr :checkbox').click(function() {
    if ($(this).attr('checked')) {
      $(this).attr('checked', false);
    }

    else{
      $(this).attr('checked', true);
    }
  });
};


/* Gestion des events */
var selectEvents = function(){

  /* Selection globale */
  $('#events thead th input').click(function(){
    if($(this).attr('checked')){
      idEvents.splice(0, idEvents.length); //On purge le tableau 
      $('#events tbody tr').each(function(e){
        $(':checkbox', this).attr('checked', true);
        var tmp = $(this).attr('id').split('-');
        idEvents.push(tmp[1]);
      });
    }

    else{
      $('#events tbody :checkbox').each(function(){
        $(this).attr('checked', false);
      });
      idEvents.splice(0, idEvents.length); //On purge le tableau 
    }
  });

  /* Selection via les lignes */
  $('#events tbody tr').click(function(e){
    if(!$(e.target).is('a')){
      if($(':checkbox', this).attr("checked")){
        $(':checkbox', this).attr("checked", false);
        $('#events thead :checkbox').attr("checked", false);
        var tmp = $(this).attr('id').split('-');
        idEvents.splice(idEvents.indexOf(tmp[1]),1);
      }

      else{
        $(':checkbox', this).attr("checked", true);
        var tmp = $(this).attr('id').split('-');
        idEvents.push(tmp[1]);
      }
    }
  });

  /* Rétablissement des checkbox */
  $('#events tbody tr :checkbox').click(function() {
    if ($(this).attr('checked')) {
      $(this).attr('checked', false);
    }

    else{
      $(this).attr('checked', true);
    }
  });
};

/* Modif des modals session */
var showModalSessions = function(){
  $('#session .modal h3').click(function(e){
    if($(e.target).hasClass('icon-pencil')){
      openInputSession++;
      $('span', this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />');
      $('i', this).removeClass('icon-pencil');
      $('i', this).addClass('icon-ok');
    }

    else if($(e.target).hasClass('icon-ok')){
      $('input',this).replaceWith('<span>'+$('input',this).val()+'</span>');
      $(this).addClass("success");
      $('i', this).removeClass('icon-ok');
      $('i', this).addClass('icon-pencil');
      openInputSession--;
    }
  });

  $('#session .modal li').click(function(e){
    if($(e.target).hasClass('icon-pencil')){
      openInputSession++;
      if(!$('span', this).hasClass('date')){
        $('span',this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />');
      }

      else{
        var dateInput = $('span',this).text();
        $('span',this).replaceWith('<input type="text" class="date" value="" />')
        $('input', this).datepicker();
        $('input', this).datepicker('setDate', $.datepicker.parseDate('yy-mm-dd', dateInput));
      }
      $('i', this).removeClass('icon-pencil');
      $('i', this).addClass('icon-ok');
    }

    else if($(e.target).hasClass('icon-ok')){
      $('input',this).replaceWith('<span>'+$('input',this).val()+'</span>');
      $(this).addClass("success");
      $('i', this).removeClass('icon-ok');
      $('i', this).addClass('icon-pencil');
      openInputSession--;
    }
  });
};

/* Update Session */
$('#session .modal').click(function(e){
  if($(e.target).hasClass('update')){
    if(!openInputSession){
      var tmp = $(this).attr("id").split('-');
      var infoSession = {
        'nomSession': $('.modal-header h3 span', this).html(),
        'maxInscrit': $('li:eq(1) span', this).html(),
        'minParticipation': $('li:eq(2) span', this).html(),
        'dateLimite': $('li:eq(3) span', this).html(),
        'dateRappel': $('li:eq(4) span', this).html(),
        'idSession': tmp[2],
        'idCreateur': ''
      };

      $('#session .update').html('En cours...');
      $.post($(e.target).attr('href'), infoSession, function(data){
        if(data.code == 'ok'){
          $('#session .update').html('Modifications Enregistré !');
          $('#session .modal .success').removeClass("success");
        }
      });
    }

    else{
      alert('Vous devez d\'abord valider tous les champs');
    }
    e.preventDefault();
  }
});


/*Affichage events par session*/
var currentSession;
var showEvent = function(){
 $('#session tr[id|="session"]').click(function(e){ // Si on selectionneune ligne qui à un id qui commence par session
    if($(e.target).hasClass('voir') && !loadTrig){ // si c'est bien le lien 'voir' et on a pas de chargement en cours
      loadTrig = true;
      if(!$("#events table").hasClass('dejaVu')){ // si le tableau n'a jamais été affiché
        $('#events').after('<div class="hide progress progress-striped active span3 offset2" style="margin-top: 100px;"><div class="bar" style="width: 100%;"></div></div>');
        $('#events+.progress').fadeIn('slow'); // On affiche la progress-barre
      }
      else{
        $('#events').after('<div class="hide progress progress-striped active span3 offset1" style="margin-top: 60px;"><div class="bar" style="width: 100%;"></div></div>');
        $("#events table").fadeOut('slow', function(){ // On cache le tableau
          $('#events+.progress').fadeIn('slow');       // et on affiche la barre de progression
        });
      }

      var sessionPlusId = $(this).attr('id');
      $.getJSON(sessionPlusId+'-get',function(data){
        currentSession = sessionPlusId.split('-')[1];
        $('#uploadFile #idCurrentSession').val(currentSession);
        $("#events tbody").empty(); // on purge la table
        idEvents.splice(0, idEvents.length); //On purge le tableau 
        for(var i=0;i<data.length;i++){ // On ajoute les ligne
          $('<tr id="event-'+data[i]['idevenement']+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+data[i]['idevenement']+'" data-toggle="modal">'+data[i]['nomevenement']+'</a></td> <td><a href="#">'+data[i]['nbinscrit']+'</a></td> <td> <div class="modal fade" id="modal-'+data[i]['idevenement']+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3><span>'+data[i]['nomevenement']+'</span> <i class="icon-pencil"></i></h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data[i]['descevenement']+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>'+data[i]['nbinscrit']+'</span></li> <li>Date du début de l\'évènement : <span class="date">'+data[i]['datedebutevenement']+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span class="date">'+data[i]['datefinevenement']+'</span> <i class="icon-pencil"></i></li> <li>Emplacement : <span>'+data[i]['emplacementevenement']+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="event-update" class="btn btn-primary update">Enregistré les modifications</a><a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
        }

        $('#events+.progress').fadeOut('slow', function(){ // On fait disparaitre la progress-bar
          $(this).remove(); // On la supprime du DOM
          if(!$('#events table').hasClass('dejaVu')){ // Si il n'a pas la classe dejaVu
            $('#events table').addClass('dejaVu');    // On lui donne
            $('#events').fadeIn('slow');
          }

          else{
            $('#events table').fadeIn('slow'); // On affiche le tabeau 
          }
        });
        updateModalEvents(); // On bind les modif des modos
        selectEvents(); // On bind les selections
        data = '';
        loadTrig = false;
        $('#events .listes').attr('href', sessionPlusId+'-print');

      });
      e.preventDefault();
    }
  });
};

$(document).ready(function(){
  showModalSessions();
  showEvent();
  selectSession();

  var thisSpan;

  $('#session .span3.well').click(function(e){
    if($(e.target).hasClass('detailBtn')){
      thisSpan = $(this);
    }
  });

  /* Inscription a un event*/
  $('#session .span3').click(function(e){
    if($(e.target).hasClass('inscrire')){
      var Tevent = $('.modal',this).attr('id').split('-');
      var modal = $('.modal',this);
      var that = this;
      var idSession = $('.span12 h1').attr("id").split('-');
      var attrPlaceLibre = $('h2',this)
      var placeLibre = $(attrPlaceLibre).attr('data-place-libre');
      $('.inscrire', modal).html('En cours...');
      $.getJSON('event-'+Tevent[1]+'-'+idSession[1]+'-inscription',function(data){
          if(data.ok != 'no' && data.ok){
            $('.modal-header', modal).append(' <span class="badge badge-success">Inscrit</span>');
            $('.inscrire', modal).html('Se déinscrire');
            $('.event-header h4', thisSpan).append(' <span class="badge badge-success">Inscrit</span>');
            placeLibre--;
          }
          else if(data.ok != 'no'){
            $('.modal-header .badge', modal).hide(function(){
              $(this).remove;
            });
            $('.inscrire', modal).html('S\'inscrire');
            $('.event-header .badge-success', thisSpan).hide(function(){
              $(this).remove;
            });
            placeLibre++;
          }
          else{
            alert("Il n'y a plus de place pour cet évènement");
          }
        $(".event-header .badge-inverse",that).html(placeLibre+" places libres");
        $(attrPlaceLibre).attr('data-place-libre',placeLibre);
        $('.placeLibre',modal).html("Il ne reste plus que "+placeLibre+" place(s) pour cette évènement");
      });
    }
    e.preventDefault();
  });

  /* Ajout session */
  $('#addSessionModal').click(function(e){
    if($(e.target).hasClass("btn-primary")){
      e.preventDefault();
      var data = {
        nomSession: $('#input_sessionName', this).val(),
        maxInscrit: $('#input_sizeEvent', this).val(),
        minParticipation: $('#input_minEvent', this).val(),
        dateLimite: $('#input_dateExp', this).val(),
        dateRappel: $('#input_dateMail', this).val(),
        idCreateur: ''
      };

      $.post($(e.target).attr("href"), data, function(callBack){
        if (callBack.code == 'ok'){
          $('#addSessionModal').modal('hide');
          $('<tr id="session-'+callBack.idSession.idsession+'"><td><label class="checkbox inline"><input type="checkbox"/></label></td><td><a href="#modal-session-'+callBack.idSession.idsession+'" data-toggle="modal">'+data.nomSession+'</a></td><td><a href="#" class="voir">Voir &raquo;</a></td><td><div class="modal fade" id="modal-session-'+callBack.idSession.idsession+'"><div class="modal-header"><button class="close" data-dismiss="modal">×</button><h3>'+data.nomSession+'</h3></div><div class="modal-body"> <ul><li>Créé par moi</li><li>Nombre max d\'inscrit : <span>'+data.maxInscrit+'</span> <i class="icon-pencil"></i></li><li>Nombre d\'event mini : <span>'+data.minParticipation+'</span> <i class="icon-pencil"></i></li><li>Date limite d\'inscription : <span>'+data.dateLimite+'</span> <i class="icon-pencil"></i></li><li>Date rappel mail : <span>'+data.dateRappel+'</span> <i class="icon-pencil"></i></li></ul></div><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div></div></td></tr>').appendTo("#session tbody");
          showModalSessions();
          showEvent();
          selectSession();
        }

        else{
          alert('Vous n\'avez pas le droit d\'ajouté une session');
        }
      }, 'json');
      showModalSessions();
    }
  });

  /* Envoie des sessions a delete */
  $('#session .btn-danger').click(function(e){
    for(var i=0;i<idSessions.length;i++){
      $('#session tr#session-'+idSessions[i]).css("opacity", 0.3);
    }
    $.post($(this).attr('href'), {'tabSessions': idSessions}, function(data){
      if(data.code == 'ok'){
        for(var i=0;i<idSessions.length;i++){
          $('#session tr#session-'+idSessions[i]).hide('slow');
        }
        idSessions.splice(0, idSessions.length); //On purge le tableau 
      }

      else{
        alert('Vous n\'avez pas le droit de supprimé ces évènement');
      }
    }, 'json');

    e.preventDefault();
  });

  /* Ajout d'un event dans une session*/
  $('#addEventModal').click(function(e){
    e.preventDefault();
    if($(e.target).hasClass('btn-primary')){
      var data = {
        titre: $('form #titre',this).val(),
        description: $('form #description',this).val(),
        dateDebut: $('form #dateDebut',this).val(),
        heureDebut: $('form #heureDebut',this).val(),
        minuteDebut: $('form #minuteDebut',this).val(),
        heureFin: $('form #heureFin',this).val(),
        minuteFin: $('form #minuteFin',this).val(),
        dateFin: $('form #dateFin',this).val(),
        emplacement: $('form #emplacement',this).val(),
        idSession: currentSession
      };
      
      $.post($(e.target).attr('href'), data, function(callBack){
        $('#addEventModal').modal('hide');
        if (callBack.code == 'ok') {
          $('<tr id="event-'+callBack.idEvent[0]+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+callBack.idevent+'" data-toggle="modal">'+data.titre+'</a></td> <td><a href="#">0</a></td> <td> <div class="modal fade" id="modal-'+callBack.idevent+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3>'+data.titre+'</h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data.description+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>0</span> <i class="icon-pencil"></i></li> <li>Date du début de l\'évènement : <span>'+data.dateDebut+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span>'+data.dateFin+'</span> <i class="icon-pencil"></i></li> <li>Emplacment : <span>'+data.emplacement+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="event-update" class="btn btn-primary update">Enregistré les modifications</a><a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
          selectEvents(); //On bind les checkbox
        }

        else if(callBack.code == '!right'){
          alert('Vous n\'avez pas le droit d\'ajouté d\'évènement');
        }

        else if(callBack.code == '!createur'){
          alert('Vous n\'avez pas le droit d\'ajouté d\'évènement a une session que vous n\'avez pas créé');
        }

        else{
          console.log(callBack);
        }
        updateModalEvents();
      }, 'json');
    }
  });

  /* Envoie des events a delete*/
  $('#events .deleteEvent').click(function(e){
    if(idEvents.length != 0){
      $.post($(this).attr('href'), {'tabEvents': idEvents}, function(data){
        if(data.code == 'ok'){
          for(var i=0;i<idEvents.length;i++){
            $('#events tbody #event-'+idEvents[i]).hide('slow');
          }
          idEvents.splice(0, idEvents.length); //On purge le tableau 
        }
      }, 'json');
    }

    else{
      alert('Vous devez sélectionner au moins un évènement');
    }
    e.preventDefault();
  });

  /* Remplisage modal RedUser */
  $('#events .redUser').click(function(){
    $('span', this).html("En cours...");
    $('#remindUsersModal .modal-footer a:eq(1)').attr('href', 'mail-reminders-'+currentSession);
    $.post('user-red', {'idSession': currentSession}, function(data){
      $('#remindUsersModal tbody').empty();
      for(var i=0;i<data.length;i++){
        if(data[i]['nbmanquante'] == null){
          data[i]['nbmanquante'] = $('#session tr#session-'+currentSession+' .modal ul li:eq(2) span').html();
        }
        $('#remindUsersModal tbody').append('<tr><td>'+data[i]['nomutilisateur']+'</td><td>'+data[i]['prenomutilisateur']+'</td></tr>'); //<td>'+data[i]['nbmanquante']+'</td>
      }
      $('#remindUsersModal').modal('show');
    }, 'json');
    $('span', this).html(' Rappels utilisateurs');
  });

  $('#uploadFile .form-actions .btn-info').popover();
});
