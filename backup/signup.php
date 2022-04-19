<?php
    $dsn = 'mysql:host=localhost; dbname=library-database';
    $username = 'pma';
    $password = 'Passw0rd69.';

    $db = new PDO($dsn, $username, $password);
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $admin = 0;

    $query1 = "SELECT uname FROM `library-database`.`users` WHERE uname = '$username'";
    $statement1 = $db->prepare($query1);
    $statement1->execute();
    $record_username = $statement1->fetch();
    $statement1->closeCursor();

    if (!$record_username){
        if($password == $password2){
            $query2 = "INSERT INTO `library-database`.`users` 
                        VALUES ('$username', '$password', $admin)";
            $statement2 = $db->prepare($query2);
            $statement2->execute();

            session_start();
            $_SESSION['Username'] = $username;
            header("Location: ../index.php"); 
            exit();
        }
        else{
            header("Location: ../html/pass-mismatch-signup.html");
        }
    }
    else{
        header("Location: ../html/user-taken-signup.html");
    }      
?>
