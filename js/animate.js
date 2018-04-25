$(document).ready(function() {

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
    variableWidth: true,

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

    $('.slider-2').slick({

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

    $('.review-slider').slick({



        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,

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
