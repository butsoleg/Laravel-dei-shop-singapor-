/*
 Template Name: Groci - Organic Food & Grocery Market Template
 Author: Askbootstrap
 Author URI: https://themeforest.net/user/askbootstrap
 Version: 1.1
 */
$(document).ready(function () {
    "use strict";

    var input_changed = false;

    //header menu
    $('.osahan-menu .btnDropdown').on('click', function (e) {
        e.preventDefault();
        console.log('click')
        $(this).parents('li').removeClass('show');
        $(this).parents('li').removeClass('show');
    });

    //header search
    //function check if element in a view
    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();

        var elemTop = $(elem).offset().top;
        var elemBottom = elemTop + $(elem).height();

        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    }
    $(document).on('scroll', function () {
        if (!isScrolledIntoView($('.searchAnchor'))) {
            $('.osahan-menu .search-block').addClass('show');
            input_changed = false;
        } else {
            if ($('.osahan-menu .search-block').hasClass('show')) {
                $('#search-content-header-block').removeClass('show');
                input_changed = false;
            }
            $('.osahan-menu .search-block').removeClass('show');
        }
    })

    //toggle about text
    $('body').on('click', 'section.store-header .about .more', function(e){
        $(this).closest('.about').find('.short').hide();
        $(this).closest('.about').find('.full').fadeIn("slow");
        $(this).hide();
    });

    $('body').on('click', 'section.store-header .about .less', function(e){
        $(this).closest('.about').find('.short').fadeIn("slow");
        $(this).closest('.about').find('.full').hide();
        $('section.store-header .about .more').fadeIn("slow");
    });

    //dropdown search scroll
    $('.search-content').overlayScrollbars({
        autoUpdate: true,
        autoUpdateInterval   : 33, 
        overflowBehavior : {
            x : "scroll",
            y : "scroll"
        },
        scrollbars : {
            visibility       : "visible",
            autoHide         : "never",
            autoHideDelay    : 800,
            dragScrolling    : true,
            clickScrolling   : false,
            touchSupport     : true,
            snapHandle       : false
        },
        callbacks : {
            onInitialized               : function() {

            },
            onInitializationWithdrawn   : null,
            onDestroyed                 : null,
            onScrollStart               : null,
            onScroll                    : null,
            onScrollStop                : null,
            onOverflowChanged           : function() {
                console.log('changed')
            },
            onOverflowAmountChanged     : null,
            onDirectionChanged          : null,
            onContentSizeChanged        : null,
            onHostSizeChanged           : null,
            onUpdated                   : null
        }
    }).overlayScrollbars();

    //show search result on input change
    $('.inputChange').on('input', function (e) {
        e.preventDefault();
        if (input_changed) {
            input_changed = false;
        } else {
            var elem = $(this);
            if (elem.val().length > 1) {
                input_changed = true;
                var form_data = new FormData();
                var csrf_token = $('meta[name=csrf-token]').attr('content');
                var search = elem.val();
                form_data.append('search', search);
                form_data.append('_token', csrf_token);
                $.ajax({
                    url: $('#base_url').val() + "/autocomplete",
                    data: form_data,
                    type: 'POST',
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    success: function (result) {
                        if (result.status === 'success') {
                            //                        console.log('autocomplete result: ' + JSON.stringify(result.result));
                            showAutocomplete(result.result, elem);
                        } else if (result.status === 'error') {
                            $('#image-errormsg').html(result.message);
                            $('#image-error').show();
                            setTimeout(function () {
                                $('#image-error').hide();
                            }, 3000);
                        } else {
                            $('#image-errormsg').html('Something went wrong, Please try again');
                            $('#image-error').show();
                            setTimeout(function () {
                                $('#image-error').hide();
                            }, 3000);
                        }
                    },
                    error: function (err) {
                        console.log(JSON.stringify(err));
                    }
                });
            }
        }
    })

    function showAutocomplete(response, elem) {
        var html = '';
        if (response.Brands.length > 0) {
            html += '<div class="block"><span class="title">Brands</span>';
            $(response.Brands).each(function (index, brand) {
                html += '<span class="result">' +
                        '<a href="' + $('#base_url').val() + '/brand/' + brand.id + '">' +
                        '<img width="40" style="margin-right: 10px;" class="img-fluid" src="' + brand.logo_url + '" alt="" />' +
                        '<span>' + brand.name + '</span>' +
                        '</a>' +
                        '</span>';
            });
            html += '</div>';
        }
        if (response.Categories.length > 0) {
            html += '<div class="block"><span class="title">Categories</span>';
            $(response.Categories).each(function (index, category) {
                html += '<span class="result">' +
                        '<a href="' + $('#base_url').val() + '/category/' + category.id + '">' +
                        '<img width="40" style="margin-right: 10px;" class="img-fluid" src="' + category.image_url + '" alt="" />' +
                        '<span>' + category.name + '</span>' +
                        '</a>' +
                        '</span>';
            });
            html += '</div>';
        }
        if (response.Merchants.length > 0) {
            html += '<div class="block"><span class="title">Merchants</span>';
            $(response.Merchants).each(function (index, merchant) {
                html += '<span class="result">' +
                        '<a href="' + $('#base_url').val() + '/merchant/' + merchant.id + '">' +
                        '<img width="40" style="margin-right: 10px;" class="img-fluid" src="' + merchant.logo_url + '" alt="" />' +
                        '<span>' + merchant.name + '</span>' +
                        '</a>' +
                        '</span>';
            });
            html += '</div>';
        }
        if (response.Products.length > 0) {
            html += '<div class="block">' +
                    '<span class="title">Products</span>' +
                    '<span class="result">' +
                    '<table class="table cart_summary">' +
                    '<tbody>';
            $(response.Products).each(function (index, product) {
                var product_image = "{{ asset('client/images/1.jpg') }}";// default product image
                if (product.image_url.length > 0)
                    product_image = product.image_url;
                html += '<tr>' +
                        '<td class="cart_product">' +
                        '<a href="' + $('#base_url').val() + '/product/' + product.id + '">' +
                        '<img class="img-fluid" src="' + product_image + '" alt="">' +
                        '</a>' +
                        '</td>' +
                        '<td class="cart_description">' +
                        '<h2>' + product.name + '</h2>' +
                        '<div class="price_block my_price">' +
                        '<p class="offer-price"><span class="text-success">S$ ' + product.price + '</span></p>' +
                        '</div>' +
                        '</td>';
                        // '<td class="availability in-stock">' +
                        // '<div class="product_detail">' +
                        // '<label>Quantity:</label>' +
                        // '<div id="field1">' +
                        // '<button type="button" id="sub" class="sub">-</button>' +
                        // '<input type="text" id="1" value="1" min="1" max="20">' +
                        // '<button type="button" id="add" class="add">+</button>' +
                        // '</div>' +
                        // '</div>' +
                        // '</td>' +
                        // '<td class="action">' +
                        // '<a class="" data-original-title="Add to cart" href="#" title="" data-placement="top" data-toggle="tooltip"><i class="fas fa-shopping-cart"></i> </a>' +
                        // '</td>';
            });
            html += '</tbody></table></span></div>';
        }
        var form_name = elem.closest('form').attr('id');
        if (form_name === 'searchFormHeader') {
            $('#searchForm .inputChange').val(elem.val());
        } else {
            $('#searchFormHeader .inputChange').val(elem.val());
        }
        if (response.Brands.length > 0 || response.Categories.length > 0 || response.Merchants.length > 0 || response.Products.length > 0) {
            html += '<a class="search_btn" href="#">Show All Results</a>';
            $('#search-content-header-block').html(html);
            $('#search-content-block').html(html);
            if (form_name === 'searchFormHeader') {
                $('#search-content-header-block').addClass('show');
            } else {
                $('#search-content-block').addClass('show');
            }
        } else {
            $('#search-content-header-block').removeClass('show');
            $('#search-content-block').removeClass('show');
        }
    }

    //hide search result when click outside
    $(document).mouseup(function (e) {
        var container = $('.search-content.show');
        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('show');
        }
        input_changed = false;
    });

    //cart scroll
    $('.cart-sidebar-body').overlayScrollbars({});

    //scrolloverlay
    $('.customScroll').overlayScrollbars({});

    //sticky header
    if ($(window).width() > 992) {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 110) {
                $('.osahan-menu').addClass('sticky');
                $('body').addClass('fix');
            } else {
                $('.osahan-menu').removeClass('sticky');
                $('body').removeClass('fix');
            }
        });
    }

    // ===========Featured Owl Carousel============
    var objowlcarousel = $(".owl-demo");
    if (objowlcarousel.length > 0) {
        
        objowlcarousel.owlCarousel({
            items:1,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:6000,
            autoplayHoverPause:true,
            autoplaySpeed:1750,
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    dots: true,
                },
                1200: {
                    items: 1,
                },
            }
        });
    }




    // ===========Featured Owl Carousel============
    var owl = $(".featuredSlider");
    if (owl.length > 0) {
        owl.each(function () {
            var $this = $(this);
            $this.owlCarousel({
                responsive: {
                    0: {
                        items: 3,
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    767: {
                        items: 4,
                    },
                    1000: {
                        items: 6,
                    },
                    1200: {
                        items: 6,
                    },
                },
                lazyLoad: true,
                pagination: false,
                loop: true,
                dots: false,
                autoPlay: false,
                stopOnHover: true,
                // margin: 20,
                nav: false,
                navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
            });

            $this.parents('.featured_stores').find(".prev").click(function () {
                $this.trigger('prev.owl.carousel');
            });
            $this.parents('.featured_stores').find(".next").click(function () {
                $this.trigger('next.owl.carousel');
            });
        });
    }


    // ===========Featured Owl Carousel============
    var objowlcarousel = $(".newSlider");
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 3,
                },
                600: {
                    items: 3,
                    nav: false
                },
                767: {
                    items: 4,
                },
                1000: {
                    items: 6,
                },
                1200: {
                    items: 6,
                },
            },
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: false,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
        });
    }

    // Products carousel
    var productsSlider = $(".productsSlider");
    if (productsSlider.length > 0) {
        productsSlider.owlCarousel({
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                    nav: false
                },
                767: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1000: {
                    items: 6,
                },
                1201: {
                    items: 6,
                },
            },
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: false,
            navigation: true,
            stopOnHover: true,
            // margin: 10,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
        });
    }

    //Related products
    var relatedSlider = $(".relatedSlider");
    if (relatedSlider.length > 0) {
        relatedSlider.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                    nav: false
                },
                767: {
                    items: 3,
                },
                1000: {
                    items: 6,
                },
                1200: {
                    items: 6,
                },
            },
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: false,
            navigation: true,
            stopOnHover: true,
            // margin: 10,
            nav: true,
            navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"]
        });
    }
    // ===========Category Owl Carousel============
    var objowlcarousel = $(".owl-carousel-category");
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 3,
                },
                600: {
                    items: 5,
                    nav: false
                },
                1000: {
                    items: 8,
                },
                1200: {
                    items: 8,
                },
            },
            items: 8,
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"]
        });
    }

    // ===========Right Sidebar============
    $('[data-toggle="offcanvas"]').on('click', function () {
        $('body').toggleClass('toggled');
    });

    // ===========Slider============
    var mainslider = $(".owl-carousel-slider");
    if (mainslider.length > 0) {
        mainslider.owlCarousel({
            items: 1,
            dots: false,
            lazyLoad: true,
            pagination: true,
            autoPlay: 4000,
            loop: true,
            singleItem: true,
            navigation: true,
            stopOnHover: true,
            nav: true,
            navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"]
        });
    }

    // ===========Select2============
    $('select').select2();

    // ===========Tooltip============
    $('[data-toggle="tooltip"]').tooltip()

    // ===========Single Items Slider============   
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var syncedSecondary = true;
    sync1.owlCarousel({
        singleItem: true,
        items: 1,
        slideSpeed: 1000,
        pagination: false,
        navigation: true,
        autoPlay: 2500,
        dots: false,
        nav: false,
        navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
        afterAction: syncPosition,
        responsiveRefreshRate: 200,
    }).on('changed.owl.carousel', syncPosition);
    sync2.on('initialized.owl.carousel', function () {
        sync2.find(".owl-item").eq(0).addClass("current");
    }).owlCarousel({
        items: 5,
        navigation: false,
        dots: false,
        pagination: false,
        nav: false,
        loop: false,
        navigationText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
        responsiveRefreshRate: 100,
        afterInit: function (el) {
            el.find(".owl-item").eq(0).addClass("synced");
        }
    }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        var current = this.currentItem;
        sync2.find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced")
        if (sync2.data("owlCarousel") !== undefined) {
            center(current)
        }
    }


    function syncPosition2(el) {
        if(syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }

    sync2.on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });

    function center(number) {
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for (var i in sync2visible) {
            if (num === sync2visible[i]) {
                var found = true;
            }
        }
        if (found === false) {
            if (num > sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", num - sync2visible.length + 2)
            } else {
                if (num - 1 === -1) {
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if (num === sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if (num === sync2visible[0]) {
            sync2.trigger("owl.goTo", num - 1)
        }
    }
    $("#result_file").change(function () {
        var filePath = $(this).val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            // alert('Please upload file having extensions .jpeg/.jpg/.png only.');
            $('.error').html('Please Select Valid File... ');
            $('.error').css('display', 'block');
            setTimeout(function () {
                $('.error').css('display', 'none');
            }, 2000);
            $(this).val('');
            return false;
        } else {
            readURL(this);

        }
    });


    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.previewSource').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            var form_data = new FormData();

            var csrf_token = $('meta[name=csrf-token]').attr('content');
            var file_data = $('.previewImage').prop('files')[0];
            form_data.append('file', file_data);
            form_data.append('_token', csrf_token);


            $.ajax({
                type: 'post',
                url: $('#base_url').val() + "/upload_image",
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false,
                success: function (result) {
                    console.log('lotterhgfhgfies' + JSON.stringify(result));
                    $('#update_email').removeClass('form-control-danger');
                    $('#update_email-error').html('');
                    $('#update_firstname').removeClass('form-control-danger');
                    $('#update_firstname-error').html('');
                    $('#update_lastname').removeClass('form-control-danger');
                    $('#update_lastname-error').html('');
                    if (result.success == 300) {
                        if (result.user.validation) {
                            console.log('valid' + result.user.validation);
                            if (result.user.validation.email) {
                                $('#update_email').addClass('form-control-danger');
                                console.log(result.user.validation.email[0]);
                                $('#update_email-error').html(result.user.validation.email[0]);
                            }
                            if (result.user.validation.first_name) {
                                $('#update_firstname').addClass('form-control-danger');
                                console.log(result.user.validation.first_name[0]);
                                $('#update_firstname-error').html(result.user.validation.first_name[0]);
                            }
                            if (result.user.validation.last_name) {
                                $('#update_lastname').addClass('form-control-danger');
                                console.log(result.user.validation.last_name[0]);
                                $('#update_lastname-error').html(result.user.validation.last_name[0]);
                            }

                        } else if (result.user.alert.message) {
                            $('#image-errormsg').html(result.user.alert.message);
                            $('#image-error').show();
                            setTimeout(function () {
                                $('#image-error').hide();
                            }, 3000);

                        } else {
                            // setTimeout(function(){location.reload()} , 500); 


                            $('#image-errormsg').html('Something went wrong, Please try again');
                            $('#image-error').show();
                            setTimeout(function () {
                                $('#image-error').hide();
                            }, 3000);
                        }

                    } else if (result.success == 400) {
                        $('#image-errormsg').html(result.user.message);
                        $('#image-error').show();
                        setTimeout(function () {
                            $('#image-error').hide();
                        }, 3000);

                    } else {
                        $('#image-sucessmsg').html('Image uploaded successfully');
                        $('#image-success').show();
                        setTimeout(function () {
                            $('#image-success').hide();
                        }, 3000);
                        // setTimeout(function(){location.reload()} , 500); 


                        // $('#reset_email').val('');
                        // $('#reset_code').val('');
                        // $('#reset_password').val('');
                        // $('#success-message').html('Profile updated Successfully');

                    }
                },
                error: function (err) {
                    console.log(JSON.stringify(err));
                }
            });

        }
    }

    $(".previewImage").change(function () {
        var filePath = $(this).val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            $('#image-error').show();
            $('#image-errormsg').html('Please Select Valid File... ');
            setTimeout(function () {
                $('#image-error').css('display', 'none');
            }, 2000);
            $(this).val('');
            return false;
        } else {
            readURL(this);

        }
    });

    // contact us form validation start

    $('#contact_us_btn').click(function (e) {

        e.preventDefault();

        var validate_flag = true;

        $(e.target).closest('form').find('.validate-error').remove();

        var contact_us_email = $('#contact_us_email').val().trim();
        var contact_us_name = $('#contact_us_name').val().trim();
        var contact_us_content = $('#contact_us_content').val().trim();
        var contact_us_captcha = $('#contact_us_captcha').val().trim();

        var validate_require_html = '<div class="validate-error">This field is required.</div>';
        var validate_email_html = '<div class="validate-error">This email is no valid.</div>';

        if (contact_us_email == '') {
            $('#contact_us_email').closest('.contact-control-group').append(validate_require_html);
            validate_flag = false;
        } else {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            var result = contact_us_email.split(',');
            for (var i = 0; i < result.length; i++) {
                if (result[i] != '') {
                    if (!regex.test(result[i])) {
                        $('#contact_us_email').closest('.contact-control-group').append(validate_email_html);
                        validate_flag = false;
                    }
                }
            }
        }

        if (contact_us_name == '') {
            $('#contact_us_name').closest('.contact-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (contact_us_content == '') {
            $('#contact_us_content').closest('.contact-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (contact_us_captcha == '') {
            $('#contact_us_captcha').closest('.cm-field-container').append(validate_require_html);
            validate_flag = false;
        }

        if (validate_flag) {
            $(e.target).closest('form').submit();
            return true;
        } else {
            return false;
        }

    });

    // contact us form validation end

    // gift certificates form validation start

    $('.dei-gift-cert-btn').click(function (e) {

        e.preventDefault();

        var validate_flag = true;

        $(e.target).closest('form').find('.validate-error').remove();

        var gift_cert_recipient = $('#gift_cert_recipient').val().trim();
        var gift_cert_sender = $('#gift_cert_sender').val().trim();
        var gift_cert_amount = $('#gift_cert_amount').val().trim();
        var gift_cert_message = $('#gift_cert_message').val().trim();
        var gift_cert_email = $('#gift_cert_email').val().trim();

        var validate_require_html = '<div class="validate-error">This field is required.</div>';
        var validate_email_html = '<div class="validate-error">This email is no valid.</div>';

        if (gift_cert_email == '') {
            $('#gift_cert_email').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        } else {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            var result = gift_cert_email.split(',');
            for (var i = 0; i < result.length; i++) {
                if (result[i] != '') {
                    if (!regex.test(result[i])) {
                        $('#gift_cert_email').closest('.dei-control-group').append(validate_email_html);
                        validate_flag = false;
                    }
                }
            }
        }

        if (gift_cert_recipient == '') {
            $('#gift_cert_recipient').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (gift_cert_sender == '') {
            $('#gift_cert_sender').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (gift_cert_amount == '') {
            $('#gift_cert_amount').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (gift_cert_message == '') {
            $('#gift_cert_message').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (validate_flag) {
            $(e.target).closest('form').submit();
            return true;
        } else {
            return false;
        }

    });

    // gift certificates form validation end

    // vendor register form validation start

    $('#but_apply_for_vendor').click(function (e) {

        e.preventDefault();

        var validate_flag = true;

        $(e.target).closest('form').find('.validate-error').remove();

        var company_description_company = $('#company_description_company').val().trim();
        var company_description = $('#company_description').val().trim();
        var company_admin_firstname = $('#company_admin_firstname').val().trim();
        var company_admin_lastname = $('#company_admin_lastname').val().trim();
        var company_description_email = $('#company_description_email').val().trim();
        var company_user_data = $('#company_user_data').val().trim();
        var company_address_address = $('#company_address_address').val().trim();
        var company_address_country = $('#company_address_country').val().trim();
        var company_address_zipcode = $('#company_address_zipcode').val().trim();
        var vendor_register_captcha = $('#vendor_register_captcha').val().trim();

        var validate_require_html = '<div class="validate-error">This field is required.</div>';
        var validate_email_html = '<div class="validate-error">This email is no valid.</div>';

        if (company_description_email == '') {
            $('#company_description_email').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        } else {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            var result = company_description_email.split(',');
            for (var i = 0; i < result.length; i++) {
                if (result[i] != '') {
                    if (!regex.test(result[i])) {
                        $('#company_description_email').closest('.dei-control-group').append(validate_email_html);
                        validate_flag = false;
                    }
                }
            }
        }

        if (company_description_company == '') {
            $('#company_description_company').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_description == '') {
            $('#company_description').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_admin_firstname == '') {
            $('#company_admin_firstname').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_admin_lastname == '') {
            $('#company_admin_lastname').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_user_data == '') {
            $('#company_user_data').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_address_address == '') {
            $('#company_address_address').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (company_address_country == '') {
            $('#company_address_country').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }


        if (company_address_zipcode == '') {
            $('#company_address_zipcode').closest('.dei-control-group').append(validate_require_html);
            validate_flag = false;
        }

        if (vendor_register_captcha == '') {
            $('#vendor_register_captcha').closest('.cm-field-container').append(validate_require_html);
            validate_flag = false;
        }

        if (validate_flag) {
            $(e.target).closest('form').submit();
            return true;
        } else {
            return false;
        }

    });

    // vendor register form validation end

    // News Letter sign up validation start

    $('#subsribe_btn').click(function (e) {

        e.preventDefault();

        var validate_flag = true;

        $(e.target).closest('.subscribe-section').find('.validate-error').remove();

        var subscribe_email = $('#subscribe_email').val().trim();

        var validate_require_html = '<div class="validate-error">This field is required.</div>';
        var validate_email_html = '<div class="validate-error">This email is no valid.</div>';

        if (subscribe_email == '') {
            $(validate_require_html).insertAfter($('#subscribe_email').closest('form'));
            validate_flag = false;
        } else {
            var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            var result = subscribe_email.split(',');
            for (var i = 0; i < result.length; i++) {
                if (result[i] != '') {
                    if (!regex.test(result[i])) {
                        $(validate_email_html).insertAfter($('#subscribe_email').closest('form'));
                        validate_flag = false;
                    }
                }
            }
        }

        if (validate_flag) {
            $(e.target).closest('form').submit();
            return true;
        } else {
            return false;
        }

    });

    // News Letter sign up validation end

    // Explore - Experience - Modal - Show - start

    $('.explore-item', $('#explore-modal')).click(function (e) {

        $(e.target).closest('#explore-modal').modal('hide');

    });

    // Explore - Experience - Modal - Show - end

});
$(function () {
    $("#datepicker").datepicker({
        autoclose: true,
        dateFormat: 'yyyy-mm-dd',
        todayHighlight: true
    });
});
$(document).ready(function () {
    $('.datatabel').DataTable();
});
