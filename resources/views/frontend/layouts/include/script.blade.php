<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script> -->

<script type="text/javascript" src="{{ asset('front-end/assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/bootstrap.min.js') }}"></script>

<!-- ------wow-animation-cdn----- -->
<script type="text/javascript" src="{{ asset('front-end/assets/js/wow.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/additional-methods.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/solid.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/fontawesome.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/jquery.nice-select.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/feather.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/image-cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/image-zoom-plugin.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/image-main-script.js') }}"></script>
<script type="text/javascript" src="{{ asset('front-end/assets/js/photoswipe.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/select2.full.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('front-end/assets/js/custom.js') }}"></script>
<script src="{{ asset('front-end/subscription.js') }}"></script>
<script src="{{ asset('front-end/forgot-password.js') }}"></script>
<script src="{{ asset('front-end/login.js') }}"></script>
<script src="{{ asset('front-end/register.js') }}"></script>
{{-- sweetalert --}}
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>

<script src="{{ asset('backend/js/general.js') }}"></script>
<script>
    feather.replace();
</script>
@yield('javascript')
<script>
    $(document).ready(function() {

        $('.main-loader-page').css('display', 'none');
    })
    tooltipInitialize();
</script>

<script>
    function testInput(evnt) {
        var value = String.fromCharCode(event.which);
        var pattern = new RegExp(/[a-zåäö ]/i);
        return pattern.test(value);
    }
    $(document).on('keypress', '.alpha', testInput);
</script>
<script>
    $("#toggle").click(function() {
        $(this).toggleClass("on");
        $("#menu").slideToggle();
    });
</script>
<script>
    $(".filter-toggle").click(function() {
        $(this).toggleClass("on");
        $(".filtersidebar-container").slideToggle();
    });
    $("#dashboard-toggle").click(function() {
        $(this).toggleClass("on");
        $(".mobile-toogle-dashboard").slideToggle();
    });
</script>
<script>
    // $(".apply-button").click(function() {
    //     $(this).toggleClass("on");
    //     $(".filtersidebar-container").slideToggle();
    //     $(".layout-productsgrid").scrollTop(0);
    //     $(window).scrollTop(0);
    // });
    $(document).ready(function() {
        globalSearch();
    });
    $(document).on('keyup', '.globle-search', function() {
        globalSearch();
    });

    function globalSearch() {
        var value = $('.globle-search').val().length;
        if (value != 0) {
            $('.search-button').attr('disabled', false);
            $(".searchbar-searchicon").removeClass("disabled");
            if (event.which === 13) {
                $(".search-button").click();
            }
        } else {
            $(".search-button").prop("disabled", true);
            $(".searchbar-searchicon").addClass("disabled");

        }
    }
</script>

<!-- ------------Start-Signle-product-image-zoom-js----------------- -->
<script>
    $(function() {
        var $pswp = $('.pswp')[0],
            image = [],
            getItems = function() {
                var items = [];
                $('.lightboximages a').each(function() {
                    var $href = $(this).attr('href'),
                        $size = $(this).data('size').split('x'),
                        item = {
                            src: $href,
                            w: $size[0],
                            h: $size[1]
                        };
                    items.push(item);
                });
                return items;
            };
        var items = getItems();

        $.each(items, function(index, value) {
            image[index] = new Image();
            image[index].src = value['src'];
        });
        $('.prlightbox').on('click', function(event) {
            event.preventDefault();

            var $index = $(".active-thumb").parent().attr('data-slick-index');
            $index++;
            $index = $index - 1;

            var options = {
                index: $index,
                bgOpacity: 0.7,
                showHideOpacity: true
            };
            var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
            lightBox.init();
        });
    });
</script>
<!-- ------------End-Signle-product-image-zoom-js----------------- -->

<!-- ------------Start-popover-alert-js----------------- -->
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
<!-- ------------End-popover-alert-js----------------- -->

<!-- ------------wow-animation-js----------------- -->
<script>
    new WOW().init();
</script>

<!-- ------------header-sticky-js----------------- -->
<script>
    window.onscroll = function() {
        myFunction();
        scrollFunction()
    };

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }
</script>

<!-- ------------bottom-to-top-scroll-js----------------- -->
<script>
    let mybutton = document.getElementById("scrollBtn");

    function scrollFunction() {
        if (document.body.scrollTop > 120 || document.documentElement.scrollTop > 120) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<!-- ------------nice-select-js----------------- -->
<script>
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>

<!-- ------------home-review-slider-js----------------- -->
<script>
    $(".review-items-slider").slick({
        slidesToShow: 3,
        speed: 300,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        // dots: false, Boolean
        // arrows: false, Boolean
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });
</script>

<!-- ------------header-dropdown-js----------------- -->
<script>
    $(document).ready(function() {
        $('.mobile-toogle-menu .nav-menuitems-link').on("click", function(e) {
            $(this).siblings('.dropdown-menu').toggleClass('open');
        });
        $('.mobile-toogle-menu .mega-menu').on("click", function(e) {
            $(this).siblings('.dropdown-menu').toggleClass('open');
        });
    });
</script>