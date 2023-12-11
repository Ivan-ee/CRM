<?php

$title = 'Создание страницы';
ob_start();
?>

    <h1>Создание страницы</h1>
    <form class="form" method="POST" action="//<?= APP_BASE_PATH ?>/page/store">
        <div>
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div>
            <label for="slug" class="form-label">Слаг</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>
        <div>
            <label for="roles">Роли</label>
            <?php foreach ($roles as $role): ?>
                <div class="form-checkbox">
                    <input type="checkbox" name="roles[]" value="<?php echo $role['id']; ?>">
                    <label for="roles"><?php echo $role['role_name']; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-create">Создать страницу</button>
    </form>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>