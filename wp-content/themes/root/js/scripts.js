jQuery(function($) {
    "use strict";


    /**
     * TOC
     */
    $(document).on('click', '.js-table-of-contents-hide', function() {

        var $toc = $(this).parents('.table-of-contents');

        $toc.toggleClass('open');
        if ( $toc.hasClass('open') ) {
            eraseCookie( 'wpshop_toc_hide' );
            $('.js-table-of-contents-list').slideDown();
        } else {
            createCookie( 'wpshop_toc_hide', 'hide' );
            $('.js-table-of-contents-list').slideUp();
        }

    });
    $(document).on('click', '.table-of-contents a[href*="#"]', function(e){
        var fixed_offset = 100;
        $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 500);
        e.preventDefault();
    });



    /**
     * Open social links
     */
    $('.js-social-link').click(function(){
        var href = jQuery(this).data('uri');
        window.open(href, '_blank');
    });



    /**
     * Single paged
     */
    if ( $('body').hasClass('single-paged') ) {
        var destination = $('#main').offset().top;
        $('html,body').animate( { scrollTop: destination }, 800 );
    }


    /**
     * Menu
     */
    var $hamburger = $('.mob-hamburger');
    var $menu = $('#site-navigation');
    var $header_menu = $('#header_menu');
    var $top_menu = $('#top_menu');
    var $sidebar_menu = $('.widget-mobile-menu ul');

    var $to_mob_menu = $top_menu.clone();
    var $to_mob_menu_sidebar_menu = $sidebar_menu.clone();
    $to_mob_menu.find('li').addClass('only-hamburger');
    $to_mob_menu_sidebar_menu.find('li').addClass('only-hamburger');

    $hamburger.on('click', function(){
        $hamburger.toggleClass('active');
        $menu.slideToggle();
    });


    /**
     * Mob menu transfer
     */
    $header_menu.prepend( $to_mob_menu.html() );
    $header_menu.append( $to_mob_menu_sidebar_menu.html() );


    /**
     * Menu fixed
     */
    $("#site-navigation").clone().attr('id', '').addClass("site-navigation-fixed").appendTo('body');
    $('.site-navigation-fixed').hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > $(".site-header").outerHeight() && $(window).width() > 974) {
            $('.site-navigation-fixed').show();
            $('.site-navigation-fixed').css( 'width', $("#site-navigation").outerWidth() );
            $('.site-navigation-fixed').css( 'left', $("#site-navigation").offset().left );
        } else {
            $('.site-navigation-fixed').hide();
        }
    });

    $(window).resize(function(){
        if ( $('.site-navigation-fixed').is(':visible') ) {
            $('.site-navigation-fixed').css( 'width', $("#site-navigation").outerWidth() );
            $('.site-navigation-fixed').css( 'left', $("#site-navigation").offset().left );
        }
    })


    /**
     * Pseudo links
     */
    jQuery(document).on('click', '.js-link', function (event) {
        var href = jQuery(this).data('href');

        if ( href.substring(0,4) != 'http' ) {
            var base64 = base64_decode(href);
            if ( base64.substring(0,4) == 'http' ) {
                href = base64;
            }
        }

        var target = 'self';
        if ( jQuery(this).data('target') == 'blank' || jQuery(this).data('target') == '_blank' ||
             jQuery(this).attr('target') == 'blank' || jQuery(this).attr('target') == '_blank' ) {
            target = 'blank';
        }

        if ( target == 'blank' ) {
            window.open( href );
        } else {
            document.location.href = href;
        }
    });



    /**
     * Scroll to top
     */
    $(".js-scrolltop").click(function () {
        return $("body,html").animate({
            scrollTop: 0
        }, 500), !1
    }), $(window).scroll(function () {
        $(this).scrollTop() > 100 ? $(".js-scrolltop").fadeIn() : $(".js-scrolltop").fadeOut()
    });


    /**
     * Dropdown menu
     */
    var timer;
    var width = $(window).width();

    if ( width > 991 ) {

        jQuery('.main-navigation .menu-item a, .main-navigation .menu-item .removed-link').on('mouseenter', function () {
            jQuery(this).parent().parent().find('.sub-menu:visible').hide();
            jQuery(this).parent().find('.sub-menu:first').show();
            clearTimeout(timer);
        });

        jQuery('.main-navigation').on({
            mouseenter: function () {
                clearTimeout(timer);
            },
            mouseleave: function () {
                timer = setTimeout(hideMenu, 400);
            }
        });

    }

    function hideMenu() {
        jQuery('.main-navigation .menu-item .sub-menu, .sidebar-navigation .menu-item .sub-menu').slideUp(200);
    }



    if ( width <= 991 ) {

        $('#site-navigation').on('click', '.menu-item-has-children', function (e) {
            if ( e.target.nodeName != 'A' && e.target.nodeName != 'a' ) {
                e.stopPropagation();
                $(this).toggleClass('open');
                $(this).find('.sub-menu:first').slideToggle();
            }
        });

        $('#footer_menu').on('click', '.menu-item-has-children', function (e) {
            if ( e.target.nodeName != 'A' && e.target.nodeName != 'a' ) {
                e.stopPropagation();
                $(this).toggleClass('open');
                $(this).find('.sub-menu:first').slideToggle();
            }
        });

    }
	
	$('.sidebar-navigation').on('click', '.menu-item-has-children', function (e) {
        if ( e.target.nodeName != 'A' && e.target.nodeName != 'a' ) {
            e.stopPropagation();
            $(this).toggleClass('open');
            $(this).find('.sub-menu:first').slideToggle();
        }
    });



    /**
     * Pseudo links
     */
    $('.ps-link').click(function(){
        var uri = base64_decode( $(this).data("uri") );
        window.open(uri);
    });


    /**
     * Urlspan
     */
    function GoTo(link){window.open(link.replace("_","http://"));}


    /**
     * Social link share
     */
    $('.js-share-link').click(function(){
        if ( ! $(this).hasClass('js-share-link-no-window') ) {
            openWin($(this).data("uri"));
        } else {
            window.location.href = $(this).data("uri");
        }
    });

    function openWin( url ) {
        var features, w = 626, h = 436;
        var top = (screen.height - h)/2, left = (screen.width - w)/2;
        if(top < 0) top = 0;
        if(left < 0) left = 0;
        features = 'top=' + top + ',left=' +left;
        features += ',height=' + h + ',width=' + w + ',resizable=no';
        open(url, 'displayWindow', features);
    }


    /**
     * Spoiler
     */
    $('.js-spoiler-box-title').click(function(){
        var $this = $(this);
        $this.toggleClass('active').next().slideToggle();
    })


    /**
     * Smiles
     */
    $('.js-comment-smiles img').click(function(){
        var $this = $(this);
        $('#comment').val( $('#comment').val() + ' ' + $this.prop('alt') + '' );
    }).on('dragstart', function(event) { event.preventDefault(); });


    /**
     * Adaptive videos
     */
    responsiveIframe();
    $(window).resize(function(){
        responsiveIframe();
    });

    function responsiveIframe() {
        $('.entry-content iframe, .responsive-iframe iframe').each(function(){

            if ( $(this).parents('.not-responsive').length ) return;

            var iw = $(this).width();
            var ih = $(this).height();
            var ip = $(this).parent().width();
            var ipw = ip/iw;
            var ipwh = Math.round(ih*ipw);
            $(this).css({
                'width': ip,
                'height' : ipwh
            });
        });
    }

});



/**
 * Urlspan
 */
function GoTo(link){window.open(link.replace("_","http://"));}



// Функция декодирования строки из base64
function base64_decode (encodedData) { // eslint-disable-line camelcase
                                        //  discuss at: http://locutus.io/php/base64_decode/
                                        // original by: Tyler Akins (http://rumkin.com)
                                        // improved by: Thunder.m
                                        // improved by: Kevin van Zonneveld (http://kvz.io)
                                        // improved by: Kevin van Zonneveld (http://kvz.io)
                                        //    input by: Aman Gupta
                                        //    input by: Brett Zamir (http://brett-zamir.me)
                                        // bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)
                                        // bugfixed by: Pellentesque Malesuada
                                        // bugfixed by: Kevin van Zonneveld (http://kvz.io)

    if (typeof window !== 'undefined') {
        if (typeof window.atob !== 'undefined') {
            return decodeURIComponent(escape(window.atob(encodedData)))
        }
    } else {
        return new Buffer(encodedData, 'base64').toString('utf-8')
    }

    var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/='
    var o1
    var o2
    var o3
    var h1
    var h2
    var h3
    var h4
    var bits
    var i = 0
    var ac = 0
    var dec = ''
    var tmpArr = []

    if (!encodedData) {
        return encodedData
    }

    encodedData += ''

    do {
        // unpack four hexets into three octets using index points in b64
        h1 = b64.indexOf(encodedData.charAt(i++))
        h2 = b64.indexOf(encodedData.charAt(i++))
        h3 = b64.indexOf(encodedData.charAt(i++))
        h4 = b64.indexOf(encodedData.charAt(i++))

        bits = h1 << 18 | h2 << 12 | h3 << 6 | h4

        o1 = bits >> 16 & 0xff
        o2 = bits >> 8 & 0xff
        o3 = bits & 0xff

        if (h3 === 64) {
            tmpArr[ac++] = String.fromCharCode(o1)
        } else if (h4 === 64) {
            tmpArr[ac++] = String.fromCharCode(o1, o2)
        } else {
            tmpArr[ac++] = String.fromCharCode(o1, o2, o3)
        }
    } while (i < encodedData.length)

    dec = tmpArr.join('')

    return decodeURIComponent(escape(dec.replace(/\0+$/, '')))
}

function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}