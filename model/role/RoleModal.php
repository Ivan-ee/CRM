<?php

namespace model\role;

class RoleModal
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection();

        try {
            $result = $this->database->query("SELECT 1 FROM `role` LIMIT 1");
        } catch (PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `role` (
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
        try {
            $stmt = $this->database->query("SELECT * FROM role");

            $roles = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $roles[] = $row;
            }

            return $roles;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getRoleById($id)
    {
        $query = "SELECT * FROM role WHERE id = ?";

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
        $query = "INSERT INTO role (role_name, role_description) VALUES (?,?)";

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
        $query = "UPDATE role SET role_name = ?, role_description = ? WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$role_name, $role_description, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteRole($id) {
        $query = " DELETE FROM role WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


}































