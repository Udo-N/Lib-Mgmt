<?php
    $dsn = 'mysql:host=localhost; dbname=library-database';
    $username = 'pma';
    $password = 'Passw0rd69.';
    $db = new PDO($dsn, $username, $password);

    $book_id = $_POST['book_ID'];
    $user = $_POST['username'];

    $query = "UPDATE `library-database`.`books` SET `availability` = '0' WHERE (`id` = $book_id)";
    $statement = $db->prepare($query);
    $statement->execute();
    
    $query = "INSERT INTO `library-database`.`requests` 
                VALUES ('$user', '$book_id', 'booking', 'approved')";
    $statement = $db->prepare($query);
    $statement->execute();
?>