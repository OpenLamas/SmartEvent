$(document).ready(function(){
  var thisSpan;
  $('#session .span4.well').click(function(e){
    if($(e.target).hasClass('detailBtn')){
      thisSpan = $(this);
    }
  });

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
});