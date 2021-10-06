<?php
class Message {
    public int $id;
    public string $content;
    public int $userId;
    public DateTime $createdAt;

    public function __construct()
    {
        //
    }
}