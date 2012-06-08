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

$(document).ready(function(){
  var thisSpan;

  $('#session .span4.well').click(function(e){
    if($(e.target).hasClass('detailBtn')){
      thisSpan = $(this);
    }
  });


  /* Inscription a un event*/
  $('#session .modal').click(function(e){
    if($(e.target).hasClass('inscrire')){
      var Tevent = $(this).attr('id').split('-');
      var modal = $(this);
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

  /* Modifiquation info Session*/
  $('#session .modal li').click(function(e){
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

  var currentSession;
  /*Affichage events par session*/
  $('#session tr[id|="session"]').click(function(e){
    if($(e.target).hasClass('voir')){
      if(!$("#events tbody").has('tr').length){
        $('#session+.progress').fadeIn('slow');
      }
      else{
        $("#events tbody tr ").hide('slow');
        //$("#events tbody").empty();
      }

      var sessionPlusId = $(this).attr('id');
      $.getJSON(sessionPlusId+'-get',function(data){
        currentSession = sessionPlusId.split('-')[1];
        if($("#events tbody").has('tr').length){
          //$("#events tbody tr").hide('slow', function(){
            $("#events tbody").empty();
            for(var i=0;i<data.length;i++){
              $('<tr id="'+data[i]['idevenement']+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+data[i]['idevenement']+'" data-toggle="modal">'+data[i]['nomevenement']+'</a></td> <td><a href="#">'+data[i]['emplacementevenement']+'</a></td> <td> <div class="modal fade" id="modal-'+data[i]['idevenement']+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3>'+data[i]['nomevenement']+'</h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data[i]['descevenement']+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>'+data[i]['nbinscrit']+'</span> <i class="icon-pencil"></i></li> <li>Date du début de l\'évènement : <span>'+data[i]['datedebutevenement']+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span>'+data[i]['datefinevenement']+'</span> <i class="icon-pencil"></i></li> <li>Emplacment : <span>'+data[i]['emplacementevenement']+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
            }
          //});
        }

        else{
          for(var i=0;i<data.length;i++){
            $('<tr id="'+data[i]['idevenement']+'"> <td><label class="checkbox inline"><input type="checkbox"/></label></td> <td><a href="#modal-'+data[i]['idevenement']+'" data-toggle="modal">'+data[i]['nomevenement']+'</a></td> <td><a href="#">'+data[i]['emplacementevenement']+'</a></td> <td> <div class="modal fade" id="modal-'+data[i]['idevenement']+'"> <div class="modal-header"> <button class="close" data-dismiss="modal">×</button> <h3>'+data[i]['nomevenement']+'</h3> </div> <div class="modal-body"> <ul> <li>Description de l\'évènement : <span>'+data[i]['descevenement']+'</span> <i class="icon-pencil"></i></li> <li>Nombre d\'inscrit : <span>'+data[i]['nbinscrit']+'</span> <i class="icon-pencil"></i></li> <li>Date du début de l\'évènement : <span>'+data[i]['datedebutevenement']+'</span> <i class="icon-pencil"></i></li> <li>Date de la fin de l\'évènement : <span>'+data[i]['datefinevenement']+'</span> <i class="icon-pencil"></i></li> <li>Emplacment : <span>'+data[i]['emplacementevenement']+'</span> <i class="icon-pencil"></i></li> </ul> </div> <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a> </div> </div> </td></tr>').appendTo("#events tbody");
          }
          $('#session+.progress').fadeOut('slow', function(){
            $('#events').fadeIn('slow');
          });
        }
        showModalEvents();
        data = '';

      });
      e.preventDefault();
    }
  });

  /* Ajout d'un event dans une session*/
  $('#addEventModal').click(function(e){
    e.preventDefault();
    if($(e.target).hasClass('btn-primary')){
      var data = {
        nom: $('form #titreEvent',this).val(),
        description: $('form #descEvent',this).val(),
        nbInscrit: $('form #nbInscrit',this).val(),
        dateDebut: $('form #dateDebut',this).val(),
        dateFin: $('form #dateFin',this).val(),
        emplacement: $('form #emplacement',this).val(),
        session: currentSession
      };

      $.post($(e.target).attr('href'),data,function(callBack){
        alert(data.session);
      });
    }
  })
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