<?php
namespace app\controllers;
use app\Request\CheckLoginRequest;
use app\Router;

class LoginController{

    public function create(Router $router)
    {
        $router->renderView('users/login/auth');
    }

    public function check(Router $router)
    {
        //login user with OOP and PDO
        $userData['email'] = $_POST['email'];
        $userData['password'] = md5($_POST['password']);

        $sql = "SELECT * FROM users where email=? LIMIT 1";
        $record = $router->database->getUserEmail($sql,$userData['email']);

        //Check Errors by Request Folder
        $errors = CheckLoginRequest::errors($record,$userData);

        $router->renderView('users/login/auth',[
            'errors' => $errors
        ]);

        //if the email exist and password correct redirect to /links
        if (empty($errors)) {
            $_SESSION['user_id'] = $record['id'];
            $_SESSION['email'] = $record['email'];
            header("Location: /links");
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}