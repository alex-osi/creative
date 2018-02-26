//hide navbar-collapse any point
// $(document).on('click',function(){
//     $('.collapse').collapse('hide');
// });
$(".slide-popup").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup1").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup2").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup3").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup4").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup5").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup6").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup7").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup8").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup9").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup10").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup11").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

$(".slide-popup12").magnificPopup({
    type : 'image',
    gallery : {
        enabled : true
    }
});

//кнопка Вверх
$(window).scroll(function() {
    if ($(this).scrollTop() > $(this).height()){
        $('.top').addClass('active');
    } else {
        $('.top').removeClass('active');
    }
});
$('.top').click(function() {
    $('html , body').stop().animate({scrollTop: 0}, 'slow', 'swing');
});

// Скролл по якорю
$('a[data-target^="anchor"]').bind('click.smoothscroll',function () {
    var target = $(this).attr('href'),
        bl_top = $(target).offset().top - 70;
    $('body, html').animate({scrollTop: bl_top}, 1100);
    return false;
});

//свернуть контент collapse width 768
function windowSize(){
    if ($(window).width() <= '769'){
        $(".content-serv").collapse('hide');
    } else {
        $(".content-serv").collapse('show');
    }
}
$(window).on('load resize',windowSize);
