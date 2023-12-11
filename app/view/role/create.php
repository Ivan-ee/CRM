<?php

$title = 'Создание роли';

ob_start();

?>

<h1>Создание роли</h1>

<form class="form" method="post" action="//<?= APP_BASE_PATH ?>/role/store">
    <div>
        <label for="role_name">Название</label>
        <input type="text" id="role_name" name="role_name" required>
    </div>
    <div>
        <label for="role_description">Описание</label>
        <input type="text" id="role_description" name="role_description" required>
    </div>
    <button type="submit">Создать роль</button>
</form>

<?php

$content = ob_get_clean();

include 'app/view/layout.php';

?>
