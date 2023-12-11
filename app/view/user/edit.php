<?php

$title = 'Edit user';

ob_start();

?>

<h1>Изменение пользователя</h1>

<form class="form" method="post" action="//<?= APP_BASE_PATH ?>/user/update/<?php echo $user['id']; ?>">
    <div>
        <label for="username">username</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
    </div>
    <div>
        <label for="email">email</label>
        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div>
        <label for="role" >Role</label>
        <select id="role" name="role">
            <?php foreach ($roles as $role): ?>
                <option value="<?php echo $role['id']; ?>" <?php echo $user['role'] == $role['id'] ? 'selected' : ''; ?>><?php echo $role['role_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit">Update</button>
</form>

<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
