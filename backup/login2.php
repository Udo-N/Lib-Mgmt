<?php
    namespace App;
    use \PDO;

    class LoginClass{
        public function loginUser($uname, $pwd){
            $dsn = 'mysql:host=localhost; dbname=library-database';
            $username = 'pma';
            $password = 'Passw0rd69.';

            $db = new PDO($dsn, $username, $password);
    
            // $username = $_POST['username'];
            // $password = $_POST['password'];

            $query1 = "SELECT uname FROM `library-database`.`users` WHERE uname = '$uname'";
            $statement1 = $db->prepare($query1);
            $statement1->execute();
            $record_username = $statement1->fetch();
            $statement1->closeCursor();

            if ($record_username){
                $query2 = "SELECT pwd FROM `library-database`.`users` WHERE uname = '$uname'";
                $statement2 = $db->prepare($query2);
                $statement2->execute();
                $record_password = $statement2->fetch();
                $statement2->closeCursor();

                if ($pwd == $record_password['pwd']){
                    session_start();
                    $_SESSION['Username'] = $uname;
                    header("Location: ../php/index.php"); 
                    exit();
                }
                else{
                    header("Location: ../html/invalid-password-login.html");
                } 
            }
            else{
                header("Location: ../html/invalid-user-login.html");
            }
        }
    }

    $loginObj = new LoginClass;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginObj->loginUser($username, $password);
              
      
