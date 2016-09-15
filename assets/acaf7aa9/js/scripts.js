$(function(){

    var mql = window.matchMedia( 'only screen and (min-device-width : 320px) and (max-device-width : 1024px) and (orientation : landscape)' ),
        mqp = window.matchMedia( 'only screen and (min-device-width : 320px) and (max-device-width : 1024px) and (orientation : portrait)' ),
        padd = $('html').outerHeight() - $('header').outerHeight() - $('.item-row').outerHeight() - 20;

    equlize = function() {
        $('.gallery-wrap .photo-wrap.jsonly').each(function(i){
            var ithis = $(this),
                cent = ithis.find('input.ratio').val() / 100;

            ithis.css({width: cent * 100 + '%'});

            var hig = parseInt(ithis.outerHeight()),
                wid = parseInt(ithis.outerWidth()),
                firhig = parseInt($('.gallery-wrap .photo-wrap.jsonly:first-of-type').outerHeight());

            if (hig != firhig) {
                ithis.css({width: cent * 100 * (wid - (wid/hig)*(hig - firhig)) / wid + '%'});
            }

            ithis.css({opacity: 1});

        });
    };

    draw = function(wrap) {
        $('.cat-wrap')
            .animate({
                minHeight: wrap.outerHeight()
            },{
                duration: 1500,
                progress : function(){
                    if ( $('.photo-wrap.jsonly').length > 0 ) {
                        var diff = ($(this).offset().top + $(this).outerHeight()) - ($('.photo-wrap.jsonly:first-of-type').offset().top + $('.photo-wrap.jsonly:first-of-type').outerHeight());

                        if ( diff > 0 ) {
                            $('.photo-wrap.jsonly .photo').each(function(i){
                                var ithis = $(this);
                                setTimeout(function(){
                                    ithis.addClass('w');
                                    setTimeout(function(){
                                        ithis.addClass('h');
                                    }, 100);
                                }, i*200);
                                ithis.find('img').animate({left: 0}, 500);
                            });
                        }
                    }

                    if ( $('.bio-item').length > 0 ) {
                        var biff = ($(this).offset().top + $(this).outerHeight()) - ($('.bio-item').offset().top + $('.bio-item').outerHeight());

                        if ( biff > 0 ) {
                            $('.bio-item').addClass('w');
                            setTimeout(function(){
                                $('.bio-item').addClass('h');
                            }, 100);
                        }
                    }
                }
            });
    }

    if (!mql.matches && !mqp.matches) {

        window.onload = function() {
            equlize();

            $('.exhib-wrap .gallery-wrap').css({'padding-bottom': padd});

            if ( $('.main-wrap').outerHeight() >= $('main').outerHeight() ) {
                draw($('.main-wrap'));
            } else {
                draw($('main'));
            }

            $('.photo-show.jsonly').animate({opacity: 1}, 1000);

            setTimeout(function(){
                $('.cat-wrap').css({height: 'auto'});

                if ( $('.cat-wrap').outerHeight() < $('main').outerHeight() && $('.main-wrap').outerHeight() > $('main').outerHeight() ) {
                    $('.cat-wrap').css({position: 'fixed'});
                }

                if ( $('.main-wrap').outerHeight() < $('main').outerHeight() && $('.cat-wrap').outerHeight() > $('main').outerHeight() ) {
                    $('.main-wrap').css({position: 'fixed'});
                }

            }, 2000);

            $(document).mousemove(function(e){
                $('.vl').css({left: e.pageX - 1});
                $('.hl').css({top: e.pageY - 1});
                $('.xl, .xx, .cc').css({left: e.pageX - 1, top: e.pageY - 1});
            });

            $('html')
                .on('mouseover', 'a, .menu-togg, .menu-close, .photo-count, .photo-next, .feed-mob, .fa, .btn, .form-control, .fancybox-prev, .fancybox-next, .fancybox-prev span, .fancybox-next span, .fancybox-close, #fancybox-thumbs li', function(){
                    $('.xl').stop().fadeOut();
                    $('.xx').css({'background-color': '#fff'});
                    $('.vl, .hl').css({'border-color': 'rgba(255,255,255,0.25)'});
                })
                .on('mouseleave', 'a, .menu-togg, .menu-close, .photo-count, .photo-next, .feed-mob, .fa, .btn, .form-control, .fancybox-prev, .fancybox-next, .fancybox-prev span, .fancybox-next span, .fancybox-close, #fancybox-thumbs li', function(){
                    $('.xl').stop().fadeIn();
                    $('.xx').css({'background-color': '#555'});
                    $('.vl, .hl').css({'border-color': 'rgba(255,255,255,0.1)'});
                });

        }

        window.onresize = function() {
            equlize();
        };

        $('main').scroll(function() {
            var scrol = $(this).scrollTop(),
                endpos = $('.item-row').outerHeight();

            $('.item-row').each(function(i) {
                if ( scrol > endpos*(i - 1/2) && scrol <= endpos*(i + 1/2) ) {
                    $(this).css('opacity', 1);
                } else {
                    $(this).css('opacity', 0.1);
                }
            });

            if ( scrol > 0 ) {
                $('header').addClass('s');
            } else {
                $('header').removeClass('s');
            }
        });

    } else {
        window.onload = function() {
            $('.cat-wrap').css('min-height', $('body').outerHeight());
            setTimeout(function(){ $('.bg-body').removeClass('fsm'); }, 1500);
        }
        window.onresize = function() {
            $('.cat-wrap').css('min-height', $('body').outerHeight());
        };
    }

    $('#feedback').on('submit', function(e){
        e.stopImmediatePropagation();
        var form = $(this);

        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(json) {
                if (json == 'true') {
                    $("#feed-modal").modal('hide');
                    setTimeout(function() {
                        $('#feed-success').modal({show:true});
                    }, 1000);
                    $('#feedback')[0].reset();
                    setTimeout(function() {
                        $("#feed-success").modal('hide');
                    }, 3000);
                }else{
                  form.yiiActiveForm('submitForm');
                }
            }
        });

        return false;
    });

    Share = {
        me: function(el) {
          console.log(el.href);
          Share.popup(el.href);
          return false;
        },
        popup: function(url) {
            window.open(url,'','toolbar=0,status=0,width=626,height=436');
        }
    };
});
