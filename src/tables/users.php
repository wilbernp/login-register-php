<?php
function createTableUsers(PDO $conn)
{
  $query = "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `username` varchar(255) NOT NULL,
        `email` varchar(255) UNIQUE NOT NULL,
        `password` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

  $conn->query($query);
}
?>