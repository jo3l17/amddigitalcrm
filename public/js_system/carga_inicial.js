$(window).load(function(responseTxt, statusTxt, xhr) {
    $('#preloader').fadeOut(function() {
        $('body').css('overflow', 'visible');
    });
});