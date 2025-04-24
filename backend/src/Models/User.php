<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (names, lastnames) VALUES (?, ?)");
        return $stmt->execute([$data['names'], $data['lastnames']]);
    }

    public static function update($id, $data) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET names = ?, lastnames = ? WHERE id = ?");
        return $stmt->execute([$data['names'], $data['lastnames'], $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
