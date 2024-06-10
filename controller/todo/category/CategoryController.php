<?php

namespace controller\todo\category;

use model\check\CheckModel;
use model\todo\category\CategoryModel;

class CategoryController
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
        $this->check->requirePermission();

        header('Content-Type: application/json');

        if (isset($_POST['title']) && isset($_POST['description'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $user_id = $_SESSION['user_id'] ?? 0;

            $categoryModel = new CategoryModel();
            $result = $categoryModel->createCategory($title, $description, $user_id);

            $message = sprintf('Категория "%s" с описанием "%s" успешно создана!', $title, $description);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => $message]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ошибка при создании категории.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Пожалуйста, заполните все поля.']);
        }
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
        $this->check->requirePermission();

        header('Content-Type: application/json');

        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['description'])) {
            $id = $params['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $usability = $_POST['usability'] ?? 0;

            $categoryModel = new CategoryModel();
            $oldCategory = $categoryModel->getCategoryById($id);

            $result = $categoryModel->updateCategory($id, $title, $description, $usability);

            if ($result) {
                $message = sprintf(
                    'Категория "%s" с описанием "%s" была обновлена на "%s" и "%s".',
                    $oldCategory['title'],
                    $oldCategory['description'],
                    $title,
                    $description
                );
                echo json_encode(['status' => 'success', 'message' => $message]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ошибка при обновлении категории.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Пожалуйста, заполните все поля.']);
        }
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        header('Content-Type: application/json');

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryById($params['id']);

        if ($category) {
            $result = $categoryModel->deleteCategory($params['id']);

            if ($result) {
                $message = sprintf(
                    'Категория "%s" с описанием "%s" была удалена.',
                    $category['title'],
                    $category['description']
                );
                echo json_encode(['status' => 'success', 'message' => $message, 'id' => $params['id']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ошибка при удалении категории.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Категория не найдена.']);
        }
    }

}

