<?php

$title = 'Register UserModel';

ob_start();

?>

<h1>Регистрация</h1>

<form class="form" method="post" action="//<?= APP_BASE_PATH ?>/auth/store">
    <div>
        <label for="username">Имя пользователя</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="email">Почта</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="confirm_password">Подтверждения пароля</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <button type="submit">Register</button>
    <p class="auth">Уже есть аккаунт? <a href="//<?= APP_BASE_PATH ?>/auth/login">Войти</a> </p>
</form>


<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
