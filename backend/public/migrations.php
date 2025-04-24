<?php
require_once __DIR__ . '/../config/database.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    names VARCHAR(100) NOT NULL,
    lastnames VARCHAR(100) NOT NULL UNIQUE,
    img VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;";

try {
    $pdo->exec($sql);
    echo json_encode(['success' => 'Table `users` checked/created successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
