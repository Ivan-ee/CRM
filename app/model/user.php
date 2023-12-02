<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function readAll()
    {
        $result = $this->database->query("SELECT * FROM users");

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users = $row;
        }

        return $users;
    }


}