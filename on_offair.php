<!DOCTYPE html>
<html lang="id">
<head>
    <title>On/Off Air - Erine Gallery</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
    <!-- HEADER + BACK BUTTON -->
    <div class="gallery-header">
        <div class="container">
            <a href="../index.php#galeri" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Kategori
            </a>
            <h1>Official On/Off Air Moments</h1>
        </div>
    </div>

    <!-- GRID 4 KOLOM -->
    <section class="gallery-page">
        <div class="container">
                    <?php
                        require_once '../controllers/GalleryController.php';
                        $controller = new GalleryController();
                        $photos = $controller->filter('on_offair');
                    ?>

                <div class="photo-grid">
                    <?php while($row = $photos->fetch_assoc()): ?>
                        <div class="photo-item" onclick="openLightbox('../assets/img/<?php echo $row['category']; ?>/<?php echo $row['image']; ?>')">
                            <img src="../assets/img/<?php echo $row['category']; ?>/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
    </section>

    <!-- LIGHTBOX -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <img id="lightbox-img" src="">
        <span class="close-btn" onclick="closeLightbox()">&times;</span>
    </div>

    <script src="../assets/js/gallery.js"></script>
</body>
</html>