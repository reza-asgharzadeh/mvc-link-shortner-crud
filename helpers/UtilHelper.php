<?php
namespace app\helpers;
use app\models\Database;

class UtilHelper
{
    public static $str;
    public static $n;

    public static function randomString($n)
    {
        //Generate Random Code with $characters
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $str = '';
        for($i=0; $i<$n; $i++){
            $index = rand(0, strlen($characters) - 1);
            $str .= $characters[$index];
        }
        self::$n = $n;
        self::$str = $str;
        //Return to checkUniqueCode() Method
        return self::checkUniqueCode();
    }

    public static function checkUniqueCode()
    {
        $database = new Database();
        $sql = "SELECT code FROM links WHERE code=?";
        $record = $database->getCode($sql,self::$str);

        //if Generated Code Equal Database Code, Return to Generate Code randomString($n)
        if ($record){
            return self::randomString(self::$n);
        }
        return self::$str;
    }
}