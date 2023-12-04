<?php

$title = 'Create role';

ob_start();

?>

<form method="post" action="index.php?page=roles&action=update">
    <input type="hidden" name="id" value="<?= $role['id'] ?>">
    <div>
        <label for="role_name">Role_name</label>
        <input type="text" id="role_name" name="role_name" value="<?= $role['role_name'] ?>" required>
    </div>
    <div>
        <label for="role_description">Role_description</label>
        <input type="text" id="role_description" name="role_description" value="<?= $role['role_description'] ?>" required>
    </div>
    <button type="submit">Update Role</button>
</form>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>
