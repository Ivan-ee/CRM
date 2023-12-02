<?php

class Router
{
    public function run() {
        $page = $_GET['page'] ?? 'home';

        switch ($page){
            case 'user':
                $controller = new UserController();
                $controller->index();
                break;
            default:
                http_response_code(404);
                echo 'Страница не найдена';
        }
    }
}
