<?php

namespace model\todo\task;

use model\database\Database;

class TaskModel {
    private $database;

    public function __construct(){
        $this->database = Database::getInstance()->getConnection();

        try{
            $result = $this->database->query("SELECT 1 FROM `todo_list` LIMIT 1");
        } catch(\PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $query = "CREATE TABLE IF NOT EXISTS `todo_list` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `user_id` INT NOT NULL,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `category_id` INT NOT NULL,
            `status` ENUM('new', 'in_progress', 'completed', 'on_hold', 'cancelled') NOT NULL,
            `priority` ENUM('low', 'medium', 'high', 'urgent') NOT NULL,
            `assigned_to` INT,
            `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
            `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            `finish_date` DATETIME,
            `copleted_at` DATETIME,
            `reminder_at` DATETIME,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES todo_category(id) ON DELETE SET NULL,
            FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
        )";

        try{
            $this->database->exec($query);
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function getAllTasks(){

        try{
            $stmt = $this->database->query("SELECT * FROM todo_list");
            $todo_list = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $todo_list[] = $row;
            }
            return $todo_list;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function getAllTasksByIdUser($user_id){

        try{
            $stmt = $this->database->prepare("SELECT * FROM todo_list WHERE finish_date > NOW() AND user_id = :user_id AND status != 'completed' ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))" );
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $todo_list = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $todo_list[] = $row;
            }
            return $todo_list;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function getAllCompletedTasksByIdUser($user_id){

        try{
            $stmt = $this->database->prepare("SELECT * FROM todo_list WHERE user_id = :user_id AND status = 'completed' ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))" );
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $todo_list = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $todo_list[] = $row;
            }
            return $todo_list;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function getAllExpiredTasksByIdUser($user_id){

        try{
            $stmt = $this->database->prepare("SELECT * FROM todo_list WHERE finish_date < NOW() AND user_id = :user_id ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date))" );
            $stmt->bindParam(':user_id', $user_id, \PDO::PARAM_INT);
            $stmt->execute();
            $todo_list = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $todo_list[] = $row;
            }
            return $todo_list;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function createTask($data)

    {
        $query = "INSERT INTO todo_list (user_id, description, title, category_id, status, priority, finish_date) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$data['user_id'], $data['description'] ,$data['title'], $data['category_id'], $data['status'], $data['priority'], $data['finish_date']]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getTaskById($id)
    {
        $query = "SELECT * FROM todo_list WHERE id = ?";

        try{
            $stmt =$this->database->prepare($query);
            $stmt->execute([$id]);
            $todo_task = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $todo_task ? $todo_task : false;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function getTaskByIdAndByIdUser($id_task, $id_user)
    {
        $query = "SELECT * FROM todo_list WHERE id = ? AND user_id = ?";

        try{
            $stmt =$this->database->prepare($query);
            $stmt->execute([$id_task, $id_user]);
            $todo_task = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $todo_task ? $todo_task : [];
        } catch(\PDOException $e){
            return false;
        }
    }

    public function updateTask($data)
    {
        $query = "UPDATE todo_list SET title = ?, category_id = ?, finish_date = ?, reminder_at = ?, status = ?, priority = ?, description = ? WHERE id = ?";

//        tte($data);

        try{
            $stmt = $this->database->prepare($query);
            $stmt->execute([$data['title'], $data['category_id'], $data['finish_date'], $data['reminder_at'], $data['status'], $data['priority'], $data['description'], $data['id']]);

            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function deleteTask($id)
    {
        $query = "DELETE FROM todo_list WHERE id = ?";

        try {
            $stmt = $this->database->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function getTasksByTagId($tag_id, $user_id){

        $query = "SELECT * FROM todo_list
        JOIN task_tags ON todo_list.id = task_tags.task_id
        WHERE task_tags.tag_id = :tag_id AND todo_list.user_id = :user_id ORDER BY ABS(TIMESTAMPDIFF(SECOND, NOW(), finish_date));";

        try{
            $stmt = $this->database->prepare($query);
            $stmt->execute(['tag_id' => $tag_id, 'user_id' => $user_id]);
            $todo_list = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $todo_list ? $todo_list : $todo_list = [];
        }catch(\PDOException $e){
            return false;
        }
    }

    public function updateTaskStatus($id, $status, $datetime){

        $query = "UPDATE todo_list SET status = :status";

        try{
            if($datetime !== null){
                $query .= ", copleted_at = :copleted_at";
            }else{
                $query .= ", copleted_at = NULL";
            }

            $query .= " WHERE id = :id";

            $stmt = $this->database->prepare($query);

            $params = [':status' => $status, ':id' => $id];

            if($datetime !== null){
                $params[':copleted_at'] = $datetime;
            }

            $stmt->execute($params);
            return $stmt->rowCount() > 0;
        }catch(\PDOException $e){
            return false;
        }
    }


}
