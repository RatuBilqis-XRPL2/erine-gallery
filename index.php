<?php
require_once 'controllers/GalleryController.php';
$controller = new GalleryController();
$allPhotos = $controller->showAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Erine Gallery - Catherina Vallencia JKT48</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'views/partials/navbar.php'; ?>

    <?php include 'views/home.php'; ?>
    <?php include 'views/profile.php'; ?>
    <?php include 'views/galeri.php'; ?>
    <?php include 'views/about.php'; ?>

    <?php include 'views/partials/footer.php'; ?>

    <script src="../assets/js/script.js"></script>
</body>
</html>