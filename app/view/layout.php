<!DOCTYPE>
<html lang="ru">
<head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="//<?= APP_BASE_PATH ?>/app/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
</head>
<body>

<div class="flex-container">
    <nav class="sidebar">
        <div class="name">
            <a href="//<?= APP_BASE_PATH ?>">CRM</a>
        </div>
        <div>
            <ul>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/user">Пользователи</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/page">Страницы</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/role">Все роли</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/role/create">Создать роль</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/auth/register">Регистрация</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/auth/login">Вход</a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/auth/logout">Выход</a>
                </li>
                <h4 class="sidebar-header">Список задач</h4>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/create">
                        Создать задачу
                    </a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/todo/task">
                        Задачи - открытые
                    </a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/completed">
                        Задачи - выполненные
                    </a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/todo/task/expired">
                        Задачи - просроченные
                    </a>
                </li>
                <li class="sidebar-element">
                    <a href="//<?= APP_BASE_PATH ?>/todo/category">
                        Категории
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="main">
        <?php echo $content; ?>
    </div>

</div>

<script src="//<?= APP_BASE_PATH ?>/app/js/main.js"></script>
</body>
</html>