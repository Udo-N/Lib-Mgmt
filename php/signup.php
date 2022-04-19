<?php
    include('classes.php');

    $signupObj = new App\SignUpClass;

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $signupObj->signupUser($username, $password, $password2);

?>