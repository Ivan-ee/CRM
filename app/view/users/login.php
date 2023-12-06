<?php

$title = 'Авторизация';

ob_start();

?>

<form method="post" action="index.php?page=auth&action=authenticate">
    <div>
        <label for="email">email</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label for="remember">Запомнить меня</label>
        <input type="checkbox" id="remember" name="remember">
    </div>
    <button type="submit">Войти</button>
</form>
<p>Нет аккаунта? <a href="index.php?page=register">Регистрация</a> </p>

<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
