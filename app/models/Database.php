<?php

class Database{
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $name = 'CRM';

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->name);

        if ($this->conn->connect_error){
            die('Ошибка соединения: ' . $this->conn->connect_error);
        }
    }

    // Возвращает сам объект класса Database
    public static function getInstance() {
        if (!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // возвращает объект подлючения к бд
    public function getConnection() {
        return $this->conn;
    }
}