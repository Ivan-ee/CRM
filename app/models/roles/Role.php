<?php

class Role
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection();

        try {
            $result = $this->database->query("SELECT 1 FROM `roles` LIMIT 1");
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

        try {
            $this->database->exec($roleTableQuery);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllRoles()
    {
        $query = "SELECT * FROM roles";

        try {
            $stmt = $this->database->prepare($query);
            $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $roles;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getRoleById($id)
    {
        $query = "SELECT * FROM roles WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role ? $role : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createRole($role_name, $role_description)
    {
        $query = "INSERT INTO roles (role_name role_description) VALUES (?,?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$role_name, $role_description]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateRole($id, $role_name, $role_description)
    {
        $query = "UPDATE roles SET role_name = ?, role_description = ? WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$role_name, $role_description, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteRole($id) {
        $query = " DELETE FROM roles WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


}































