<?php

namespace controller\todo\task;

use model\check\CheckModel;
use model\todo\category\CategoryModel;
use model\todo\task\TaskModel;
use model\todo\tag\TagModel;

class TaskController{

    private $check;
    private $tagModel;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new CheckModel($userRole);
        $this->tagModel = new TagModel();
    }

    public function index(){
        $this->check->requirePermission();
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllTasksByIdUser($user_id);

        $categoryModel = new CategoryModel();

        foreach($tasks as &$task){
            $task['tags'] = $this->tagModel->getTagsByTaskId($task['id']);
            $task['category'] = $categoryModel->getCategoryById($task['category_id']);
        }

        include 'app/view/todo/task/index.php';
    }

    public function completed(){
        $this->check->requirePermission();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $completedTasks = $taskModel->getAllCompletedTasksByIdUser($user_id);

        $categoryModel = new CategoryModel();

        foreach($completedTasks as &$task){
            $task['tags'] = $this->tagModel->getTagsByTaskId($task['id']);
            $task['category'] = $categoryModel->getCategoryById($task['category_id']);
        }

        include 'app/view/todo/task/completed.php';
    }

    public function expired(){
        $this->check->requirePermission();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $expiredTasks = $taskModel->getAllExpiredTasksByIdUser($user_id);

        $categoryModel = new CategoryModel();

        foreach($expiredTasks as &$task){
            $task['tags'] = $this->tagModel->getTagsByTaskId($task['id']);
            $task['category'] = $categoryModel->getCategoryById($task['category_id']);
        }

        include 'app/view/todo/task/expired.php';
    }

    public function create(){
        $this->check->requirePermission();

        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategoriesWithUsability();

        include 'app/view/todo/task/create.php';
    }

    public function store(){

        $this->check->requirePermission();

        if(isset($_POST['title']) && isset($_POST['category_id']) && isset($_POST['finish_date'])){
            $data['title'] = $_POST['title'];
            $data['category_id'] = $_POST['category_id'];
            $data['finish_date'] = $_POST['finish_date'];
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
            $data['status'] = 'new';
            $data['description'] = $_POST['description'];
            $data['priority'] = 'low';

//            tte($data);

            $taskModel = new TaskModel();
            $taskModel->createTask($data);

        }
        $path = '//' . APP_BASE_PATH . '/todo/task';
        header("Location: $path");
    }

    public function edit($params){
        $this->check->requirePermission();

        $taskModel = new TaskModel();
        $task = $taskModel->getTaskById($params['id']);

        $todoCategoryModel = new CategoryModel();
        $categories = $todoCategoryModel->getAllCategoriesWithUsability();

        if(!$task){
            echo "Task not found";
            return;
        }

        $tags = $this->tagModel->getTagsByTaskId($task['id']);

        include 'app/view/todo/task/edit.php';
    }


    public function update(){
        $this->check->requirePermission();

        if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['category_id']) && isset($_POST['finish_date'])){
            $data['id'] = $_POST['id'];
            $data['title'] = $_POST['title'];
            $data['category_id'] = $_POST['category_id'];
            $data['finish_date'] = $_POST['finish_date'];
            $data['reminder_at'] = $_POST['reminder_at'];
            $data['status'] = $_POST['status'];
            $data['priority'] = $_POST['priority'];
            $data['description']  = $_POST['description'];
            $data['user_id'] = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

            $finish_date_value = $data['finish_date'];
            $reminder_at_option = $data['reminder_at'];
            $finish_date = new \DateTime($finish_date_value);

            switch ($reminder_at_option) {
                case '30_minutes':
                    $interval = new \DateInterval('PT30M');
                    break;
                case '1_hour':
                    $interval = new \DateInterval('PT1H');
                    break;
                case '2_hours':
                    $interval = new \DateInterval('PT2H');
                    break;
                case '12_hours':
                    $interval = new \DateInterval('PT12H');
                    break;
                case '24_hours':
                    $interval = new \DateInterval('P1D');
                    break;
                case '7_days':
                    $interval = new \DateInterval('P7D');
                    break;
            }

//            tte($interval, $finish_date);

            $reminder_at = $finish_date->sub($interval);
            $data['reminder_at'] = $reminder_at->format('Y-m-d\TH:i');

            $taskModel = new TaskModel();
            $taskModel->updateTask($data);

//            tte($data);

            $tags = explode(',', $_POST['tags']);
            $tags = array_map('trim', $tags);

            $oldTags = $this->tagModel->getTagsByTaskId($data['id']);

            $this->tagModel->removeAllTaskTags($data['id']);

            foreach ($tags as $tag_name){
                $tag_name = strtolower($tag_name);
                $tag = $this->tagModel->getTagByNameAndUserId($tag_name, $data['user_id']);
                if (!$tag){
                    $tag_id = $this->tagModel->addTag($tag_name, $data['user_id']);
                } else{
                    $tag_id = $tag['id'];
                }

                $this->tagModel->addTaskTag($data['id'], $tag_id);
            }

            foreach ($oldTags as $oldTag){
                $this->tagModel->removeUnusedTag($oldTag['id']);
            }

        }

        $path = '//'. APP_BASE_PATH . '/todo/task';
        header("Location: $path");
    }

    public function delete($params){
        $this->check->requirePermission();

        $taskModel = new TaskModel();
        $taskModel->deleteTask($params['id']);


        $path = '//'. APP_BASE_PATH . '/todo/task';
        header("Location: $path");
    }

    public function tasksByTag($params){
        $this->check->requirePermission();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $tasksByTag = $taskModel->getTasksByTagId($params['id'], $user_id);

        $tagModel = new TagModel();
        $tagName = $tagModel->getTagNameById($params['id']);

        $categoryModel = new CategoryModel();

        foreach ($tasksByTag as &$task) {
            $task['tags'] = $this->tagModel->getTagsByTaskId($task['task_id']);
            $task['category'] = $categoryModel->getCategoryById($task['category_id']);
        }

        include 'app/view/todo/task/by-tag.php';
    }

    public function updateStatus($params){
        $this->check->requirePermission();

        $datetime = null;
        $status = $_POST['status'];

        if($status){
            if($status === 'completed'){
                $datetime = date("Y-m-d H:i:s");
            }

            $taskModel = new TaskModel();
            $taskModel->updateTaskStatus($params['id'], $status, $datetime);

            $path = '//' . APP_BASE_PATH . '/todo/task';
            header("Location: $path");
        }else{
            echo "Не удалось обновить статус";
        }

    }

    public function task($params){
        $this->check->requirePermission();

        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $task = $taskModel->getTaskByIdAndByIdUser($params['id'], $user_id);

        $todoCategoryModel = new CategoryModel();
        $category = $todoCategoryModel->getCategoryById($task['category_id']);

        if(!$task){
            echo "Task not found";
            return;
        }

        $tags = $this->tagModel->getTagsByTaskId($task['id']);

        include 'app/view/todo/task/task.php';
    }

}