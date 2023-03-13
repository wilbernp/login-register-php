<?php require_once('users.php') ?>

<?php
function createTablesIfNotExists(PDO $conn)
{
    createTableUsers($conn);
}


?>