<?php

namespace controller\todo\task;

use model\check\CheckModel;
use model\todo\category\CategoryModel;
use model\todo\task\TaskModel;
use model\todo\tag\TagModel;

class TaskController
{
    private $check;

    public function __construct()
    {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new CheckModel($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();

        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllTasks();

        include 'app/view/todo/task/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();

        $CategoryModel = new CategoryModel();
        $categories = $CategoryModel->getAllCategoriesWithUsability();

        include 'app/view/todo/task/create.php';
    }

    public function store()
    {

        $this->check->requirePermission();

        if (isset($_POST['title']) && isset($_POST['category_id']) && isset($_POST['finish_date'])) {
            $data['title'] = trim($_POST['title']);
            $data['category_id'] = trim($_POST['category_id']);
            $data['finish_date'] = trim($_POST['finish_date']);
            $data['user_id'] = $_SESSION['user_id'] ?? 0;
            $data['status'] = 'new';
            $data['priority'] = 'low';

            $taskModel = new TaskModel();
            $taskModel->createTask($data);

        }
        $path = '//' . APP_BASE_PATH . '/todo/task';
        header("Location: $path");
    }

    public function edit($params)
    {
        $this->check->requirePermission();

        $taskModel = new TaskModel();
        $task = $taskModel->getTaskById($params['id']);

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategoriesWithUsability();

        if (!$task) {
            echo "task not found";
            return;
        }

        $tagsModel = new TagModel();
        $tags = $tagsModel->getTagsByTaskId($task['id']);

        include 'app/view/todo/task/edit.php';
    }


    public function update($params)
    {
        $this->check->requirePermission();

        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['description'])) {
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $usability = $_POST['usability'] ?? 0;

            if (empty($title) || empty($description)) {
                echo "Title and Description are required";
                return;
            }

            $todoCategoryModel = new CategoryModel();
            $todoCategoryModel->updateCategory($id, $title, $description, $usability);
        }
        $path = '//' . APP_BASE_PATH . '/todo/category';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $todoCategoryModel = new CategoryModel();
        $todoCategoryModel->deleteCategory($params['id']);

        $path = '//' . APP_BASE_PATH . '/todo/category';
        header("Location: $path");
    }
}

