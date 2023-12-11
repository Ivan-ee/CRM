<?php

$title = 'Редактирование категории';
ob_start();
?>

    <h1>Редактирование категории</h1>
    <form class="form" method="POST" action="//<?= APP_BASE_PATH ?>/todo/category/update/<?php echo $category['id']; ?>">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <div>
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="<?= $category['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" >Описание</label>
            <textarea id="description" name="description" required><?= $category['description'] ?></textarea>
        </div>
        <div class="form-checkbox">
            <input type="checkbox" id="category_usability" name="usability" value="1" <?php echo $category['usability'] ? ' checked' : '';?>>
            <label for="category_usability">Активная</label>
        </div>
        <button type="submit" class="btn btn-create">Обновить категорию</button>
    </form>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>