<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bijan Shakya - Portfolio</title>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    @vite('resources/css/app.css')
    <style>
        .navbar-btn.active .underline-indicator {
            left: 0 !important;
            width: 100% !important;
        }
    </style>
</head>

<body>
    {{-- Header or Navbar --}}
    @include('layouts.navbar')



    {{-- Main content --}}
    @yield('content')

    {{-- Footer section --}}
    @include('layouts.footer')


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById("backToTopBtn").addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" // Smooth scrolling
                });
            });

            let isAnimatingNav = false;

            // Click to scroll
            $('.navbar-btn').click(function() {
                const targetSection = $(this).data('target');
                const scrollTarget = $('[data-section="' + targetSection + '"]');

                if (scrollTarget.length) {
                    isAnimatingNav = true;

                    $('html, body').stop().animate({
                        scrollTop: scrollTarget.offset().top - 100
                    }, 500, function() {
                        isAnimatingNav = false;
                        updateActiveButtonNavbar(targetSection);
                    });

                    updateActiveButtonNavbar(targetSection); // Immediate feedback
                }

                // Close mobile menu on click
                if ($('#mobile-menu-container').hasClass('translate-x-0')) {
                    $('#menu-toggle').trigger('click');
                }
            });

            // Scroll spy
            $(window).on('scroll', function() {
                if (isAnimatingNav) return;

                const scrollPos = $(document).scrollTop();

                $('[data-section]').each(function() {
                    const sectionTop = $(this).offset().top - 120;
                    const sectionBottom = sectionTop + $(this).outerHeight();
                    const sectionName = $(this).data('section');

                    if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                        updateActiveButtonNavbar(sectionName);
                        return false; // Break loop
                    }
                });
            });

            function updateActiveButtonNavbar(sectionName) {
                $('.navbar-btn').removeClass(
                        'text-blue-500 font-bold border-l-4 border-blue-500 bg-blue-50 active font-semibold')
                    .addClass('text-gray-700 hover:text-blue-500 hover:bg-gray-50');

                $('.navbar-btn[data-target="' + sectionName + '"]').each(function() {
                    const isMobile = $(this).closest('#mobile-menu-container').length > 0;

                    if (isMobile) {
                        $(this).addClass(
                            'text-blue-500 font-semibold border-l-4 border-blue-500 bg-blue-50 font-semibold');
                    } else {
                        $(this).addClass('font-bold active');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
