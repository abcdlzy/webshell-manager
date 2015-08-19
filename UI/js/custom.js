var menuState = 1;
$(document).ready(function(){

    // Normal Slider Starts
    $(".slider").nivoSlider({
        effect:"random",
        slices:15,
        boxCols:8,
        boxRows:4,
        animSpeed:500,
        pauseTime:3000,
        startSlide:0,
        directionNav:true,
        controlNav:false,
        controlNavThumbs:false,
        pauseOnHover:true,
        manualAdvance:false,
        prevText:'',
        nextText: ''
    });
    // Normal Slider Ends

    // Metro Slider Starts
    var metroSlider = 0;
    $('.metro-slider .col').each(function(){
        metroSlider = metroSlider + 670;
    });
    $('.metro-slider').css('width',metroSlider+'px');

    $('.metro-wrapper').tinyscrollbar({
        axis: 'x',
        size: 'auto'
    });
    // Metro Slider Ends




    // Side Menu Opener Starts
    $('#opener').click(function(){

        var subLevel = $('#subLevel');
        var activeMenu = $('.active-menu-item');

        if(subLevel.hasClass('active-sub-level')){

            if(activeMenu.length > 0){

                activeMenu.removeClass('active-menu-item background-color');
                subLevel.children('ul').fadeOut('fast');

            }

            subLevel.removeClass('active-sub-level');
            $(this).children('div').removeClass('opener-minus').addClass('opener-plus');

        }else{

            subLevel.addClass('active-sub-level');
            $(this).children('div').removeClass('opener-plus').addClass('opener-minus');

        }

    });
    // Side Menu Opener Ends

    // Responsive Menu Starts
    $('ul#menu > li > .menu-specs > a').on('click touchend',function(e){


        var link        = $(this).attr('href');
        var li          = $(this).parent('div').parent('li');
        var regExp      = /\#/g;
        var bodyWidth   = parseInt( $('body').css('width').replace('px') );

        if(regExp.test(link)){

            if(bodyWidth > 800){

                if(!li.hasClass('active-menu-item')){

                    $('.active-menu-item').removeClass('active-menu-item background-color');
                    li.addClass('active-menu-item background-color');

                    if($('.active-sub-level').length < 1){

                        $('#opener').click();

                    }

                    $('.active-sub-level ul').hide();
                    $(link).fadeIn()

                }

            }else{

                if(li.children('ul').css('display') == 'block'){
                    li.children('ul').slideUp();
                }else{
                    $('ul#menu > li > ul').slideUp();
                    li.children('ul').slideDown();
                }

            }

            e.preventDefault();

        }

    });
    // Responsive Menu Ends

    $('ul.menu > li').on('click touchend',function(e){


        var ul         = $(this).parent('ul');
        var regExp      = /\#/g;
        var bodyWidth   = parseInt( $('body').css('width').replace('px') );

        $('ul.menu > li').removeClass('active');

        $(this).addClass('active');
        e.preventDefault();


    });

    // shell Menu Starts
    $('div#shell_list > div').on('click touchend',function(e){


        var div         = $(this).parent('div');
        var regExp      = /\#/g;
        var bodyWidth   = parseInt( $('body').css('width').replace('px') );

        $('div#shell_list>div.shell-list-item.background-color').removeClass('background-color');

        $(this).addClass('background-color');
            e.preventDefault();


    });
    // shell Menu Ends

    // Accordion Menu Starts
    $('.accordion-head').click(function(){

        var theToggler  = $(this).children('.accordion-toggler');
        var theText     = $(this).next('.accordion-text');
        var activeItem  = $('.active-item');

        if(theToggler.hasClass('active-item')){

            theToggler.removeClass('active-item');
            theText.slideUp();

        }else{

            activeItem.parent('.accordion-head').next('.accordion-text').slideUp();
            activeItem.removeClass('active-item');

            theToggler.addClass('active-item');
            theText.slideDown();
        }

    });
    // Accordion Menu Ends

    // Sideway Tabbed Content Starts
    $('.sideway-controls li').click(function(){

        var theToggler  = $(this).attr('data-sideway-index');
        var activeOne   = $('.active-sideway-item');

        if(!$(this).hasClass('active-sideway-item')){

            activeOne.removeClass('active-sideway-item');
            $('.active-sideway-content').removeClass('active-sideway-content');

            $(this).addClass('active-sideway-item');
            $('.sideway-description-content:nth-child('+theToggler+')').addClass('active-sideway-content');

        }

    });
    // Sideway Tabbed Content Ends

    // Comment Toggler Starts
    $('#comments').click(function(){

        var clickedBut = $(this);

        if(!clickedBut.hasClass('deactive')){

            $('#comment-form').removeClass('deactive');

            $('.comment-form').slideUp(function(){

                clickedBut.addClass('deactive');
                $('.comments').slideDown();

            });

        }

    });
    // Comment Toggler Ends

    // Comment Container Toggler Starts
    $('.blog-comments-toggler').toggle(function(){

        $(this).attr('theheight',$('.blog-post-comments').css('height'));

        $('.blog-post-comments').animate({
            height: '40px'
        });

        $(this).addClass('plus');

    },function(){

        $('.blog-post-comments').animate({
            height: $(this).attr('theheight')
        },1000,function(){
            $('.blog-post-comments').removeAttr('style');
        });

        $(this).removeClass('plus');

        $(this).removeAttr('theheight');

    });
    // Comment Container Toggler Ends

    // Comment Form Toggler Starts
    $('#comment-form').click(function(){

        var clickedBut = $(this);

        if(!clickedBut.hasClass('deactive')){

            $('#comments').removeClass('deactive');

            $('.comments').slideUp(function(){

                clickedBut.addClass('deactive');
                $('.comment-form').slideDown();

            });

        }

    });
    // Comment Form Toggler Ends

    // Popular Blogs Toggle Content Starts
    if($('#popular-blogs').length > 0){

        var parentHeight = 60;

        $('.popular-blogs .random-blog-item').each(function(){
            parentHeight = parentHeight + 30 + parseInt($(this).css('height').replace('px'));
        });

        $('.blog-posts-tab').css('height',parentHeight+'px');

    }
    // Popular Blogs Toggle Content Ends

    // Popular Blogs & Recent Blogs Tabbed Content Starts
    $('#popular-blogs,#recent-blogs').click(function(){

        var clickedObj = $(this);
        var parentObj = clickedObj.parent('div').parent('div');
        var parentHeight = 60;

        if(clickedObj.attr('id') == 'popular-blogs'){

            if(!clickedObj.hasClass('deactive')){

                $('.popular-blogs .random-blog-item').each(function(){
                    parentHeight = parentHeight + 30 + parseInt($(this).css('height').replace('px'));
                });

                parentObj.css('height',parentHeight+'px');

                $('.recent-blogs').removeClass('recent-blogs-active');
                $('.popular-blogs-passive').removeClass('popular-blogs-passive');
                $('#recent-blogs').removeClass('deactive');
                clickedObj.addClass('deactive');
            }

        }else{

            if(!clickedObj.hasClass('deactive')){

                $('.recent-blogs .random-blog-item').each(function(){
                    parentHeight = parentHeight + 30 + parseInt($(this).css('height').replace('px'));
                });

                parentObj.css('height',parentHeight+'px');

                $('.recent-blogs').addClass('recent-blogs-active');
                $('.popular-blogs').addClass('popular-blogs-passive');
                $('#popular-blogs').removeClass('deactive');
                clickedObj.addClass('deactive');

            }

        }

    });
    // Popular Blogs & Recent Blogs Tabbed Content Ends

    // HTML5 AJAX Contact Form
    $('.contact-form').bind('submit', function(){

        var form    = $(this);
        var me      = $(this).children('input[type=submit]');

        me.attr('disabled','disabled');

        $('.ajax-loader').fadeIn();

        $.ajax({

            type: "POST",
            url: "mail.php",
            data: form.serialize(),
            success: function(returnedInfo){

                var message = $('.contact-thank-you');

                returnedInfo == 1 ? message.show() : message.html('Our Mail Servers Are Currently Down').show();

                $('.ajax-loader').fadeOut();

                me.removeAttr('disabled');

            }

        });

        return false;

    });
    // HTML5 AJAX Contact Form Ends


    // Tabbed Content Starts
    $('.tab-links').children('a').addClass('not-active');
    $('.tab-links').children('a:first-child').removeClass('not-active').addClass('active');

    $('.tab-links a').click(function(e){
        switchTabs($(this));
        e.preventDefault();
    });
    // Tabbed Content Ends

    // Left Side Search Box Starts
    var bodyHeight = parseInt( $('.rightSide').css('height').replace('px','') );

    if(bodyHeight < 645){

        $('.search-and-misc').css('position','relative').css('margin-top','20px');

    }
    // Left Side Search Box Ends

});

// Tab Switcher Starts
function switchTabs(tab){

    var parent = tab.parent('.tab-links').parent('.tabs');

    parent.children('.tab-links').children('a.active').removeClass('active').addClass('not-active');
    tab.removeClass('not-active').addClass('active');

    parent.children('.contents').children('article').css('display','none');
    parent.children('.contents').children('article'+tab.attr('href')).css('display','block');

}
// Tab Switcher Ends

$(window).load(function(){

    $('body').css('visibility','visible');

    // OUR PARTNERS Carousel Starts
    if($(".partners-carousel-images").length > 0){

        $(".partners-carousel-images").carouFredSel({
            items: {visible : 6, width: 151, height : 100},
            direction: 'left',
            responsive: false,
            scroll: {
                items: 1,
                easing: 'elastic',
                duration: 1000,
                pauseOnHover: true
            },
            prev	: {
                button	: "#carousel-directioner-prev",  // The button which will trigger direction to left
                key		: "left"
            },
            next	: {
                button	: "#carousel-directioner-next",  // The button which will trigger direction to right
                key		: "right"
            }
        });

    }
    // OUR PARTNERS Carousel Ends

    widthCalc();

    // Isotope Options & Controls
    var $container = $('.gallery');

    $container.isotope({
        // options
        itemSelector : '.columns',
        layoutMode : 'fitRows'
    });


    // filter items when filter link is clicked
    $('#filters li a').click(function(){
        $('.active-isotope').removeClass('background-color border-color-darker active-isotope');
        $(this).addClass('background-color border-color-darker active-isotope');
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector });
        return false;
    });

});

$(window).resize(function(){

    widthCalc();

    // Metro Slider Responsiveness Fix Starts
    $('.metro-wrapper').tinyscrollbar({
        axis: 'x',
        size: 'auto'
    });
    // Metro Slider Responsiveness Fix Ends

});

function widthCalc(){

    if($('body').width() < 801){
        $('.rightSide').css('width','100%').css('width',($('body').width()-10)+'px');
    }else{
        $('.rightSide').css('width','100%').css('width',($('body').width()-255)+'px');
    }

    $('#menu > li > ul > li').css('width', ($('#menu > li').width()-20) +'px');
    $('#subLevel').css('height', '100%').css('height','-=5px');
    $('.lines').css('width', '100%').css('width','-=275px');
    $('.gray-box').css('width', '100%').css('width','-=40px');
    $('.gray-box-input').css('width', '100%').css('width','-=227px');
    $('.caroufredsel_wrapper').css('width', '77%').css('width','-=51px');
    $('.footer').css('width', '100%').css('width','+=10px');
    $('.accordion-title').css('width', '100%').css('width','-=40px');
    $('.sideway-description').css('width', '100%').css('width','-=260px');
    $('.random-blog-item').css('width', '100%').css('width','-=20px');
    $('.random-blog-title').css('width', '100%').css('width','-=60px');
    $('.random-blog-descr').css('width', '100%').css('width','-=60px');
    $('.comments').css('width', '100%').css('width','-=20px');
    $('.name-and-message').css('width', '100%').css('width','-=50px');
    $('.sub-comment').css('width', '100%').css('width','-=20px');
    $('.sub-comment .name-and-message').css('width', '100%').css('width','-=65px');
    $('.tabs .contents .article').css('width', '100%').css('width','-=30px');
    $('.message-box').css('width', '100%').css('width','-=5px');
    $('.message-text').css('width', '100%').css('width','-=80px');
    $('.portfolio-title').css('width', '90%');
    $('.portfolio-subtitle').css('width', '90%');
    $('.metro-misc').css('width', '100%').css('width','-=71px');

}

function closeThis(menu){
    menu.slideUp();
}

// Back to top Starts
$(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#toTop').fadeIn('slow');
        } else {
            $('#toTop').fadeOut('slow');
        }
    });

    $('#toTop').click(function() {
        $('body,html').animate({scrollTop:0},800);
    });
});
// Back to top Ends