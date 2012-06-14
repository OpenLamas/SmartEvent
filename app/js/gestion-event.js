var idSessions = new Array();
var idEvents = new Array();
var openInput = 0;

/* Parse Date */
/*var changeDateFormat = function (date){
  var cut = date.split(' '); // Wed Jan 23 2013 00:00:00 GMT+0100 (Paris, Madrid)
  var dateOutput;
  var jour = {
    'Dimanche',
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi'
  };

  var mois = {

  };

  };
}*/


/* Modif des modals event */
var showModalEvents = function(){
  $('#events .modal li').click(function(e){
    if($(e.target).hasClass('icon-pencil')){
      $('span',this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />')
      $('i', this).removeClass('icon-pencil');
      $('i', this).addClass('icon-ok');
    }

    else if($(e.target).hasClass('icon-ok')){
      alert('Envoie AJAX !');
      $('input',this).replaceWith('<span>'+$('input',this).val()+'</span>')
      $('i', this).removeClass('icon-ok');
      $('i', this).addClass('icon-pencil');
    }
  });
};

/* Selection des Sessions */
var selectSession = function(){
  $('#session tbody tr').click(function(e){
      if(!$(e.target).is('a')){
        if($(':checkbox', this).attr("checked")){
          $(':checkbox', this).attr('checked', false);
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



/* Suppression des sessions */
var deleteSession = function(){
  
  
};

/* Gestion des events */
var selectEvents = function(){
  $('#events tbody tr').click(function(e){
    console.log('Couc !');
  });
};

/* Modif des modals session */
var showModalSessions = function(){
  $('#session .modal li').click(function(e){
    if($(e.target).hasClass('icon-pencil')){
      openInput = 1;
      if(!$('span', this).hasClass('date')){
        $('span',this).replaceWith('<input type="text" value="'+$('span',this).text()+'" />')
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
      openInput = 0
    }
  });
};

/* Update Session */
$('#session .modal').click(function(e){
  if($(e.target).hasClass('update')){
    if(!openInput){
      var tmp = $(this).attr("id").split('-');
      var infoSession = {
        'nomSession': $('.modal-header h3', this).html(),
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
    if($(e.target).hasClass('voir')){ // si c'est bien le lien 'voir'
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
        $("#events tbody").empty(); // on purge la table
        for(var i=0;i<data.length;i++){ // On ajoute les ligne
          $('<tr id="'+data[i]['idevenement']+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+data[i]['idevenement']+'" data-toggle="modal">'+data[i]['nomevenement']+'</a></td> <td><a href="#">'+data[i]['nbinscrit']+'</a></td> <td> <div class="modal fade" id="modal-'+data[i]['idevenement']+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3>'+data[i]['nomevenement']+'</h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data[i]['descevenement']+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>'+data[i]['nbinscrit']+'</span> <i class="icon-pencil"></i></li> <li>Date du début de l\'évènement : <span>'+data[i]['datedebutevenement']+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span>'+data[i]['datefinevenement']+'</span> <i class="icon-pencil"></i></li> <li>Emplacment : <span>'+data[i]['emplacementevenement']+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
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
        showModalEvents(); // On bind les modif des modos
        data = '';

      });
      e.preventDefault();
      selectEvent(); // On bind la selection des events;
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
  $('#session .modal').click(function(e){
    if($(e.target).hasClass('inscrire')){
      var Tevent = $(this).attr('id').split('-');
      var modal = $(this);
      console.log(thisSpan);
      $('.inscrire', modal).html('En cours...');
      $.getJSON('event-'+Tevent[1]+'-inscription',function(data){
          if(data.ok){
            $('.modal-header', modal).append('<span class="badge badge-success">Inscrit</span>');
            $('.inscrire', modal).html('Se déinscrire');
            $('.event-header h4', thisSpan).append('<span class="badge badge-success">Inscrit</span>');
          }
          else{
            $('.modal-header .badge', modal).hide(function(){
              $(this).remove;
            });
            $('.inscrire', modal).html('S\'inscrire');
            $('.event-header .badge-success', thisSpan).hide(function(){
              $(this).remove;
            });
          }
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
          $('<tr id="session-'+callBack.idSession.idsession+'"><td><label class="checkbox inline"><input type="checkbox"/></label></td><td><a href="#modal-session-'+callBack.idSession.idsession+'" data-toggle="modal">'+data.nomSession+'</a></td><td><a href="#" class="voir">Voir &raquo;</a></td><td><div class="modal fade" id="modal-session-'+callBack.idSession.idsession+'"><div class="modal-header"><button class="close" data-dismiss="modal">×</button><h3>'+data.nomSession+'</h3></div><div class="modal-body"> <ul><li>Créé par '+'Toi'+'</li><li>Nombre max d\'inscrit : <span>'+data.maxInscrit+'</span> <i class="icon-pencil"></i></li><li>Nombre d\'event mini : <span>'+data.minParticipation+'</span> <i class="icon-pencil"></i></li><li>Date limite d\'inscription : <span>'+data.dateLimite+'</span> <i class="icon-pencil"></i></li><li>Date rappel mail : <span>'+data.dateRappel+'</span> <i class="icon-pencil"></i></li></ul></div><div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Close</a></div></div></td></tr>').appendTo("#session tbody");
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
        console.log(callBack);
        $('#addEventModal').modal('hide');
        if (callBack.code == 'ok') {
          $('<tr id="'+callBack.idevent+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+callBack.idevent+'" data-toggle="modal">'+data.titre+'</a></td> <td><a href="#">'+data.emplacement+'</a></td> <td> <div class="modal fade" id="modal-'+callBack.idevent+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3>'+data.titre+'</h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data.description+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>0</span> <i class="icon-pencil"></i></li> <li>Date du début de l\'évènement : <span>'+data.dateDebut+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span>'+data.dateFin+'</span> <i class="icon-pencil"></i></li> <li>Emplacment : <span>'+data.emplacement+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
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
      }, 'json');
    }
  });
});

  /*$('#session .span4.well').click(function(e){
    if($(e.target).hasClass('detailBtn')){
      $.getJSON($(e.target).attr("href"), function(data){
        alert('coucou');
        /*$('<div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>'+data.nomevenement+'</h3>
      </div>
      <div class="modal-body">
        <p>'+data.descevenement+'<br />
        Il ne reste plus que '+$('h4',this).val()+'place(s) pour cette évènement</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary inscrire">S\'inscrire</a>
      </div>').appendTo($('.ajaxCont', this);
      });
    }
    e.preventDefault();
  });*/
  /*$('#selectSession input').hide();

  $('#selectSession select option:last').click(function(){
    $('#selectSession input').fadeIn("slow");
  });

  $('#selectSession select option:not(:last)').click(function(){
    $('#selectSession input').fadeOut("slow");
  });*/