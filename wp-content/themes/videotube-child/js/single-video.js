jQuery(document).ready(function($) {
    var $body           = $('html, body'),
        mrOffset        = $('#MRBox').offset(),
        topVal          = mrOffset.top;
    $body.delay('1000').animate({scrollTop:topVal}, '500');
});