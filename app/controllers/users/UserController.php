<?php

require_once 'app/models/User.php';

class UserController{
    public function index() {
        $userModel = new User();
        $users = $userModel->readAll();

        include 'app/views/users/index.php';
    }

    public function create() {
        include 'app/views/users/create.php';
    }

    public function store() {
        if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['admin'])){
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password){
                echo "Пароли не совпадают";
                return;
            }

            $userModel = new User();
            $userModel->create($_POST);
        }
        header("Location: index.php?page=users");
    }

    public function delete() {
        $userModel = new User();
        $userModel->delete($_GET['id']);

        header("Location: index.php?page=users");
    }
}

