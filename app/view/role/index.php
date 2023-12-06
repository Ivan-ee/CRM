<?php

$title = 'Roles';

ob_start();

?>

    <h1>Roles</h1>
    <table class="table">

        <thead>
        <tr>
            <th >ID</th>
            <th >Role name</th>
            <th >Role description</th>
            <th >Action</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($roles as $role): ?>
            <tr>
                <td><?php echo $role['id']; ?></td>
                <td><?php echo $role['role_name']; ?></td>
                <td><?php echo $role['role_description']; ?></td>
                <td>
                    <a href="//<?= APP_BASE_PATH ?>/role/edit/<?php echo $role['id']; ?>" >Edit</a>
                    <a href="//<?= APP_BASE_PATH ?>/role/delete/<?php echo $role['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

<?php
$content = ob_get_clean();

include 'app/view/layout.php';

?>