<?php
    namespace App;
    use \PDO;

    class LoginTestClass{
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
                    $_SESSION['Username'] = $uname;
                    $this->loginSuccess = true;
                    
                }
                else{
                    $this->loginSuccess = false;
                } 
            }
            else{
                $this->loginSuccess = false;
                
            }
        }
    }


    class SignUpTestClass{
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

                    $this->signupSuccess = true;
                }
                else{
                    $this->signupSuccess = false;
                }
            }
            else{
                $this->signupSuccess = false;
            } 
        }
    }


    class SearchTestClass{
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
                $this->searchSuccess = false;
            }
            else{
                $this->searchSuccess = true;
                // print($book_ids[0]); //PlaceHolder to print search ID values
            }
        }
    }

?>
