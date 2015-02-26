jQuery(document).ready(function($) {
    var $body           = $('html, body'),
        $container      = $('.container'),
        $MRBox          = $('#MRBox'),
        mrOffset        = $MRBox.offset(),
        topVal          = mrOffset.top,
        screen          = window.screen || {
                            width: 0,
                            height: 0
        },
        width           = screen.width,
        height          = screen.height,
        pixels          = width * height;

    if (pixels <= 518400) {
        console.log('phone');
        $container.addClass('container--squished');
        $MRBox.addClass('MiniReel-wrapper--Mobile');
    } else {
        console.log('desktop');
        $body.delay('1000').animate({scrollTop:topVal}, '300');
    }
});