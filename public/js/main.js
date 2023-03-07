var url = 'http://localhost/proyecto-laravel/public';
window.addEventListener("load", function(){
    $('body').css('background','#121212');

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor','pointer');

    //Boton de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'/img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a la publicación')
                    }else{
                        console.log('Error al dar like');
                    }
                   
                }
            });
            dislike();
        });
    }

    like();

    //Botón de dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'/img/heart-black.png');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado dislike a la publicación')
                    }else{
                        console.log('Error al dar dislike');
                    }    
                }
            });
            like();
        });
    }
    
    dislike();
    //Buscador
    $('#buscador').submit(function(){
        $(this).attr('action',url+'/people/'+$('#buscador').val());
    });
});