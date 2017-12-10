// Set navigation bar opaqueness after scroll
$(window).scroll(function() {
    if($(this).scrollTop() > 100) {
        $('.navbar-bg').addClass('opaque');
        $('.navbar-brand').addClass('navbar-brand-scroll');
    } else {
        $('.navbar-bg').removeClass('opaque');
        $('.navbar-brand').removeClass('navbar-brand-scroll');
    }
});

// Toggle menu/close button for mobile nav
$(document).ready(function(){
	$('#icon-nav').click(function(){
		$(this).toggleClass('open');
    $('.navbar-bg').toggleClass('opaque');
	});
});
