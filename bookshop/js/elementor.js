/** * Elementor JS. */function counter() {    jQuery('.counter_number').counterUp({        delay: 10,        time: 1000    });}function slide() {    jQuery( '.author_item' ).slick({         infinite: true,        slidesToShow: 1,        slidesToScroll: 1,        dots: true,    });}function slide_service() {    jQuery( '.service_item' ).slick({        infinite: false,        slidesToShow: 4,        slidesToScroll: 1,        arrows: true,        responsive: [        {            breakpoint: 1024,            settings: {                slidesToShow: 3,                slidesToScroll: 1,                infinite: true            }        },        {            breakpoint: 600,            settings: {                slidesToShow: 2,                slidesToScroll: 2            }        },        {            breakpoint: 480,            settings: {                slidesToShow: 1,                slidesToScroll: 1,                dots: true,                autoplay: true            }        }      ]    });}jQuery( document ).ready(function() {    // For frontend.    counter();    slide();    slide_service();    var button = jQuery( '.js-modal-btn' ),        videoStyle = button.data( 'video-select' );    button.modalVideo({ channel: videoStyle });    // For elementor preview.    if ( undefined !== window.elementorFrontend && undefined !== window.elementorFrontend.hooks ) {        window.elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function() {            counter();        } );    }} );