<?php
namespace app\models;
use PDO;

class Database
{
    public $connect = null;

    public function __construct()
    {
        require __DIR__ . "/../config.php";
        try {
            $this->connect = new \PDO("mysql:host={$config['servername']};dbname={$config['dbname']}", $config['username'], $config['password']);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e){
            die("Connection failed:" . $e->getMessage());
        }
    }

    public function register(User $user){
        $stmt = $this->connect->prepare("INSERT INTO users (name, email, password) VALUES (:fullName, :email, :password)");
        $stmt->bindValue(':fullName', $user->fullName);
        $stmt->bindValue(':email', $user->email);
        $stmt->bindValue(':password', $user->password);
        $stmt->execute();
    }

    public function getUserEmail($sql,$email){
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserLinks($sql,$userId){
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCode($sql,$code){
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createLink(Link $link){
        $stmt = $this->connect->prepare("INSERT INTO links (user_id, original_link, short_link, code)
                VALUES (:user_id, :original_link, :short_link, :code)");
        $stmt->bindValue(':user_id', $link->user_id);
        $stmt->bindValue(':original_link', $link->original_link);
        $stmt->bindValue(':short_link', $link->short_link);
        $stmt->bindValue(':code', $link->code);
        $stmt->execute();
    }

    public function editLink($sql,$userId,$linkId){
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$userId,$linkId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLink(Link $link){
        $stmt = $this->connect->prepare("UPDATE links SET original_link = :original_link, short_link = :short_link, code = :code WHERE id = :id AND user_id = :user_id");
        $stmt->bindValue(':original_link', $link->original_link);
        $stmt->bindValue(':short_link', $link->short_link);
        $stmt->bindValue(':code', $link->code);
        $stmt->bindValue(':id', $link->id);
        $stmt->bindValue(':user_id', $link->user_id);
        $stmt->execute();
    }

    public function destroyLink($sql,$linkId,$userId){
        $stmt = $this->connect->prepare($sql);
        $stmt->execute([$linkId,$userId]);
    }
}