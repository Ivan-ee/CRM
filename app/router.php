<?php

namespace app;

use controller\role\RoleController;
use controller\auth\AuthController;
use controller\user\UserController;
use controller\page\PageController;
use controller\home\HomeController;
use controller\todo\category\CategoryController;
use controller\todo\task\TaskController;


class Router
{

    private $routes = [
        '/^\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'],
        '/^\/user(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'user\\UserController'],
        '/^\/auth(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'auth\\AuthController'],
        '/^\/role(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'role\\RoleController'],
        '/^\/page(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'page\\PageController'],
        '/^\/(register|login|authenticate|logout)(\/(?P<action>[a-z]+))?$/' => ['controller' => 'auth\\AuthController'],
        '/^\/todo\/category(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'todo\category\\CategoryController'],
        '/^\/todo\/task(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'todo\task\\TaskController'],
        '/^\/todo\/task\/by-tag(\/(?P<id>\d+))?$/' => ['controller' => 'todo\task\\TaskController', 'action' => 'tasksByTag'],
        '/^\/todo\/task\/update-status(\/(?P<id>\d+))?$/' => ['controller' => 'todo\task\\TaskController', 'action' => 'updateStatus'],
        '/^\/todo\/task\/task(\/(?P<id>\d+))?$/' => ['controller' => 'todo\task\\TaskController', 'action' => 'task'],
    ];

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $basePath = '/CRM';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        $controller = null;
        $action = null;
        $params = null;

        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                $controller = "controller\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
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
