<?php

class UploadService {
    public static function saveImage($file) {
        if (!isset($file['image']) || $file['image']['error'] !== 0) {
            return [false, "No valid image uploaded"];
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file['image']['type'], $allowedTypes)) {
            return [false, "Only JPG and PNG images are allowed"];
        }

        $ext = pathinfo($file['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('user_', true) . '.' . $ext;
        $destination = __DIR__ . '/../../uploads/' . $filename;

        if (!move_uploaded_file($file['image']['tmp_name'], $destination)) {
            return [false, "Error saving image"];
        }

        return [true, $filename];
    }
}
