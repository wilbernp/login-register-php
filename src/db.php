<?php require_once('tables/index.php') ?>

<?php

$MYSQL_HOST = 'mysql';
$MYSQL_DATABASE = 'login_register';
$MYSQL_USER = 'root';
$MYSQL_ROOT_PASSWORD = 'password';

try {
    $conn = new PDO("mysql:host=$MYSQL_HOST;dbname=$MYSQL_DATABASE", $MYSQL_USER, $MYSQL_ROOT_PASSWORD);
    createTablesIfNotExists($conn);

} catch (PDOException $error) {
    echo $error->getMessage();
}

?>