<?php

$title = 'Редактирование роли';

ob_start();

?>

<h1>Редактирование роли</h1>

<form class="form" method="post" action="//<?= APP_BASE_PATH ?>/role/update/<?php echo $role['id']; ?>">
    <input type="hidden" name="id" value="<?= $role['id'] ?>">
    <div>
        <label for="role_name">Название</label>
        <input type="text" id="role_name" name="role_name" value="<?= $role['role_name'] ?>" required>
    </div>
    <div>
        <label for="role_description">Описание</label>
        <textarea class="form-control" id="role_description" name="role_description" required><?= $role['role_description'] ?></textarea>
    </div>
    <button type="submit">Обоновить роль</button>
</form>

<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
