<?php
require_once 'controllers/GalleryController.php';
$controller = new GalleryController();

$id = $_GET['id'];
$photo = $controller->getById($id)->fetch_assoc();

if ($_POST) {
    $title = $_POST['title'];
    $category = $_POST['category'];

    $controller->updatePhoto($id, $title, $category);
    header("Location: admin.php");
}
?>

<form method="POST">
    <input type="text" name="title" value="<?php echo $photo['title']; ?>">
    
    <select name="category">
        <option value="daily">Daily</option>
        <option value="fancam">Fancam</option>
        <option value="fancam">Friends</option>
        <option value="fancam">On/Off Air</option>
        <option value="fancam">Photobook</option>
    </select>

    <button type="submit">Update</button>
</form>