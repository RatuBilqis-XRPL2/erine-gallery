<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TEST DATABASE ===<br><br>";

// TEST 1: Cek file ada
if (!file_exists('config/Database.php')) {
    die("❌ config/Database.php TIDAK ADA!");
}
echo "✅ config/Database.php OK<br>";

// TEST 2: Include class
require_once 'config/Database.php';
echo "✅ Include Database.php OK<br>";

// TEST 3: Buat object
$db = new Database();
echo "✅ Object Database OK<br>";

// TEST 4: Connect
$conn = $db->connect();
if ($conn) {
    echo "✅ KONEXI BERHASIL!<br>";
    echo "Host: localhost<br>";
    
    // TEST 5: Cek database list
    $result = $conn->query("SHOW DATABASES LIKE 'erine_gallery'");
    if ($result->num_rows > 0) {
        echo "✅ Database 'erine_gallery' ADA!<br>";
        
        // TEST 6: Cek table gallery
        $result2 = $conn->query("SHOW TABLES FROM erine_gallery LIKE 'gallery'");
        if ($result2 && $result2->num_rows > 0) {
            echo "✅ Tabel 'gallery' ADA!<br>";
        } else {
            echo "❌ Tabel 'gallery' BELUM ADA!<br>";
            echo "Jalankan SQL ini di phpMyAdmin:<br>";
            echo "<pre>USE erine_gallery; CREATE TABLE gallery (...);</pre>";
        }
    } else {
        echo "❌ Database 'erine_gallery' BELUM ADA!<br>";
        echo "Buat dulu di phpMyAdmin!<br>";
    }
} else {
    echo "❌ KONEXI GAGAL! Cek:<br>";
    echo "- XAMPP MySQL running?<br>";
    echo "- Username: root, Password: kosong?<br>";
}
?>