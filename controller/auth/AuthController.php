<?php

namespace controller\auth;

use model\auth\AuthModel;

class AuthController
{

    public function register()
    {
        include 'app/view/auth/register.php';
    }

    public function store()
    {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                echo "ЗАполните все поля";
                return;
            }

            if ($password !== $confirm_password) {
                echo "пароли не совпадают";
                return;
            }

            $authModel = new AuthModel();

            $data = $authModel->findByEmail($email);

            if ($data){
                echo "Пользователь с таким email уже существует";
                return;
            }

            $authModel->register($username, $email, $password);
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
                $_SESSION['user_email'] = $user['email'];

                if ($remember == 'on') {
                    setcookie('user_email', $email, time() + (7 * 24 * 60 * 60), '/');
                    setcookie('user_password', $password, time() + (7 * 24 * 60 * 60), '/');
                }

                $path = '//' . APP_BASE_PATH;
                header("Location: $path");
            } else {
                echo "Invalid email or password";
            }
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $path = '//' . APP_BASE_PATH;
        header("Location: $path");
    }

}