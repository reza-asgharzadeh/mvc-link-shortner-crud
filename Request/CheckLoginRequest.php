<?php
namespace app\Request;

class CheckLoginRequest{
    public static function errors($record,$userData)
    {
        $errors = [];

        if (!$userData['email']) {
            $errors[] = 'ایمیل را وارد کنید.';
        }

        if (!$userData['password']) {
            $errors[] = 'رمز عبور را وارد کنید.';
        }

        //Check Email and Password Doesn't exist in Database
        if(!$record || $record['password'] != $userData['password']){
            $errors[] = "ایمیل یا رمز عبور شما اشتباه است.";
        }

        return $errors;
    }
}