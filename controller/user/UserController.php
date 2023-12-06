<?php

namespace controller\user;

use model\role\RoleModal;
use model\user\UserModel;

class UserController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->readAll();

        include 'app/view/users/index.php';
    }

    public function create()
    {
        include 'app/view/users/create.php';
    }

    public function store()
    {
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

        $path = '//' . APP_BASE_PATH . '/users';
        header("Location: $path");
    }

    public function edit($params)
    {
        $userModel = new UserModel();
        $user = $userModel->read($params['id']);

        $roleModel = new RoleModal();
        $roles = $roleModel->getAllRoles();

        include 'app/view/users/edit.php';
    }

    public function update($params)
    {
        $userModel = new UserModel();
        $userModel->update($params['id'], $_POST);

        $path = '//' . APP_BASE_PATH . '/users';
        header("Location: $path");
    }

    public function delete($params)
    {
        $userModel = new UserModel();
        $userModel->delete($params['id']);

        $path = '//' . APP_BASE_PATH . '/users';
        header("Location: $path");
    }
}

