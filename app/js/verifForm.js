$(document).ready(function() {

var checkChamps = function(reg, e){
  var pass = true;
    for(champ in reg){
      var curDiv = $('#'+champ);
      if(!reg[champ].test($('input',curDiv).val())){ // Si le champ ne respecte pas la RegExp
        $(curDiv).addClass('error');
        pass = false;
      }
      else if($(curDiv).hasClass('error')){
        $(curDiv).removeClass('error');
      }
    }

    if(!pass){
      alert('Merci de remplire tous les champs');
      e.preventDefault();
    }
};

  /*Verif form inscription*/
  var inscriptionAttendu = {
    'ctrlNom': /\w+/,
    'ctrlPrenom': /\w+/,
    'ctrlEmail': /^[\w\.]+@[\w\.\-]+\.\w+$/,
    'ctrlPassword': /^.{6,}$/,
    'ctrlPassword2': /^.{6,}$/
  };

  $("#signinform").submit(function(e){
    checkChamps(inscriptionAttendu, e);
  });

  /*Verif form connection*/
  var connectionAttendu = {
    'ctrlEmail': /^[\w\.]+@[\w\.\-]+\.\w+$/,
    'ctrlPassword': /^.+$/
  };

  $("#form-signin").submit(function(e){
    checkChamps(connectionAttendu, e);
  });

});