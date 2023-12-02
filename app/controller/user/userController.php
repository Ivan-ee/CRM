<?php

require_once 'app/model/user.php';

class UserController{
    public function index() {
        $userModel = new User();
        $users = $userModel->readAll();

        include 'app/view/user/index.php';

    }
}

