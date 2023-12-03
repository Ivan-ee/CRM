<?php

$title = 'Edit user';

ob_start();

?>



<form method="post" action="index.php?page=users&action=update&id=<?php echo $user['id']; ?>">
    <div>
        <label for="login">login</label>
        <input type="text" id="login" name="login" value="<?php echo $user['login']; ?>" required>
    </div>
    <div>
        <label for="admin">Admin</label>
        <select id="admin" name="admin">
            <option value="0" <?php if (!$user['is_admin']) {echo 'selected';} ?> >No</option>
            <option value="1" <?php if ($user['is_admin']) {echo 'selected';} ?> >YeS</option>
        </select>
    </div>
    <button type="submit">Update</button>
</form>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>
