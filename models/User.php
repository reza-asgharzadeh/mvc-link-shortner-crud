<?php
namespace app\models;

class User
{
    public string $fullName;
    public string $email;
    public string $password;

    public function load($data)
    {
        $this->fullName = $data['fullName'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function save($router)
    {
        $router->database->register($this);
    }
}