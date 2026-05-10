<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/erine-gallery/models/Gallery.php';

class GalleryController {
    private $gallery;

    public function __construct() {
        $this->gallery = new Gallery();
    }

    public function showAll() {
        return $this->gallery->getAll();
    }

    public function filter($category) {
        return $this->gallery->getByCategory($category);
    }

    public function addPhoto($title, $image, $category) {
        return $this->gallery->insert($title, $image, $category);
    }

    public function deletePhoto($id) {
        return $this->gallery->delete($id);
    }

    public function getById($id) {
        return $this->gallery->getById($id);
    }

    public function updatePhoto($id, $title, $category) {
        return $this->gallery->update($id, $title, $category);
    }
}
?>