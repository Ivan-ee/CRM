<!DOCTYPE>
<html lang="ru">
<head>
    <title><?= $title ?></title>
</head>
<body>
<div>
    <nav>
        <a href="//<?= APP_BASE_PATH ?>">CRM</a>
        <div>
            <ul>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/user">Users</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/page">Pages</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/role">All Roles</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/role/create">Create Role</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/register">Register</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/auth/login">Login</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/logout">Logout</a>
                </li>
                <h4>To do list</h4>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="//<?= APP_BASE_PATH ?>/todo/category"></use></svg>
                        Category
                    </a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/task">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="//<?= APP_BASE_PATH ?>/todo/task"></use></svg>
                        Task
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <?php echo $content; ?>
    </div>

</div>
</body>
</html>