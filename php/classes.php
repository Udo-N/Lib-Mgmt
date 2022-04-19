<?php
    namespace App;
    use \PDO;

    class LoginClass{
        public $loginSuccess = false;

        public function loginUser($uname, $pwd){
            $dsn = 'mysql:host=localhost; dbname=library-database';
            $username = 'pma';
            $password = 'Passw0rd69.';

            $db = new PDO($dsn, $username, $password);

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
                    $this->loginSuccess = true;
                    header("Location: index.php"); 
                    exit();
                }
                else{
                    $this->loginSuccess = false;
                    header("Location: ../html/invalid-password-login.html");
                } 
            }
            else{
                $this->loginSuccess = true;
                header("Location: ../html/invalid-user-login.html");
            }
        }
    }

    class SignUpClass{
        public $signupSuccess = false;

        public function signupUser($uname, $pwd, $pwd2){
            $dsn = 'mysql:host=localhost; dbname=library-database';
            $username = 'pma';
            $password = 'Passw0rd69.';

            $db = new PDO($dsn, $username, $password);            
            $admin = 0;

            $query1 = "SELECT uname FROM `library-database`.`users` WHERE uname = '$uname'";
            $statement1 = $db->prepare($query1);
            $statement1->execute();
            $record_username = $statement1->fetch();
            $statement1->closeCursor();

            if (!$record_username){
                if($pwd == $pwd2){
                    $query2 = "INSERT INTO `library-database`.`users` 
                                VALUES ('$uname', '$pwd', $admin)";
                    $statement2 = $db->prepare($query2);
                    $statement2->execute();

                    session_start();
                    $_SESSION['Username'] = $uname;
                    header("Location: index.php"); 
                    exit();
                }
                else{
                    header("Location: ../html/pass-mismatch-signup.html");
                }
            }
            else{
                header("Location: ../html/user-taken-signup.html");
            } 
        }
    }

    class SearchClass{
        public $searchSuccess = false;

        public function searchBook($searchText){
            $dsn = 'mysql:host=localhost; dbname=library-database';
            $username = 'pma';
            $password = 'Passw0rd69.';

            $db = new PDO($dsn, $username, $password);
            
            // $search = $_POST['searchVal'];
            $book_ids = [];
            $books = [];

            if($searchText){
                $query = "SELECT * FROM `library-database`.`books` WHERE LOWER(`title`) LIKE LOWER('%$searchText%')";
                $statement = $db->prepare($query);
                $statement->execute();
                $book_ids = $statement->fetchAll();
                $statement->closeCursor();
            }

            if(!$book_ids){
                echo("No results");
            }
            else{
                // print($book_ids[0]); //PlaceHolder to print search ID values
            } 
            
            session_start();
            $_SESSION['Book_IDs'] = $book_ids;
            header("Location: index.php");
        }

    }
?>
