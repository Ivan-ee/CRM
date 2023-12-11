<?php

$title = 'Создание категории';
ob_start();
?>

    <h1>Создание категории</h1>
    <form class="form" method="POST" action="//<?= APP_BASE_PATH ?>/todo/category/store">
        <div >
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div >
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать категорию</button>
    </form>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>