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
            <?php include 'includes/contact.php'; ?>
        </main>
        <?php include 'includes/footer.php'; ?>
    </div>


    <!-- Recaptcha -->
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6LcoRNwrAAAAAMtKWFfyC5SRwo9Jh8zWAIxvgAmc"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            grabCursor: true,
            spaceBetween: 16,
            speed: 900,

            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
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
    </script>
</body>

</html>