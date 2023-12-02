<?php

class Router
{
    public function run()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        switch ($page) {
            case '':
            case 'home':

            case 'users':
                $controller = new UserController();
                if (isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'create':
                            $controller->create();
                            break;
                        case 'store':
                            $controller->store();
                            break;
                    }
                } else {
                    $controller->index();
                }
                break;
            default:
                http_response_code(404);
                echo 'Страница не найдена';
        }
    }
}
