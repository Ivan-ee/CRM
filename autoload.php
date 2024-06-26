<?php



spl_autoload_register(function ($class) {
    if (in_array($class, ['PDO', 'Exception', 'DateTime', 'DateInterval'])) {
        return;
    }

    $classPath = '';

    if (strpos($class, 'model\\') === 0 || strpos($class, 'controller\\') === 0 || strpos($class, 'app\\') === 0) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $classPath = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    }

    if (!empty($classPath) && file_exists($classPath)) {
        require_once $classPath;
    } else {
        throw new Exception("Class {$class} not found in {$classPath}");
    }
});
