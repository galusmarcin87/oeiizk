(function($){
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function eraseCookie(name) {
	createCookie(name,"",-1);
}
$(document).ready(function() {

    if(readCookie('contrast')=='enabled') {
        $('body').addClass('wcag');
    }
    
    $("#search-button").on("click", function(e) {
        e.preventDefault();
        $(".search-box").toggle();
    });
    $('.font-grow').click(function(){
        curSize= parseInt($('body').css('font-size')) + 2;
        if(curSize<=26) {
                createCookie('fontsize',curSize,1);

            $('html').css('font-size', curSize);
            }
    });
    $('.font-shrink').click(function(){
        curSize= parseInt($('body').css('font-size')) - 2;
        if(curSize>=12) {
                createCookie('fontsize',curSize,1);

            $('html').css('font-size', curSize);
            }
    });
    $('.font-reset').click(function(){
        curSize= 16;
        $('html').css('font-size', curSize);
            eraseCookie('fontsize');
    });

$('[data-toggle="tooltip"]').tooltip();

$("#burger").on("click", function(e) {
e.preventDefault();
$('#main-menu').toggle();
});
$(".wcag-toggle").on("click", function(e) {
e.preventDefault();
$("body").toggleClass("wcag");
$(this).toggleClass("active");
if(readCookie('contrast')=='enabled') {
    eraseCookie('contrast');
  } else {
    createCookie('contrast','enabled',1);
  }
return false;
});
  
$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).data("toggle-password"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});

});
})(jQuery);