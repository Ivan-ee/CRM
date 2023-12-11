<?php

$title = 'КАтегории';
ob_start();
?>

    <h1>Категории</h1>
    <a href="//<?= APP_BASE_PATH ?>/todo/category/create" class="btn btn-create">Создать категорию</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Активная</th>
            <th>Дейвтсвие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categories as $category): ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><?= $category['title'] ?></td>
                <td><?= $category['description'] ?></td>
                <td><?= $category['usability'] == 1 ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category/edit/<?= $category['id'] ?>" class="btn btn-edit">Редактировать</a>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category/delete/<?= $category['id'] ?>" class="btn btn-delete" onclick="return confirm('Вы уверенны?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>



<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>