<?php

$title = 'Редактирование страницы';
ob_start();
?>

    <h1 >Edit Page</h1>
    <form class="form" method="POST" action="//<?= APP_BASE_PATH ?>/page/update/<?= $page['id'] ?>">
        <input type="hidden" name="id" value="<?= $page['id'] ?>">
        <div>
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="<?= $page['title'] ?>" required>
        </div>
        <div>
            <label for="slug">Слаг</label>
            <input type="text" id="slug" name="slug" value="<?= $page['slug'] ?>" required>
        </div>
        <div>
            <label for="roles">Роли</label>
            <?php $page_roles = explode(',', $page['role']); ?>
            <?php foreach ($roles as $role): ?>
                <div class="form-checkbox">
                    <input type="checkbox" name="roles[]" value="<?php echo $role['id']; ?>" <?php echo in_array($role['id'], $page_roles) ? 'checked' : '';?>>
                    <label for="roles"><?php echo $role['role_name']; ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-create">Update Page</button>
    </form>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>