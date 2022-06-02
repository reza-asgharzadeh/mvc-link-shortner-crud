<?php
namespace app\Request;

class CheckLinkRequest{
    public static function errors($linkData)
    {
        if (!$linkData) {
            $requiredLink = "لینک را وارد کنید";
            header("Location: /links?requiredLink={$requiredLink}");
            exit;
        }
    }
}