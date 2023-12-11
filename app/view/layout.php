<!DOCTYPE>
<html lang="ru">
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="//<?= APP_BASE_PATH ?>/app/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
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
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/create" class="nav-link text-white">
                        Create task
                    </a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/task" class="nav-link text-white">
                        Tasks (opened)
                    </a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/completed" class="nav-link text-white">
                        Tasks (completed)
                    </a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/expired" class="nav-link text-white">
                        Tasks (expired)
                    </a>
                </li>
                <li>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category">
                        Category
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <?php echo $content; ?>
    </div>

</div>

<script src="//<?= APP_BASE_PATH ?>/app/js/main.js"></script>
</body>
</html>