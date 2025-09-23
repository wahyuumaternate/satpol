{{-- ukuran gambar : 1920 x 500 --}}
<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-carousel">
        <!-- Slide 1 -->
        <div class="hero-slide active" data-bg="{{ asset('frontend/assets/img/1.png') }}">
            <img src="{{ asset('frontend/assets/img/1.png') }}" alt="Slide 1" loading="eager">
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide" data-bg="{{ asset('frontend/assets/img/2.png') }}">
            <img src="{{ asset('frontend/assets/img/2.png') }}" alt="Slide 2" loading="lazy">
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide" data-bg="./assets/img/3.png">
            <img src="{{ asset('frontend/assets/img/3.png') }}" alt="Slide 3" loading="lazy">
        </div>

        <!-- Navigation Arrows -->
        <button class="hero-nav hero-nav-prev" onclick="heroCarousel.prev()">
            &#8249;
        </button>
        <button class="hero-nav hero-nav-next" onclick="heroCarousel.next()">
            &#8250;
        </button>

        <!-- Dots Indicators -->
        <div class="hero-indicators">
            <span class="hero-dot active" onclick="heroCarousel.goToSlide(0)"></span>
            <span class="hero-dot" onclick="heroCarousel.goToSlide(1)"></span>
            <span class="hero-dot" onclick="heroCarousel.goToSlide(2)"></span>
        </div>

        <!-- Progress Bar -->
        <div class="hero-progress" id="heroProgress"></div>
    </div>

    <!-- Content Overlay (uncomment jika diperlukan) -->
    <!--
    <div class="hero-content">
        <h2>Welcome to SATPOL PP</h2>
        <p>Menjaga ketertiban dan keamanan masyarakat dengan dedikasi tinggi untuk kemajuan daerah.</p>
        <a href="#about" class="hero-btn">Selengkapnya</a>
    </div>
    -->
</section>
