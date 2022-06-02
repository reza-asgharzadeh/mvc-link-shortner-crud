<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\PageController;
use app\controllers\RegisterController;
use app\controllers\LoginController;
use app\controllers\LinkController;
use app\models\Database;
use app\Router;

$database = new Database();
$router = new Router($database);

$router->get('/register', [RegisterController::class, 'create']);
$router->post('/register', [RegisterController::class, 'store']);
$router->get('/login', [LoginController::class, 'create']);
$router->post('/login', [LoginController::class, 'check']);
$router->post('/logout', [LoginController::class, 'logout']);

$router->get('/', [LinkController::class, 'index']);
$router->get('/links', [LinkController::class, 'index']);
$router->post('/links', [LinkController::class, 'store']);
$router->post('/links/edit', [LinkController::class, 'edit']);
$router->post('/links/update', [LinkController::class, 'update']);
$router->post('/links/remove', [LinkController::class, 'destroy']);

$router->get('/404', [PageController::class, 'notFound']);

$router->resolve();