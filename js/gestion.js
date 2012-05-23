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
      $('#utilisateurs tbody input').each(function(){
        idUsers.push($(this).attr("name"));
        $(this).attr("checked", true);
      });
    }
  })

  // Selection des lignes
  $('#utilisateurs tbody tr').click(function() {
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
            $('#utilisateurs tbody #user-'+idUsers[i]).hide(function() {
              idUsers.splice(0, idUsers.length);
            });
          }
        }
      
        else if(data == '!user'){
          alert('Vous devez selectionnez au moins un utilisateur');
        }
      
        else{
          alert('Vous n\'avaez pas le droit de supprimer des utilisateurs');
        }
      });
    }
    
    else{
      alert('Vous devez selectionnez au moins un utilisateur');
    }
  });

 
  // Gestion des tags 
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
  });

});