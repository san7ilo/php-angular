<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Services/ResponseService.php';
require_once __DIR__ . '/../Services/UploadService.php';
require_once __DIR__ . '/../Services/ValidationService.php';

class UserController {
    public static function index() {
        $users = User::getAll();
        ResponseService::json($users);
    }

    public static function show($id) {
        $user = User::getById($id);
        if (!$user) return ResponseService::error("User not found", 404);
        ResponseService::json($user);
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        $error = ValidationService::validateUserInput($data);
        if ($error) {
            return ResponseService::error($error, 422);
        }
    
        if (User::create($data)) {
            ResponseService::json(['success' => 'User created'], 201);
        } else {
            ResponseService::error('Could not create user');
        }
    }
    

    public static function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        
        $error = ValidationService::validateUserInput($data);
        if ($error) {
            return ResponseService::error($error, 422);
        }
        
        if (!isset($data['names'], $data['lastnames'])) {
            return ResponseService::error("Invalid input", 422);
        }
        if (User::update($id, $data)) {
            ResponseService::json(['success' => 'User updated']);
        } else {
            ResponseService::error('Could not update user');
        }
    }

    public static function destroy($id) {
        if (User::delete($id)) {
            ResponseService::json(['success' => 'User deleted']);
        } else {
            ResponseService::error('Could not delete user');
        }
    }

    public static function uploadImage($id) {
        $user = User::getById($id);
        if (!$user) return ResponseService::error("User not found", 404);
    
        [$success, $result] = UploadService::saveImage($_FILES);
    
        if (!$success) {
            return ResponseService::error($result);
        }
    
        // Guardar nombre de imagen en BD
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET img = ? WHERE id = ?");
        $stmt->execute([$result, $id]);
    
        ResponseService::json(['success' => 'Image uploaded', 'filename' => $result]);
    }
}
