<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broadway</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/contactStyles.css">
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
</body>

</html>