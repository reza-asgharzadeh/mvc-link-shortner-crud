<?php
namespace app\controllers;
use app\Router;

class PageController{
    public function notFound(Router $router){
        $error = "صفحه مورد نظر پیدا نشد 404";
        $router->renderView('errors/404', [
            'error' => $error,
        ]);
    }
}