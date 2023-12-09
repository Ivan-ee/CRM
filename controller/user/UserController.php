<?php

namespace controller\user;

use model\check\CheckModel;
use model\role\RoleModel;
use model\user\UserModel;

class UserController
{
    private $check;

    public function __construct() {
        $userRole = $_SESSION['user_role'] ?? null;
        $this->check = new CheckModel($userRole);
    }

    public function index()
    {
        $this->check->requirePermission();

        $userModel = new UserModel();
        $users = $userModel->readAll();

        include 'app/view/user/index.php';
    }

    public function create()
    {
        $this->check->requirePermission();

        include 'app/view/user/create.php';
    }

    public function store()
    {
//        $this->check->requirePermission();

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                echo "Пароли не совпадают";
                return;
            }

            $userModel = new UserModel();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            $userModel->create($data['username'], $data['email'], $data['password']);
        }

        $path = '//' . APP_BASE_PATH . '/user';
        header("Location: $path");
    }

    public function edit($params)
    {
        $this->check->requirePermission();

        $userModel = new UserModel();
        $user = $userModel->read($params['id']);

        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRoles();

        include 'app/view/user/edit.php';
    }

    public function update($params)
    {
//        $this->check->requirePermission();

        $userModel = new UserModel();
        $userModel->update($params['id'], $_POST);

        $path = '//' . APP_BASE_PATH . '/user';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $userModel = new UserModel();
        $userModel->delete($params['id']);

        $path = '//' . APP_BASE_PATH . '/user';
        header("Location: $path");
    }
}

