const carouselContainer = document.querySelector('.carousel-container');
        const slides = document.querySelectorAll('.carousel-slide');

        let slideIndex = 0;
        const slideWidth = slides[0].offsetWidth + 20; // Width of slide + margin

        function showSlides() {
            carouselContainer.classList.add('carousel-hidden');
            carouselContainer.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
        }

        function nextSlide() {
            if (slideIndex < slides.length - 1) {
                slideIndex++;
                showSlides();
            }
        }

        function prevSlide() {
            if (slideIndex > 0) {
                slideIndex--;
                showSlides();
            }
        }

        // Show next slide on right arrow click
        document.addEventListener('keydown', function (e) {
            if (e.keyCode === 39) {
                nextSlide();
            }
        });

        // Show previous slide on left arrow click
        document.addEventListener('keydown', function (e) {
            if (e.keyCode === 37) {
                prevSlide();
            }
        });

        // Hide overflow when transition ends
        carouselContainer.addEventListener('transitionend', function () {
            carouselContainer.classList.remove('carousel-hidden');
        });

        showSlides();