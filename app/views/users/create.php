<?php

$title = 'User list';

ob_start();

?>

<form method="post" action="index.php?page=users&action=store">
    <div>
        <label for="login">login</label>
        <input type="text" id="login" name="login" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div>
        <label for="admin">Admin</label>
        <select id="admin" name="admin">
            <option value="0">No</option>
            <option value="1">YeS</option>
        </select>
    </div>
    <button type="submit">Create</button>
</form>

<?php

$content = ob_get_clean();

include 'app/views/layout.php';

?>
