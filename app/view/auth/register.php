<?php

$title = 'Register UserModel';

ob_start();

?>

<form method="post" action="//<?= APP_BASE_PATH ?>/auth/store">
    <div>
        <label for="username">username</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit">Register</button>
</form>
<p>Уже есть аккаунт? <a href="//<?= APP_BASE_PATH ?>/auth/login">Войти</a> </p>

<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
