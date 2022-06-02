<?php
namespace app\Request;

class CheckRegisterRequest{
    public static function errors($record,$userData)
    {
        $errors = [];

        if($record){
            $errors[] = "با این ایمیل قبلا ثبت نام کرده اید";
        }

        if (!$userData['fullName']) {
            $errors[] = 'نام را وارد کنید';
        }

        if (!$userData['email']) {
            $errors[] = 'ایمیل را وارد کنید';
        }

        if (!$userData['password']) {
            $errors[] = 'رمز عبور را وارد کنید';
        }

        return $errors;
    }
}