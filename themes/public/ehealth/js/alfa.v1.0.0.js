$(document).ready(function(){

/* ----------------------- Scroll to Top ----------------------- */
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });
            
    $('.back-to-top').on('click', function(e) {
        e.preventDefault();
        $('html,body').animate({scrollTop: 0}, 600);
    });

/* ----------------------- Magnific Popup ----------------------- */
    $('.popup_image').magnificPopup({type:'image'});

/* ----------------------- Bootstrap Tooltips ----------------------- */
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
/*----------------------------------------------------------------*/

});