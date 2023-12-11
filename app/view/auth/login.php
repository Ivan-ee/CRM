<?php

$title = 'Авторизация';

ob_start();

?>

<h1>Вход</h1>

<form class="form" method="post" action="//<?= APP_BASE_PATH ?>/auth/authenticate">
    <div>
        <label for="email">Почта</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div class="form-checkbox">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Запомнить меня</label>
    </div>
    <button type="submit">Войти</button>
    <p class="auth">Нет аккаунта? <a href="//<?= APP_BASE_PATH ?>/register">Регистрация</a> </p>
</form>


<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
