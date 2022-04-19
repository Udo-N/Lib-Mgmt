<?php
    $dsn = 'mysql:host=localhost; dbname=library-database';
    $username = 'pma';
    $password = 'Passw0rd69.';
    $db = new PDO($dsn, $username, $password);

    $query = "UPDATE `library-database`.`books` SET `availability` = '1'";
    $statement = $db->prepare($query);
    $statement->execute();

    session_start();
    session_destroy();
    header("Location: index.php"); 
?>