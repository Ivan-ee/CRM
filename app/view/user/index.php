<?php

$title = 'UserModel list';

ob_start();

?>

<h1>User list</h1>
<a href="//<?= APP_BASE_PATH ?>/user/create">Create User</a>
<table class="table">

<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">Username</th>
    <th scope="col">Email</th>
    <th scope="col">Email verification</th>
    <th scope="col">Is admin</th>
    <th scope="col">Role</th>
    <th scope="col">Is active</th>
    <th scope="col">Last login</th>
</tr>
</thead>

<tbody>
<?php foreach ($users as $user): ?>
<tr>
    <td><?php echo $user['id']; ?></td>
    <td><?php echo $user['username']; ?></td>
    <td><?php echo $user['email']; ?></td>
    <td><?php echo $user['email_verification']; ?></td>
    <td><?php echo $user['is_admin'] ? 'Yes' : 'No' ?></td>
    <td><?php echo $user['role']; ?></td>
    <td><?php echo $user['is_active'] ? 'Yes' : 'No'; ?></td>
    <td><?php echo $user['last_login']; ?></td>
    <td>
        <a href="//<?= APP_BASE_PATH ?>/user/edit/<?php echo $user['id']; ?>" >Edit</a>
        <a href="//<?= APP_BASE_PATH ?>/user/delete/<?php echo $user['id']; ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

<?php
$content = ob_get_clean();

include 'app/view/layout.php';

?>