<?php

require_once 'app/models/UserModel.php';
require_once 'app/models/roles/RoleModal.php';

class UserController{
    public function index() {
        $userModel = new UserModel();
        $users = $userModel->readAll();

        include 'app/views/users/index.php';
    }

    public function create() {
        include 'app/views/users/create.php';
    }

    public function store() {
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password){
                echo "Пароли не совпадают";
                return;
            }

            $userModel = new UserModel();
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'role' => 1,
            ];

            $userModel->create($data);
        }
        header("Location: index.php?page=users");
    }

    public function edit() {
        $userModel = new UserModel();
        $user = $userModel->read($_GET['id']);

        $roleModel = new RoleModal();
        $roles = $roleModel->getAllRoles($_GET['id']);

        include 'app/views/users/edit.php';
    }

    public function update() {
        $userModel = new UserModel();
        $userModel->update($_GET['id'], $_POST);

        header("Location: index.php?page=users");
    }

    public function delete() {
        $userModel = new UserModel();
        $userModel->delete($_GET['id']);

        header("Location: index.php?page=users");
    }
}

