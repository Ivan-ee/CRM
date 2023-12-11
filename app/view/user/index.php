<?php

$title = 'User list';

ob_start();

?>

<h1>User list</h1>
<a class="btn btn-create" href="//<?= APP_BASE_PATH ?>/user/create">Create User</a>
<table class="table">

<thead>
<tr>
    <th>#</th>
    <th>Username</th>
    <th>Email</th>
    <th>Email verification</th>
    <th>Is admin</th>
    <th>Role</th>
    <th>Is active</th>
    <th>Last login</th>
    <th>Action</th>
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
    <td class="">
        <a class="btn btn-edit" href="//<?= APP_BASE_PATH ?>/user/edit/<?php echo $user['id']; ?>" >Edit</a>
        <a class="btn btn-delete" href="//<?= APP_BASE_PATH ?>/user/delete/<?php echo $user['id']; ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

<?php
$content = ob_get_clean();

include 'app/view/layout.php';

?>