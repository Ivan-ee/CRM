<?php

class User
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection();

        try {
            $result = $this->database->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (PDOException $e) {
            $this->createTable();
        }
    }

//    public function createTable()
//    {
//        $query = "CREATE TABLE IF NOT EXISTS `users` (
//    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//    `login` VARCHAR(255) NOT NULL,
//    `password` VARCHAR(255) NOT NULL,
//    `is_admin` TINYINT(1) NOT NULL DEFAULT '0',
//    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//    )";
//
//        try {
//            $this->database->exec($query);
//            return true;
//        } catch (PDOException $e) {
//            return false;
//        }
//    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role_name` VARCHAR(255) NOT NULL,
    `role_description` TEXT
)";
        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(6) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(6) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
        )";

        try {
            $this->database->exec($roleTableQuery);
            $this->database->exec($userTableQuery);
            return true;
        } catch (PDOException $e) {
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
        $username = $data['$username'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['$role'];

        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, role, created_at) VALUE (?,?,?,?,?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role, $created_at]);
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
        $username = $data['username'];
        $email = $data['email'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $role = $data['role'];
        $is_active = isset($data['is_active']) ? 1 : 0;

        $query = "UPDATE users SET username = ?, email = ?, is_admin = ?, role = ?, is_active = ? WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$username, $email, $admin, $role, $is_active, $id]);
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





























