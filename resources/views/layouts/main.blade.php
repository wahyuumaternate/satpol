<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SATPOL-PP</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('logo.png') }}" rel="icon">
    <link href="{{ asset('logo.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body class="index-page">
    @include('layouts.header')
    <main class="main">

        @include('layouts.hero')

        @yield('main')
    </main>
    <footer id="footer" class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">

                <!-- Kolom 1: Logo -->
                <div class="col-lg-3 col-md-6 footer-logo">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="Logo" style="height:60px;">
                    </a>
                </div>

                <!-- Kolom 2: Sosial Media -->
                <div class="col-lg-3 col-md-6 footer-social">
                    <h4>Ikuti Kami</h4>
                    <div class="social-links d-flex mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Kolom 3: Alamat -->
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Alamat</h4>
                    <p>Jl. Contoh Alamat No. 123</p>
                    <p>Kota Tangerang, Banten</p>
                    <p class="mt-2"><strong>Telepon:</strong> <span>+62 812 3456 7890</span></p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>

                <!-- Kolom 4: Peta -->
                <div class="col-lg-3 col-md-6 footer-map">
                    <h4>Peta Lokasi</h4>
                    <div class="map-container mt-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4610738209926!2d106.629663!3d-6.200647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff7f0d3b7b5f%3A0x123456789abcdef!2sTangerang!5e0!3m2!1sid!2sid!4v1691234567890"
                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SATPOL PP</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    @stack('scripts')

    <script>
        // Custom Hero Carousel JavaScript
        const heroCarousel = {
            currentSlide: 0,
            slides: null,
            dots: null,
            totalSlides: 0,
            autoplayInterval: null,
            autoplayDelay: 5000,
            progressBar: null,
            progressInterval: null,

            init() {
                this.slides = document.querySelectorAll('.hero-slide');
                this.dots = document.querySelectorAll('.hero-dot');
                this.progressBar = document.getElementById('heroProgress');
                this.totalSlides = this.slides.length;

                if (this.totalSlides > 1) {
                    this.startAutoplay();
                    this.addEventListeners();
                }
            },

            goToSlide(index) {
                // Remove active class from current slide and dot
                this.slides[this.currentSlide].classList.remove('active');
                this.dots[this.currentSlide].classList.remove('active');

                // Update current slide index
                this.currentSlide = index;

                // Add active class to new slide and dot
                this.slides[this.currentSlide].classList.add('active');
                this.dots[this.currentSlide].classList.add('active');

                // Restart autoplay and progress
                this.restartAutoplay();
            },

            next() {
                const nextIndex = (this.currentSlide + 1) % this.totalSlides;
                this.goToSlide(nextIndex);
            },

            prev() {
                const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.goToSlide(prevIndex);
            },

            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.next();
                }, this.autoplayDelay);

                // Start progress bar
                this.startProgress();
            },

            stopAutoplay() {
                if (this.autoplayInterval) {
                    clearInterval(this.autoplayInterval);
                    this.autoplayInterval = null;
                }
                this.stopProgress();
            },

            restartAutoplay() {
                this.stopAutoplay();
                this.startAutoplay();
            },

            startProgress() {
                let progress = 0;
                const increment = 100 / (this.autoplayDelay / 50);

                this.progressInterval = setInterval(() => {
                    progress += increment;
                    this.progressBar.style.width = progress + '%';

                    if (progress >= 100) {
                        progress = 0;
                        this.progressBar.style.width = '0%';
                    }
                }, 50);
            },

            stopProgress() {
                if (this.progressInterval) {
                    clearInterval(this.progressInterval);
                    this.progressInterval = null;
                }
                this.progressBar.style.width = '0%';
            },

            addEventListeners() {
                // Pause on hover
                const heroElement = document.getElementById('hero');
                heroElement.addEventListener('mouseenter', () => {
                    this.stopAutoplay();
                });

                heroElement.addEventListener('mouseleave', () => {
                    this.startAutoplay();
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        this.prev();
                    } else if (e.key === 'ArrowRight') {
                        this.next();
                    }
                });

                // Touch/swipe support
                let startX = 0;
                let endX = 0;

                heroElement.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });

                heroElement.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const diff = startX - endX;

                    if (Math.abs(diff) > 50) { // Minimum swipe distance
                        if (diff > 0) {
                            this.next(); // Swipe left - next slide
                        } else {
                            this.prev(); // Swipe right - prev slide
                        }
                    }
                });

                // Pause autoplay when page is not visible
                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        this.stopAutoplay();
                    } else {
                        this.startAutoplay();
                    }
                });
            }
        };

        // Initialize carousel when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            heroCarousel.init();
        });

        // Cleanup when page unloads
        window.addEventListener('beforeunload', () => {
            heroCarousel.stopAutoplay();
        });
    </script>

</body>

</html>
