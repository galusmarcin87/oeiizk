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
    
    bsCustomFileInput.init();

    $('#filtersCollapse').on('hidden.bs.collapse', function (e) {
        $($(e.target).data('bs.collapse')._triggerArray).children('.open-text').removeClass('d-none');
        $($(e.target).data('bs.collapse')._triggerArray).children('.close-text').addClass('d-none');
    });
    $('#filtersCollapse').on('shown.bs.collapse', function (e) {
        console.log(e);
        $($(e.target).data('bs.collapse')._triggerArray).children('.open-text').addClass('d-none');
        $($(e.target).data('bs.collapse')._triggerArray).children('.close-text').removeClass('d-none');
    });
    
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

    $('.newsletter-list-toggle').click(function(e){
        e.preventDefault();e.stopPropagation();
        $('.newsletter-archive-list').toggleClass('open');
        $(this).toggleClass('open');
        return false;
    });

    $(".wcag_toggle").on("click", function(e) {
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
    
	if(readCookie('listing_type')=='grid') {
		$('.switching-list.list').removeClass('list').addClass('grid');
		$('.list-rows').removeClass('active');
		$('.list-grid').addClass('active');
	} else if (readCookie('listing_type')=='list') {
		$('.switching-list.grid').removeClass('grid').addClass('list');
		$('.list-grid').removeClass('active');
		$('.list-rows').addClass('active');
	}
      
        
    $('.listing-switcher').on( 'click','a.list-grid', function(e){
        e.preventDefault();
        $('.switching-list.list').removeClass('list').addClass('grid');
        $('.list-rows').removeClass('active');
        $(this).addClass('active');
        
        createCookie('listing_type','grid',1);
        
        return false;
    });
    $('.listing-switcher').on( 'click','a.list-rows', function(e){
        e.preventDefault();
        $('.switching-list.grid').removeClass('grid').addClass('list');
        $('.list-grid').removeClass('active');
        $(this).addClass('active');
        
        createCookie('listing_type','list',1);
        
        return false;
    });

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).data("password-toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });
    
    });
    })(jQuery);