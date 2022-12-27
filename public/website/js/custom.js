$(document).ready(function () {
    $('.js-tilt').tilt();
    $('.main-menu-toggle').click(function() {

        $(this).parent('.container').children('.main-menu-container-collapse').first().slideToggle('1000');
    });
    /* **
     * Sub Menu
     **/
    $('nav .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-plus"></i> </span>');
    $('nav .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fa fa-plus"></i> </span>');

    $('nav .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    $('.navbar .sub-toggle-children').click(function() {
        $(this).parent('.page_item_has_children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    /* **
     * Category Menu
     **/
    $('.hitStore_main_category_nav .hitStore_main_category_title h3').append('<span class="cat-toggle"> <i class="fa fa-arrow-down"></i> </span>');
    $('.hitStore_main_category_nav .cat-toggle').click(function() {

        $(this).parent().parent().parent('.hitStore_main_category_nav').children('.menu-product-category-container').first().slideToggle('1000');
        $(this).children('.fa-arrow-down').first().toggleClass('fa-arrow-up');
    });

    $('.hitStore_main_category_nav .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-plus"></i> </span>');
    $('.hitStore_main_category_nav .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fa fa-plus"></i> </span>');

    $('.hitStore_main_category_nav .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    $('.navbar .sub-toggle-children').click(function() {
        $(this).parent('.page_item_has_children').children('ul.sub-menu').first().slideToggle('1000');
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });


    /*TAB*/
    $('ul.tabs li').click(function () {
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })
    /**
     * Banner Slider
     */
    $('.hitStoreslider').lightSlider({
        item: 1,
        loop: true,
        auto: true,
        speed: 3000,
        mode: 'fade',
        trl: true,
        pause: 3000
    });

    $( "#category-accordion" ).accordion();




    /*------------------------------------
     Shopping Cart Area
     --------------------------------------*/

    $('.hitStore_cart_icon').on('click', function () {
        $('.shopping__cart').addClass('shopping__cart__on');
        $('.body__overlay').addClass('is-visible');

    });

    $('.offsetmenu__close__btn').on('click', function () {
        $('.shopping__cart').removeClass('shopping__cart__on');
        $('.body__overlay').removeClass('is-visible');

    });

    /*------------------------------------
     User Meta
     --------------------------------------*/
    /* $('.hitStore_user_account_icon').on('click', function () {
     $('.user__meta').addClass('user__meta__on');
     $('.body__overlay').addClass('is-visible');

     });*/
    $('.offsetmenu__user__meta__close__btn').on('click', function () {
        $('.user__meta').removeClass('user__meta__on');
        $('.body__overlay').removeClass('is-visible');
    });


    // Product Zoom Effect
    $("#zoom").elevateZoom({
        gallery:'album',
        cursor: 'pointer',
        zoomType: "inner",
        zoomWindowFadeIn: 200,
        zoomWindowFadeOut: 250,
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomType: "lens",
        lensShape: "rectangle",
        lensSize: 300,
    });

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    // Increase and Descreace input value
    $('.add_qty').click(function () {
        $(this).prev().val(+$(this).prev().val() + 1);
    });
    $('.sub_qty').click(function () {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    });
});