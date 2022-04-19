<?php
    include('classes.php');

    $loginObj = new App\LoginClass;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginObj->loginUser($username, $password);

?>
              
      
