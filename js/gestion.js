$(document).ready(function () {
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  }); 
  
  var idUsers = new Array();
  $('#utilisateurs tbody tr').click(function() {
    if($('input', this).attr('checked')){
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
  
  $('#utilisateurs .btn-danger').click(function(){
    if(idUsers.length > 0){
      $.post('users-delete', {'tabUsers' : idUsers}, function(data){
        if(data == 'ok'){
          for(var i=0;i<idUsers.length;i++){
            $('#utilisateurs tbody #user-'+idUsers[i]).hide(function() {
              idUsers = '';
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
});