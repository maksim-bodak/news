"use strict";
function setVideoHeights() {

    // youtube
    jQuery(document).find('iframe[src*="youtube.com"]').each(function() {
        jQuery(this).css('height', jQuery(this).attr('width', '100%').width() * 0.56, 'important');
    })

    // vimeo
    jQuery(document).find('iframe[src*="vimeo.com"]').each(function() {
        jQuery(this).css('height', jQuery(this).attr('width', '100%').width() * 0.56, 'important');
    })

    // youtube
    jQuery(document).find('iframe[src*="dailymotion.com"]').each(function() {
        jQuery(this).css('height', jQuery(this).attr('width', '100%').width() * 0.56, 'important');
    })

}

"use strict";
// Ajax Post Views Counter
var miptheme_ajax_post_views = {

    get_post_views : function get_post_views (post_array_ids) {
        jQuery.ajax({
            type: 'POST',
            url: miptheme_ajax_url.ajaxurl,
            cache: true,
            data: {
                action: "miptheme_ajax_update_views",
                post_ids: post_array_ids
            },
            success: function(data, textStatus, XMLHttpRequest){
                var ajax_post_counts = jQuery.parseJSON(data);//get the return dara

                if (ajax_post_counts instanceof Object) {
                    jQuery.each(ajax_post_counts, function(id_post, value) {
                        var current_post_count = ".post-view-counter-" + id_post;
                        jQuery(current_post_count).html(value);
                    });
                }
            },
            error: function(MLHttpRequest, textStatus, errorThrown){
            }
        });
    }

};


"use strict";
(function($) {

    // Load Retina images
    $(window).load(function() {
        $('[data-retina]').each(function() {

            var img = new Image();
            img.src = $(this).attr('data-retina');

            if(window.devicePixelRatio >= 2) {
                $(this).attr('src', img.src);
            }

        });
    });


    // Lazy Loading
    $('.bttrlazyloading').bttrlazyloading({
        backgroundcolor: '#fff',
        animation: 'fadeIn'
    });


    // Sticky Navigation
    $('#sticky-header').attr('data-offset-top', $('#header-branding').height() + $('#top-navigation').height() );
    $('.sticky-header-wrapper').height($("#sticky-header").height());
    $('#sticky-header').affix({
        offset: { top: $('#sticky-header').offset().top }
    });

    // Mobile Navigation
    $('nav#mobile-menu').mmenu({
        offCanvas: {
            position: "left",
            zposition : "front"
        },
        searchfield: false
    });


    // Navigation slide down
    $("#main-menu .nav li").hover(function(){
        $(this).stop(true, true).find('.dropnav-container, .subnav-container').slideDown(100);
    },function(){
        $(this).stop(true, true).find('.dropnav-container, .subnav-container').hide();
    });

    // Subnav article loader
    $('#main-menu .subnav-menu li:first-child').addClass('current');

    $('#main-menu .subnav-menu li').hover(function() {
        $(this).parent().find('li').removeClass('current');
        $(this).addClass('current');
    });

    //Click event to scroll to top
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });


    // Set Parallax header
    var parallax_img    = $('img.parallax-img');
    var lastScrollTop   = 0;
    $(window).scroll(function () {
        var st = $(window).scrollTop();
        parallax_img.css({'bottom':"-"+(st*.5)+"px"});

        var nHeaderHeight   = $('#wpadminbar').height() + $('#top-navigation').height() + $('#header-branding').height();
        if (($(this).scrollTop() >= nHeaderHeight)&&(st > lastScrollTop)) {
            $('#post-info-bar').addClass('scroll');
        } else {
            $('#post-info-bar').removeClass('scroll');
        }
        lastScrollTop = st;
    });

    var parallax_screen_ratio   = 0.61;
    if ( !(typeof(miptheme_parallax_image_height) === 'undefined') && miptheme_parallax_image_height) {
        var nVisibleContent     = (($(window).height() - $('#page-header').height())/$(window).height())*100;
        parallax_screen_ratio   = (miptheme_parallax_image_height > nVisibleContent) ? nVisibleContent/100 : miptheme_parallax_image_height/100;
    }
    $('#single-post-header-full .img-parallax, #top-grid .img-parallax').imageScroll({
        coverRatio: parallax_screen_ratio,
        mediaWidth: 1340,
    });

    // Init photobox
    $('.weekly-gallery').photobox('a',{ time:0 });
    $('.miptheme-gallery-photos').photobox('figure > a.pix',{ time:0 });
    $('#main').photobox('a.photobox',{ time:0 });


    // Init owl
    $('.owl-top-slider-carousel').owlCarousel({
        stagePadding: 50,
        navText: [ '', '' ],
        loop:true,
        margin:1,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            },
        }
    })


    // Load Weather
    if ( !(typeof(weather_widget) === 'undefined') && weather_widget) {
        $('#weather .temp').customOpenWeather({
            lang: ''+ weather_lang +'',
            city: ''+ weather_location +'',
            placeTarget: '#weather .location',
            units: ''+ weather_unit +'',
            descriptionTarget: '#weather .desc',
            iconTarget: '#weather i.icon',
            success: function() {
                $('#weather').show();
            },
            error: function(message) {
                console.log(message);
            }
        });
    }


    // Sticky Sidebar
    if ( !(typeof(miptheme_sticky_sidebar_margin) === 'undefined') && miptheme_sticky_sidebar_margin) {
        $('.sidebar').theiaStickySidebar({ 'additionalMarginTop': miptheme_sticky_sidebar_margin });
    }


    // Resize video iframes
    setVideoHeights();


    // Smooth Scrolling
    if ( !(typeof(miptheme_smooth_scrolling) === 'undefined') && miptheme_smooth_scrolling) {
        smooth_scroll();
    }

    // Stars rating
    $('span.raty').raty({
        readOnly: true,
        starType : 'i',
        score: function() {
            return $(this).attr('data-score');
        }
    });




    // Ajax paging
    $('.mip-ajax-nav a').click(function(e){
        e.preventDefault();
        var element             = this;
        var nIndex              = parseInt( $(this).attr('data-index') );
        var sContainer          = '#'+ $(this).attr('data-container');
        var nMaxPages           = parseInt( $(sContainer).attr('data-max-pages') );

        if ( (nIndex == 0) || (nIndex == nMaxPages )) { return; }

        //search the cache
        var currentContainerObj = JSON.stringify(sContainer +'-'+ $(this).attr('data-index'));
        if ( mipthemeLocalCache.exist(currentContainerObj) ) {
            processResponse( mipthemeLocalCache.get(currentContainerObj), element, sContainer );
            return;
        }

        var sContainerArticles  = sContainer + ' .articles';
        var sArticles           = sContainerArticles + ' article';
        $.ajax({
            url: miptheme_ajax_url.ajaxurl,
            type: 'post',
            data: {
                action: 'miptheme_ajax_blocks',
                data_block: $(sContainer).attr('data-block'),
                data_index: $(this).attr('data-index'),
                data_cat: $(sContainer).attr('data-cat'),
                data_count: $(sContainer).attr('data-count'),
                data_count_img: $(sContainer).attr('data-count-img'),
                data_offset: $(sContainer).attr('data-offset'),
                data_tag: $(sContainer).attr('data-tag'),
                data_sort: $(sContainer).attr('data-sort'),
                data_display: $(sContainer).attr('data-display'),
                data_img_format_1: $(sContainer).attr('data-img-format-1'),
                data_img_format_2: $(sContainer).attr('data-img-format-2'),
                data_img_width_1: $(sContainer).attr('data-img-width-1'),
                data_img_width_2: $(sContainer).attr('data-img-width-2'),
                data_img_height_1: $(sContainer).attr('data-img-height-1'),
                data_img_height_2: $(sContainer).attr('data-img-height-2'),
                data_text: $(sContainer).attr('data-text'),
                data_text_img: $(sContainer).attr('data-text-img'),
                data_columns: $(this).attr('data-columns'),
                data_layout: $(this).attr('data-layout'),
                data_meta: $(this).attr('data-meta')
            },
            beforeSend: function() {
                $(sArticles).addClass('ajax-opacity');
                $(sContainerArticles).append('<span class="ajax-loading"><div class="loader">Loading...</div></span>');
                $(sContainerArticles).wrapInner( $( '<aside class="clearfix"></aside>' ) );
                $(sContainerArticles).css( 'height', ''+ $('aside:first',sContainerArticles).height() +'px' );
            },
            complete: function( xhr, status ) {
                $(sContainerArticles + ' .ajax-loading').remove();
            },
            success: function( data ) {
                mipthemeLocalCache.set(currentContainerObj, data);
                processResponse( data, element, sContainer );
            }
        })
    });


    function processResponse( data, element, sContainer ) {
        var sContainerArticles  = sContainer + ' .articles';
        var sArticles           = sContainerArticles + ' article';

        $(sContainerArticles).removeClass('animated fadeIn');
        $(sContainerArticles).fadeOut(800, function() {
            $(sArticles).remove();
            $(sContainerArticles).html( '<aside class="clearfix">'+ data +'</aside>' ).addClass('animated fadeIn').show();
        });

        if ( $(element).hasClass('prev') ) {
            setPrevIndex( sContainer );
        } else {
            setNextIndex( sContainer );
        }

        setTimeout(function() {
            var newheight = $('aside:first',$(sContainerArticles)).height();
            $(sContainerArticles).animate( {height: newheight} );
            if (newheight > $(window).height()) {
                $("html, body").stop().animate({ scrollTop: $( sContainer ).offset().top - 30 }, 1000);
            }
            $(sContainerArticles + ' span.raty').raty({
                readOnly: true,
                starType : 'i',
                score: function() {
                    return $(this).attr('data-score');
                }
            });
        }, miptheme_ajaxpagination_timer);

    }


    function setNextIndex( sContainer ) {
        $(sContainer + ' .mip-ajax-nav a').removeClass('disabled');
        var sPrev   = sContainer + ' .mip-ajax-nav a.prev';
        var sNext   = sContainer + ' .mip-ajax-nav a.next';
        $(sPrev).attr('data-index', parseInt($(sPrev).attr('data-index'))+1);
        $(sNext).attr('data-index', parseInt($(sNext).attr('data-index'))+1);
        if ( $(sNext).attr('data-index') == $(sContainer).attr('data-max-pages') ) {
            $(sNext).addClass('disabled');
        }
    }

    function setPrevIndex( sContainer ) {
        $(sContainer + ' .mip-ajax-nav a').removeClass('disabled');
        var sPrev   = sContainer + ' .mip-ajax-nav a.prev';
        var sNext   = sContainer + ' .mip-ajax-nav a.next';
        $(sPrev).attr('data-index', parseInt($(sPrev).attr('data-index'))-1);
        $(sNext).attr('data-index', parseInt($(sNext).attr('data-index'))-1);
        if ( $(sPrev).attr('data-index') == 0 ) {
            $(sPrev).addClass('disabled');
        }
    }

    $('.user_rating_range').each(function() {
        $(this).noUiSlider({
    		range: {
    			  'min': 0,
    			  'max': 10
    			},
    		step: 1,
    		start: 0,
    		connect: "lower",
    	});
    	$(this).on({
    		set: function(){
    			var score_criteria = 0;
    			var count_criterias = 0;
                var nIndex = 0;
    			$('.user_rating_range').each(function(i) {
    				score_criteria += parseInt($(this).val());
    				count_criterias ++;

    			});
    			var average_criteria = Math.round(score_criteria / count_criterias) ;
    			$('.user_total_score span').html(average_criteria);
                $(".raty_criteria_score_"+$(this).attr('data-index')).attr("data-score", parseInt($(this).val()));
    		}
    	});
    });

    $("#comment-user-reviews").find(".user_rating_range").each(function(i) {
        $(this).Link('lower').to($(".user_criteria_hidden_"+(i+1)), null, wNumb({decimals: 0}));
    	$(this).Link('lower').to($(".raty_criteria_score_"+(i+1)), null, wNumb({decimals: 0}));
    });

    // Post Info Bar
    $('#post-info-bar-sharing').click(function() {
        $('#soc-sharing-fullscreen-overlay').addClass('active');
    });
    $('#soc-sharing-fullscreen-overlay').click(function() {
        $('#soc-sharing-fullscreen-overlay').removeClass('active');
    });


})(jQuery);
