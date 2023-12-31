<?php

namespace controller\todo\category;

use model\check\CheckModel;
use model\todo\category\CategoryModel;

class CategoryController
{
    private $check;

    public function __construct() {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new CheckModel($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();

        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        include 'app/view/todo/category/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();

        include 'app/view/todo/category/create.php';
    }

    public function store()
    {
//        $this->check->requirePermission();

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_id = $_SESSION['user_id'] ?? 0;

            $categoryModel = new CategoryModel();
            $categoryModel->createCategory($title, $description, $user_id);
        }

        $path = '//' . APP_BASE_PATH . '/todo/category';
        header("Location: $path");
    }

    public function edit($params)
    {
        $this->check->requirePermission();

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryById($params['id']);

        if (!$category) {
            echo "category не найдена.";
            return;
        }

        include 'app/view/todo/category/edit.php';
    }

    public function update($params)
    {
//        $this->check->requirePermission();

        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['description'])) {
            $id = $params['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $usability  = $_POST['usability'] ?? 0;


            $categoryModel = new CategoryModel();
            $categoryModel->updateCategory($id, $title, $description, $usability);
        }

        $path = '//' . APP_BASE_PATH . '/todo/category';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $categoryModel = new CategoryModel();
        $categoryModel->deleteCategory($params['id']);

        $path = '//' . APP_BASE_PATH . '/todo/category';
        header("Location: $path");
    }
}

