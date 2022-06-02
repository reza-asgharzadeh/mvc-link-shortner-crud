<?php
namespace app\models;

class Link{
    public ?int $id = null;
    public int $user_id;
    public string $original_link;
    public string $short_link;
    public string $code;

    public function load($data)
    {
        $this->user_id = $data['user_id'];
        $this->original_link = $data['original_link'];
        $this->short_link = $data['short_link'];
        $this->code = $data['code'];
        $this->id = $data['link_id'] ?? null;
    }

    public function save($router)
    {
        $db = $router->database;

        if ($this->id) {
            return $db->updateLink($this);
        }
        return $db->createLink($this);
    }
}