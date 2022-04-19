<?php
    include('classes.php');

    $searchObj = new App\SearchClass;

    $search = $_POST['searchVal'];
    $searchObj->searchBook($search);
?>