<?php
namespace app;

use controller\role\RoleController;
use controller\auth\AuthController;
use controller\user\UserController;
use controller\page\PageController;
use controller\home\HomeController;


class Router {

    private $routes = [
        '/^\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
        '/^\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'user\\UserController'],
        '/^\/auth(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'auth\\AuthController'],
        '/^\/roles(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'role\\RoleController'],
        '/^\/pages(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'page\\PageController'],
        '/^\/(register|login|authenticate|logout)(\/(?P<action>[a-z]+))?$/' => ['controller' => 'auth\\AuthController'],
        '/^\/todo\/category(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'todo\category\\CategoryController'],
        '/^\/todo\/tasks(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'todo\tasks\\TaskController'],
        '/^\/todo\/tasks\/by-tag(\/(?P<id>\d+))?$/' => ['controller' => 'todo\tasks\\TaskController', 'action' => 'tasksByTag'],
        '/^\/todo\/tasks\/update-status(\/(?P<id>\d+))?$/' => ['controller' => 'todo\tasks\\TaskController', 'action' => 'updateStatus'],
        '/^\/todo\/tasks\/task(\/(?P<id>\d+))?$/' => ['controller' => 'todo\tasks\\TaskController', 'action' => 'task'],
        '/^\/quiz(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'quiz\\QuizController'],
        '/^\/shortlink(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'shortlink\\ShortLinkController'],
        '/^\/([a-zA-Z0-9-]{6,10})$/' => ['controller' => 'shortlink\\ShortLinkController', 'action' => 'redirect'],
    ];

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;

        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                $controller = "controller\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                // После строки $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                var_dump($uri, $controller, $action, $params);

                break;
            }
        }

        if (!$controller) {
            http_response_code(404);
            echo "Page not found!";
            return;
        }

        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo "Action not found!";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}
