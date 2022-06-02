<?php
namespace app;
use app\models\Database;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public ?Database $database = null;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $url = $_SERVER['PATH_INFO'] ?? '/';

        $fn = match ($method) {
            'get' => $this->getRoutes[$url] ?? null,
            'post' => $this->postRoutes[$url] ?? null,
        };

        if (!$fn) {
            header("location: /404");
            exit;
        }

        call_user_func_array(array(new $fn[0], $fn[1]), array($this));
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__."/views/$view.php";
        $content = ob_get_clean();
        include __DIR__."/views/_layout.php";
    }
}