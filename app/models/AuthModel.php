<?php

class AuthModel
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

    public function register($username, $email, $password)
    {
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (username, email, password, created_at) VALUES (?,?,?,?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $created_at]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return $user ? $user : false;
        } catch (PDOException $e) {
            return false;
        }
    }
}































