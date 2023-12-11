<?php

$title = 'Роли';

ob_start();

?>

    <h1>Роли</h1>
    <table class="table">

        <thead>
        <tr>
            <th >ID</th>
            <th >Название</th>
            <th >Описание</th>
            <th >Действие</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?php echo $role['id']; ?></td>
                <td><?php echo $role['role_name']; ?></td>
                <td><?php echo $role['role_description']; ?></td>
                <td>
                    <a class="btn btn-edit" href="//<?= APP_BASE_PATH ?>/role/edit/<?php echo $role['id']; ?>" >Редактировать</a>
                    <a class="btn btn-delete" href="//<?= APP_BASE_PATH ?>/role/delete/<?php echo $role['id']; ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

<?php
$content = ob_get_clean();

include 'app/view/layout.php';

?>