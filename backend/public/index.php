<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Routes/routes.php';

header('Content-Type: application/json');
routeRequest();
