$(document).ready(function() {

    // $('.sl').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     arrows: false,
    //     fade: true,
    //     cssEase: 'ease-in',
    //     asNavFor: '.sl1'
    // });
    // $('.sl1').slick({
    //     slidesToShow: 5,
    //     slidesToScroll: 1,
    //     asNavFor: '.sl',
    //     dots: true,
    //     // centerPadding: '40px',
    //     centerMode: true,
    //     focusOnSelect: true,
    //     autoplay: true,
    //     autoplaySpeed: 3000,
    //     responsive: [{
    //                 breakpoint: 768,
    //                 settings: {
    //                     slidesToShow: 3,
    //                 }
    //             },]
    // });

//responsive
    $('.slider').slick({

        slidesToScroll: 4,
        autoplay: true,
        autoplaySpeed: 6000,
        dots: true,

        responsive: [{

            breakpoint: 3500,
            settings: {
                slidesToShow: 4
            }

        }, {

            breakpoint: 767,
            settings: {
                slidesToScroll: 1,
                slidesToShow: 1,
                dots: false
            }

        }]

    });


$('.slider-1').slick({

    slidesToScroll: 1,

    responsive: [{

        breakpoint: 3500,
        settings: {
            slidesToShow: 2
        }

    }, {

        breakpoint: 767,
        settings: {
            slidesToShow: 1
        }

    }]

});

});
