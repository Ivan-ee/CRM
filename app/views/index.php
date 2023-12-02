<?php

$title = 'Home Page';

ob_start();

?>

    <h1>Home Page</h1>

<?php
$content = ob_get_clean();

include 'app/views/layout.php';

?>