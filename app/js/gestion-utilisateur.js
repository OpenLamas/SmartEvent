$(document).ready(function () {
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  }); 
  
  var idUsers = new Array();

  // Selection global

  $('#utilisateurs thead input').click(function(){
    if(!$(this).attr('checked')){ //on lit l'event après le clique donc on inverse les états
      idUsers.splice(0, idUsers.length);
      $('#utilisateurs tbody tr').each(function(){
        $('input', this).attr("checked", false);
      });
    }

    else{
      $('#utilisateurs tbody tr').each(function(){
        if(!$('input', this).attr("checked")){
          var tmp = $(this).attr('id').split('-');
          idUsers.push(tmp[1]);
          $('input', this).attr("checked", true);
        }
      });
    }
  })

  // Selection des lignes
  $('#utilisateurs tbody tr').click(function(e) {
    if(!$(e.target).is('a')){
      if($('input', this).attr('checked')){
        if ($('#utilisateurs thead input').attr('checked')) {
          $('#utilisateurs thead input').attr('checked', false);
        };
        $('input', this).attr('checked', false);
        var tmp = $(this).attr('id').split('-');
        idUsers.splice(idUsers.indexOf(tmp[1]),1);
      }
       
      else{
        $('input', this).attr('checked', true);
        var tmp = $(this).attr('id').split('-');
        idUsers.push(tmp[1]);
      }
    }
  });

  // Rétablissement des events sur les case a coché

  $('#utilisateurs tbody tr :checkbox').click(function() {
    if ($(this).attr('checked')) {
      $(this).attr('checked', false);
    }

    else{
      $(this).attr('checked', true);
    }
  });
  
  // Envoie des users a supprimer via ajax

  $('#utilisateurs .btn-danger').click(function(){
    if(idUsers.length > 0){
      $.post('users-delete', {'tabUsers' : idUsers}, function(data){
        if(data == 'ok'){
          for(var i=0;i<idUsers.length;i++){
            $('#utilisateurs tbody #user-'+idUsers[i]).hide();
          }
          idUsers.splice(0, idUsers.length); //On purge le tableau
        }
      
        else if(data == '!user'){
          alert('Vous devez selectionnez au moins un utilisateur');
        }
      
        else if(data == '!soi'){
          alert('Vous ne pouvez pas vous supprimer !');
        }
        else{
          alert('Vous n\'avez pas le droit de supprimer des utilisateurs');
        }
      });
    }
    else{
      alert('Vous devez selectionnez au moins un utilisateur');
    }
  });

  /* Promotion d'utilisateurs */
  var promote = 1;
  $('#promoteModal select').change(function(){
    promote = $(this).val();
  });

  $('#utilisateurs .btn-info').click(function(e){
    if(idUsers.length == 0){
      $('#promoteModal .modal-footer .btn-primary').addClass('disabled');
    }
    else if($('#promoteModal .modal-footer .btn-primary').hasClass('disabled')){
      $('#promoteModal .modal-footer .btn-primary').removeClass('disabled');
    }
  });

    $('#promoteModal').click(function(e){
    if($(e.target).hasClass('btn-primary')){
      if(!$(e.target).hasClass('disabled')){
        $(e.target).html('En cours...');
        $.post($(e.target).attr("href"), {'rang': promote, 'tabUsers': idUsers}, function(data){
          if(data.code == 'ok'){
            var right = ['', 'UTILISATEUR', 'GESTIONNAIRE', 'ADMIN'];
            for(var i=0;i<idUsers.length;i++){
              $('#utilisateurs tbody tr#user-'+idUsers[i]+' td:eq(4)').html(right[promote]);
            }
            $('#promoteModal').modal('hide');
            $(e.target).html('Promouvoir');
          }

          else if(data.code == "!right"){
            alert('Vous n\'avez pas le droit !');
            $('#promoteModal').modal('hide');
            $(e.target).html('Promouvoir');
          }
        }, 'json');

        e.preventDefault();
      }
      else{
        alert('Vous devez selectionner au moins un utilisateur');
        e.preventDefault();
      }
    }
  });
 
 /* Affichage des event auquelle l'user a participé */
 $('#utilisateurs tr').click(function(e){
  if($(e.target).is('a')){
    var tmp = $(this).attr('id').split('-');
    var user = tmp[1];
    var nomUser = $("td:eq(1)" , this).html()+' '+$("td:eq(2)", this).html();
    $.post($(e.target).attr('href'), {'idUser': user}, function(data){
      $('#participationModal table tbody').empty();
      $('#participationModal .modal-header h3').html("Participation(s) de "+nomUser);
      for(ligne in data){
        $('#participationModal table tbody').append('<tr><td>'+data[ligne].nomevenement+'</td><td>'+data[ligne].datedebutevenement+'</td><td>'+data[ligne].nomsession+'</td></tr>');
      }
      $('#participationModal').modal('show');
    }, 'json');
    e.preventDefault();
  }
 });

 /* Verification form inscription
 $('#signinform input').focusout(function(e){
    if($(e.target).val() == ''){
      console.log(e['target']);
      //$('#signinform .control-group:has('e['target']')').addClass('error');
    }

    else{
      $(this).removeClass('error');
    }
 });*/

  /*$('#signinform').click(function(e){
    if($(e.target).is('button')){
      if($("inputNom", this).val == ''){
        $('control-group:eq(0)', this).addClass('error');
      }

      else{
        $('control-group:eq(0)', this).removeClass('error');
      }
      console.log($(this));
      e.preventDefault();
    }
 });*/

}); // END document.ready

  /* Gestion des tags 
  $('#utilisateurs .listTags li').click(function(e){
    if ($(e.target).is('i')) {
      $(this).remove();
    }
  });

  $('#utilisateurs .listTags input').keypress(function(e){
    if(e.which == 32 && $(this).val() != ''){
      var tag = $(this).val();
      $(this).val('');
      $('#utilisateurs .listTags input').before('<li class="tag">'+tag+' <i class=" icon-remove closeTag"></i></li>')
    
      $('#utilisateurs .listTags li').click(function(e){
        if ($(e.target).is('i')) {
          $(this).remove();
        }
      });
    }
  });*/