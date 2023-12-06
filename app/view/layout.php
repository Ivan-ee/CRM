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
                    <a href="//<?= APP_BASE_PATH ?>/users">Users</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/pages">Pages</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/roles">All Roles</a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/roles/create">Create Role</a>
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
            </ul>
        </div>
    </nav>
    <div>
        <?php echo $content; ?>
    </div>

</div>
</body>
</html>