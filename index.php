<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'app/model/database.php';
require_once 'app/model/user.php';

require_once 'app/controller/user/authController.php';
require_once 'app/controller/user/userController.php';

require_once 'app/router.php';

$router = new Router();
$router->run();
