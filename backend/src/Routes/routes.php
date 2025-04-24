<?php
require_once __DIR__ . '/../Controllers/UserController.php';

function routeRequest() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    // Permitir acceso directo a migrations.php
    if ($uri === '/migrations.php') {
        return;
    }

    // Normaliza URI base /api-project/public
    $base = str_replace('/api-project/public', '', $uri);

    // Rutas
    if ($base === '/users' && $method === 'GET') {
        UserController::index();
    }

    elseif (preg_match('#^/users/(\d+)$#', $base, $matches)) {
        $id = $matches[1];

        if ($method === 'GET') {
            UserController::show($id);
        }
        elseif ($method === 'PUT') {
            UserController::update($id);
        }
        elseif ($method === 'DELETE') {
            UserController::destroy($id);
        }
    }

    elseif ($base === '/users' && $method === 'POST') {
        UserController::store();
    }

    elseif (preg_match('#^/users/(\d+)/upload$#', $base, $matches) && $method === 'POST') {
        $id = $matches[1];
        UserController::uploadImage($id);
    }
    
    else {
        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }

    
}
