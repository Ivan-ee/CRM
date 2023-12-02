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
            </ul>
        </div>
    </nav>
    <div>
        <?php echo $content; ?>
    </div>

</div>
</body>
</html>