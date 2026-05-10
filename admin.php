<?php
session_start();
require_once 'controllers/GalleryController.php';

$controller = new GalleryController();
$message = '';

if ($_POST) {
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $image = $_FILES['image']['name'];
        
        if ($image) {
            $target = "assets/img/$category/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                if ($controller->addPhoto($title, $image, $category)) {
                    $message = '<div class="alert success">Foto berhasil ditambahkan!</div>';
                }
            }
        }
    }
    
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        if ($controller->deletePhoto($id)) {
            $message = '<div class="alert success">Foto berhasil dihapus!</div>';
        }
    }
}

$allPhotos = $controller->showAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Erine Gallery</title>
    <style>
        body{
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .admin-page {
        background: url('assets/img/BackgroundAdmin.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    /* Admin Specific Styles */
    .admin-page .admin-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
    }

    .admin-page .content-container {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
    }

    .admin-page .upload-section {
        flex: 1;
        padding: 20px;
        border-radius: 8px;
        margin-right: 30px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .admin-page .upload-section h3 {
        margin-bottom: 20px;
        color: #ffff;
    }

    .admin-page .upload-section .form-group {
        margin-bottom: 15px;
    }

    .admin-page .upload-section .form-group label {
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
         color: #ffff;
    }

    .admin-page .upload-section .form-group input,
    .admin-page .upload-section .form-group select {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .admin-page .upload-section button {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 15px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .admin-page .upload-section button:hover {
        background-color: #45a049;
    }

    .admin-page .photo-list {
        flex: 2;
        padding: 20px;
        border-radius: 8px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        color: #ffff;
    }

    .admin-page .photo-history {
        max-height: 500px;
        overflow-y: auto;
    }

    .admin-page .photo-table {
        width: 100%;
        border-collapse: collapse;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .admin-page .photo-table th, .admin-page .photo-table td {
        padding: 12px;
        text-align: left;
        background-color: #282828;
    }

    .admin-page .photo-table th {
        background-color: #c79a42;
        color: #fff;
    }

    .admin-page .photo-table tr:nth-child(even) {
        background-color: #282828;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .admin-page .photo-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    .admin-page .btn {
        padding: 8px 15px;
        margin: 5px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    .admin-page .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .admin-page .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .admin-page .btn-primary:hover {
        background-color: #0056b3;
    }

    .admin-page .btn-danger:hover {
        background-color: #c82333;
    }

    .admin-page .alert.success {
        background-color: #28a745;
        color: white;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    </style>
</head>
<body class="admin-page">
    <div class="admin-container">
        <h1><i class="fas fa-cog"></i> Admin Panel - Erine Gallery</h1>
        
        <?php echo $message; ?>

        <div class="content-container">
            <!-- Form Section -->
            <div class="upload-section">
                <h3>Tambah Foto Baru</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul Foto:</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori:</label>
                        <select name="category" required>
                            <option value="daily">Daily</option>
                            <option value="fancam">Fancam</option>
                            <option value="friends">With Friends</option>
                            <option value="photobook">Official Photobook</option>
                            <option value="on_offair">Official On Air</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar:</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Foto</button>
                </form>
            </div>

            <!-- History Section -->
            <div class="photo-list">
                <h3>Daftar Foto (<?php echo $allPhotos->num_rows; ?>)</h3>
                <div class="photo-history">
                    <table class="photo-table">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($photo = $allPhotos->fetch_assoc()): ?>
                                <tr>
                                    <td>
                                        <img src="../assets/img/<?php echo $photo['image']; ?>" class="photo-thumb">
                                    </td>
                                    <td><?php echo $photo['title']; ?></td>
                                    <td><?php echo ucwords(str_replace('_', ' ', $photo['category'])); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $photo['id']; ?>" class="btn btn-primary">Edit</a>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $photo['id']; ?>">
                                            <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Hapus foto ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <p style="text-align:center; margin-top:2rem;">
                    <a href="index.php" class="btn btn-primary">← Kembali ke Gallery</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>