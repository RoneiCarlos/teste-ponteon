$("#estado").change(function(){
    let id_estado = $(this).val();
    $('#cidade').find('option:not(:first)').remove();
    $('#cidade').removeAttr('disabled');

    $.ajax({
        url: "buscaCidade.php",
        type: "get",
        dataType : 'html',
        data: { 'id_estado' : id_estado}
    })
    .done(function(data){
        result = JSON.parse(data);
        for(i = 0; i < result.length; i++){
            $('#cidade').append('<option value="'+result[i]['id']+'">' + result[i]['cidade'] + '</option>');
        }
    });
});

$(document).ready(function(){
    $('.del').click(function(){
      var el = $(this).parent().parent();
      var deleteid = this.value;
      var confirmalert = confirm("Você quer mesmo deletar o Empresário?");
      if (confirmalert == true) {
         $.ajax({
           url: 'del.php',
           type: 'POST',
           data: { 'id':deleteid },
           success: function(response){
                el.fadeOut(500, function() {
                    el.remove();
                    window.location.assign("cadastro.php");
                });
           }
         });
      }
   
    });
   
   });