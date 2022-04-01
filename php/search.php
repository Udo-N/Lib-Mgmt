<?php
    $dsn = 'mysql:host=localhost; dbname=library-database';
    $username = 'pma';
    $password = 'Passw0rd69.';

    $db = new PDO($dsn, $username, $password);
    
    $search = $_POST['searchVal'];
    $book_ids = [];
    $books = [];

    if($search){
        $query = "SELECT id FROM `library-database`.`books` WHERE LOWER(`title`) LIKE LOWER('%$search%')";
        $statement = $db->prepare($query);
        $statement->execute();
        $book_ids = $statement->fetchAll();
        $statement->closeCursor();
    }

    if(!$book_ids){
        echo("No results");
    }
    else{
        echo '<pre>'; print_r($book_ids); echo '</pre>'; //PlaceHolder to print search ID values
    }    
?>