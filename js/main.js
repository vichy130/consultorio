$(document).ready(function(){
    $('.menu li:has(ul)').click(function(e){
        e.preventDefault();

        if($(this).hasClass('activado')){
            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
        }else{
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });

    $('.boton-menu').click(function(){
        $('.navI .menu').slideToggle();
    });

    $(window).resize(function(){
        if($(document).width()>1020){
            $('.navI .menu').css({'display' : 'block'});
        }
        if($(document).width()<1020){
            $('.navI .menu').css({'display' : 'none'});
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
        }
    });

    $('.menu li ul li a').click(function(){
        window.location.href= $(this).attr("href");
    });

});