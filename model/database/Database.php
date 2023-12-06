<?php

namespace models\database;

class Database{
    private static $instance = null;
    private $conn;

    private function __construct() {
        $config = require_once __DIR__ . '/../../config.php';
        $db_host = $config['db_host'];
        $db_user = $config['db_user'];
        $db_pass = $config['db_pass'];
        $db_name = $config['db_name'];

        try {
            $dsn = "mysql:host=$db_host;dbname=$db_name";
            $this->conn = new PDO($dsn, $db_user, $db_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
            echo "Ошибка соединения: " . $e->getMessage();
        }
    }

    // Возвращает сам объект класса Database
    public static function getInstance() {
        if (!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    // возвращает объект подлючения к бд
    public function getConnection() {
        return $this->conn;
    }
}