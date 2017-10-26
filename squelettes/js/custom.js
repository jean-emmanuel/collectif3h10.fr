var mobile = false

$(function() {

    $('.player').each(function(){

        var player = $(this);

        player.find('.play').click(function(e){
            e.preventDefault();
            player.append('<iframe type="text/html" src="'+$(this).attr('data-embed').replace('http://','https://')+'" frameborder="0" allowfullscreen="true"/\>')
            player.find('.play').fadeOut(200);

        });


    });

    $('.spip_out').attr('target','_blank')

    if ($(document).width() < 940) {

        $('.bc-player').each(function(){

            $(this).find('img').hide()

            var iframe = $(this).find('iframe'),
                src  = iframe.attr('src').replace('artwork=none','artwork=small')

                console.log(src)
            iframe.attr('src', src)
        })

    }

});
