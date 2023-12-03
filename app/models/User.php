<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection();

        try {
            $result = $this->database->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (PDOException $e){
            $this->createTable();
        }
    }

    public function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) NOT NULL DEFAULT '0',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

        try {
            $this->database->exec($query);
            return true;
        } catch (PDOException $e){
            return false;
        }
    }

    public function readAll()
    {
        try {
            $stmt = $this->database->query("SELECT * FROM `users`");

            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create($data)
    {
        $login = $data['login'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (login, password, is_admin, created_at) VALUE (?,?,?,?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$login, $password, $admin, $created_at]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $data)
    {
        $login = $data['login'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;

        $query = "UPDATE users SET login = ?, is_admin = ? WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$login, $admin, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }

    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}





























