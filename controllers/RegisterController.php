<?php
namespace app\controllers;
use app\models\User;
use app\Request\CheckRegisterRequest;
use app\Router;

class RegisterController{

    public function create(Router $router)
    {
        $router->renderView('users/register/create');
    }

    public function store(Router $router)
    {
        $userData['fullName'] = $_POST['fullName'];
        $userData['email'] = $_POST['email'];
        $userData['password'] = md5($_POST['password']);

        $sql = "SELECT * FROM users where email=? LIMIT 1";
        $record = $router->database->getUserEmail($sql,$userData['email']);

        //Check Errors by Request Folder
        $errors = CheckRegisterRequest::errors($record,$userData);

        $router->renderView('users/register/create',[
            'errors' => $errors
        ]);

        //if the email not exist, information store and redirect to /login
        if (empty($errors)){
            $user = new User();
            $user->load($userData);
            $user->save($router);
            header("Location: /login");
        }
    }
}