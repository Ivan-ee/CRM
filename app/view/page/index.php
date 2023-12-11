<?php

$title = 'Страницы';
ob_start();
?>

    <h1>Страницы</h1>
    <a href="//<?= APP_BASE_PATH ?>/page/create" class="btn btn-create">Создать страницу</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Слаг</th>
            <th>Роли</th>
            <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($pages as $page): ?>
            <tr>
                <td><?= $page['id'] ?></td>
                <td><?= $page['title'] ?></td>
                <td><?= $page['slug'] ?></td>
                <td><?= $page['role'] ?></td>
                <td>
                    <a href="//<?= APP_BASE_PATH ?>/page/edit/<?= $page['id'] ?>" class="btn btn-edit">Редактировать</a>
                    <a href="//<?= APP_BASE_PATH ?>/page/delete/<?= $page['id'] ?>" class="btn btn-delete" onclick="return confirm('Вы уверенны?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>



<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>