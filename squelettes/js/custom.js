var mobile = false

$(function() {

    $('.player').each(function(){

        var player = $(this);

        player.find('.play[data-embed]').click(function(e){
            e.preventDefault();
            player.append('<iframe type="text/html" src="'+$(this).attr('data-embed').replace('http://','https://')+'" frameborder="0" allowfullscreen="true"/\>')
            player.find('.play').fadeOut(200);

        });


    });

    $('.spip_out').attr('target','_blank')

    if ($(document).width() < 940) {

        $('.bc-player').each(function(){

            $(this).find('img, a').hide()

            var iframe = $(this).find('iframe'),
                src  = iframe.attr('src').replace('artwork=none','artwork=small')

            iframe.attr('src', src)
        })

    }

});
