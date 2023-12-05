<!DOCTYPE>
<html lang="ru">
<head>
    <title><?= $title ?></title>
</head>
<body>
<div>
    <nav>
        <a href="index.php">CRM</a>
        <div>
            <ul>
                <li>
                    <a href="index.php?page=users">Users</a>
                </li>
                <li>
                    <a href="index.php?page=roles">All Roles</a>
                </li>
                <li>
                    <a href="index.php?page=roles&action=create">Create Role</a>
                </li>
                <li>
                    <a href="index.php?page=register">Register</a>
                </li>
                <li>
                    <a href="index.php?page=login">Login</a>
                </li>
                <li>
                    <a href="index.php?page=logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div>
        <?php echo $content; ?>
    </div>

</div>
</body>
</html>