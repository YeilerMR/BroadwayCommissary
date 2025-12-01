<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lakeland Commissary</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/contactStyles.css">
    <link rel="stylesheet" href="assets/css/slider.css">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
</head>

<body class="font-sans antialiased">


    <div class="min-h-screen flex flex-col">
        <?php include 'includes/header.php'; ?>
        <main class="flex-1">
            <?php include 'includes/home.php'; ?>
            <?php include 'includes/services.php'; ?>
            <?php include 'includes/about.php'; ?>
            <?php include 'includes/testimonials.php'; ?>
            <?php include 'includes/contact.php'; ?>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>


    <!-- Recaptcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcoRNwrAAAAAMtKWFfyC5SRwo9Jh8zWAIxvgAmc"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <script>
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const desktopNav = document.getElementById('desktopNav');
        const mobileLinks = mobileMenu.querySelectorAll('a');

        function updateNavDisplay() {
            const isMobile = window.innerWidth < 768; 
            
            if (isMobile) {
                desktopNav.style.display = 'none';
                mobileMenuBtn.style.display = 'flex';
            } else {
                desktopNav.style.display = 'flex';
                mobileMenuBtn.style.display = 'none';
                mobileMenu.style.display = 'none';
            }
        }

        updateNavDisplay();

        window.addEventListener('resize', updateNavDisplay);

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none') {
                mobileMenu.style.display = 'block';
            } else {
                mobileMenu.style.display = 'none';
            }
        });

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.style.display = 'none';
            });
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('header')) {
                mobileMenu.style.display = 'none';
            }
        });

        const servicesSwiper = document.querySelector('.swiper:not(.testimonials-swiper)');
        if (servicesSwiper) {
            const swiper = new Swiper(servicesSwiper, {
                loop: true,
                grabCursor: true,
                spaceBetween: 16,
                speed: 900,

                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: servicesSwiper.querySelector('.swiper-pagination'),
                    clickable: true,
                    dynamicBullets: true
                },
                navigation: {
                    nextEl: servicesSwiper.querySelector('.swiper-button-next'),
                    prevEl: servicesSwiper.querySelector('.swiper-button-prev'),
                },

                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    620: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 4
                    }
                }

            });
        }

        const testimonialsContainer = document.querySelector('.testimonials-swiper');
        if (testimonialsContainer) {
            const testimonialsSwiper = new Swiper(testimonialsContainer, {
                loop: true,
                grabCursor: true,
                spaceBetween: 16,
                speed: 900,

                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: testimonialsContainer.querySelector('.testimonials-pagination'),
                    clickable: true,
                    dynamicBullets: true
                },
                navigation: {
                    nextEl: testimonialsContainer.querySelector('.swiper-button-next'),
                    prevEl: testimonialsContainer.querySelector('.swiper-button-prev'),
                },

                breakpoints: {
                    0: {
                        slidesPerView: 1
                    },
                    620: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                }

            });
        }
    </script>
</body>

</html>