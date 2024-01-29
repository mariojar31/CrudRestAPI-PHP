<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/config/db.php';
require __DIR__.'/../src/middleware/CorsMiddleware.php';

use Slim\Factory\AppFactory;
use API_News\src\middleware\CorsMiddleware;

header("Content-Type: application/json");

$app = AppFactory::create();

// Middleware para el manejo de errores
$app->addErrorMiddleware(true, true, true);
$app->add(new CorsMiddleware());




require __DIR__ . '/../src/routes/news.php';

$app->run();