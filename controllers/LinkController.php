<?php
namespace app\controllers;
use app\helpers\UtilHelper;
use app\models\Link;
use app\Request\CheckLinkRequest;
use app\Router;

class LinkController{
    private $original_link;
    private $short_link;
    private $code;

    public function __construct()
    {
        if(!isset($_SESSION['email'])){
            header("Location: /login");
        }
    }

    public function index(Router $router)
    {
        $sql = "SELECT * FROM links WHERE user_id=?";
        $userId =  $_SESSION['user_id'];
        $value = $router->database->getUserLinks($sql,$userId);

        $router->renderView('links/index', [
            'links' => $value,
        ]);
    }

    public function store(Router $router)
    {
        $this->original_link = $_POST['original_link'];

        //Run findString Method to Set original_link and short_link to private Property
        $this->findString();

        $linkData['user_id'] = $_SESSION['user_id'];
        $linkData['original_link'] = $this->original_link; //aparat.com
        $linkData['short_link'] = $this->short_link . $this->code; //aparat.com/224fpp
        $linkData['code'] = $this->code; //224fpp

        //Check Errors by Request Folder
        CheckLinkRequest::errors($_POST['original_link']);

        $link = new Link();
        $link->load($linkData);
        $link->save($router);

        header('Location: /links');
    }

    public function edit(Router $router)
    {
        $sql = "SELECT * FROM links WHERE user_id=? AND id=? Limit 1";
        $userId =  $_SESSION['user_id'];
        $linkId =  $_POST['link_id'];

        $link = $router->database->editLink($sql,$userId,$linkId);

        $router->renderView('links/edit', [
            'link' => $link,
        ]);
    }

    public function update(Router $router)
    {
        $this->original_link = $_POST['original_link'];
        //Run findString Method to Set original_link and short_link to private Property
        $this->findString();

        $linkData['user_id'] = $_SESSION['user_id'];
        $linkData['original_link'] = $this->original_link; //aparat.com
        $linkData['short_link'] = $this->short_link . $this->code; //aparat.com/224fpp
        $linkData['code'] = $this->code; //224fpp
        $linkData['link_id'] = $_POST['link_id'];

        $link = new Link();
        $link->load($linkData);
        $link->save($router);

        header('Location: /links');
    }

    public function destroy(Router $router)
    {
        $sql = "DELETE FROM links WHERE id = ? AND user_id = ?";
        $linkId =  $_POST['link_id'];
        $userId =  $_SESSION['user_id'];

        $router->database->destroyLink($sql,$linkId,$userId,);

        header("Location: /links");
    }

    public function createRandomCode()
    {
        //Create 6 string Random Code with The UtilHelper
        return UtilHelper::randomString(6);
    }

    public function findString()
    {
        //Check https: Or http: character in the Start Original link
        if (str_starts_with(strtolower($this->original_link), 'http')){
            $str = explode('/',$this->original_link);
            $this->short_link = $str[1] . $str[2] . "/"; //original link: https://aparat.com/url-short-test //short link: aparat.com/
            return $this->code = $this->createRandomCode(); //code: 224fpp
        }

        $str = explode('/',$this->original_link);
        $this->original_link = "http://" . $this->original_link; //if the original link: aparat.com/url-short-test Combine http:// with original link
        $this->short_link = $str[0] . "/"; //short link: aparat.com/
        return $this->code = $this->createRandomCode(); //code: 224fpp
    }
}