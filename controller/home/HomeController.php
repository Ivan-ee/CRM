<?php

namespace controller\home;

use model\todo\task\TaskModel;

class HomeController {
    public function index() {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

        $taskModel = new TaskModel();
        $tasks = $taskModel->getAllTasksByIdUser($user_id);
        $tasksJson = json_encode($tasks);

        include 'app/view/index.php';
    }
}

