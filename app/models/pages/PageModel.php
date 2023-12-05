<?php

class PageModel
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance()->getConnection();

        try {
            $result = $this->database->query("SELECT 1 FROM `pages` LIMIT 1");
        } catch (PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $pageTableQuery = "CREATE TABLE IF NOT EXISTS `pages` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          ";

        try {
            $this->database->exec($pageTableQuery);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllPages()
    {
        try {
            $stmt = $this->database->query("SELECT * FROM pages");

            $pages = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pages[] = $row;
            }

            return $pages;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getPageById($id)
    {
        $query = "SELECT * FROM pages WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createPage($title, $slug)
    {
        $query = "INSERT INTO pages (title, slug) VALUES (?,?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$title, $slug]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updatePage($id, $title, $slug)
    {
        $query = "UPDATE pages SET title = ?, slug = ? WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$title, $slug, $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deletePage($id)
    {
        $query = " DELETE FROM pages WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


}































