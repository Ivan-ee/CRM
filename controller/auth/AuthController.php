<?php

namespace controller\auth;

use model\auth\AuthModel;

class AuthController
{
    public function index()
    {
        include 'app/view/auth/register.php';
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

            $authModel = new AuthModel();
            $data = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            $authModel->register($data['username'], $data['email'], $data['password']);
        }
        $path = '//' . APP_BASE_PATH . '/auth/login';
        header("Location: $path");
    }

    public function login()
    {
        include 'app/view/auth/login.php';
    }

    public function authenticate()
    {
        $authModel = new AuthModel();

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

            $user = $authModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];

                if ($remember == 'on'){
                    setcookie('user_email', $email, time() + (7*24*60*60), '/');
                    setcookie('user_password', $password, time() + (7*24*60*60), '/');
                }

                echo "Вы успешно вошли";

                header("Location: index.php");
            } else {
                echo "Неверный пароль или почта.";
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
}

