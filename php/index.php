<?php
    $dsn = 'mysql:host=localhost; dbname=library-database';
    $username = 'pma';
    $password = 'Passw0rd69.';

    $db = new PDO($dsn, $username, $password);

    session_start();
    
    $ids = @$_SESSION['Book_IDs'];     
    $user = @$_SESSION['Username']; 
    $idArray = [];
    $titles = [];
    $thumbnails = [];
    $availability = [];

    if($ids){
        for ($i = 0; $i < count($ids); $i++){
            $current_id = $ids[$i]['id'];
            $current_title = $ids[$i]['title'];
            $current_thumbnail = $ids[$i]['image'];
            // $current_availability = $ids[$i]['availability'];

            $current_availability = '';
            $query = "SELECT availability FROM `library-database`.`books` WHERE id = $current_id";
            $statement = $db->prepare($query);
            $statement->execute();
            $current_availability = $statement->fetch();
            $statement->closeCursor();

            array_push($idArray, $current_id);
            array_push($titles, $current_title);
            array_push($thumbnails, $current_thumbnail);
            array_push($availability, $current_availability);
        }
    }
  
?>

<!DOCTYPE html>

<html lang="en" style="background-color: #121212; color:#383dc9;">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>UD Library</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/index-style.css">        
    </head>

    <body style="background-color:#121212;">
        <header>
            <nav id="top-nav" class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <div class="navbar-brand">
                            <a href="index.php">
                                <img class= "img1" src="../images/Logo.png"/>
                            </a>
                        </div>

                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#item-list" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    
                    <div id="right-header">
                        <a class="login" href="../html/login.html">Log in</a>
                        <a class="signup" href="../html/signup.html">Sign up</a>
                    </div>

                    <div id="item-list" class="collapse navbar-collapse">
                        <ul id="nav-list" class="nav navbar-nav navbar-right visible-xs navbar-static-top">
                            <li id="phone-login"><a href="../html/login.html">Log in</a></li>
          				    <li id="phone-signup"><a href="../html/signup.html">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div id = "main-body" class = "container-fluid"> 
            <div id="search-bar">
                <form action="search.php" method="post">
                    <input id="search-input" type="text" placeholder="Search..." name="searchVal">
                    <input type="submit" value="Search Book">
                </form>
            </div>

            <!-- <div class="book">
                <img class="book-thumbnail" src="images/book1.jpg">
                <div class="book-details">
                    <p class="book-title">The Facility</p>
                    <p class="availability">Available</p>
                    <div class="buttons">
                        <button class="booking">Book</button>
                        <button class="reserve">Reserve</button>
                    </div>
                </div>  
            </div> -->
        </div>

        <script src="../js/jquery-2.1.4.min.js"></script>
  	    <script src="../js/bootstrap.min.js"></script>
    </body>
</html>

<script>
    // Pad digits so that 1 becomes 0001
    function pad(n) {
        var s = "000" + n;
        return s.substr(s.length-4);
    }

    var currentUser = <?php echo json_encode($user); ?>;
    var bookIDs = <?php echo json_encode($idArray); ?>;
    var titles = <?php echo json_encode($titles); ?>;
    var images = <?php echo json_encode($thumbnails); ?>;
    var availability = <?php echo json_encode($availability); ?>;
    var availCount = 0;
    var status = "Unknkown"

    if(currentUser != null){
        document.getElementById("right-header").innerHTML = "<div id='current-user'>Logged in as " + currentUser + "</div>";
        document.getElementById("right-header").innerHTML += "<button id= 'signout'>Sign Out</button>";

        document.getElementById("nav-list").innerHTML = "<li>Logged in as " + currentUser + "</li>";
        document.getElementById("nav-list").innerHTML += "<li id='phone-signout'><button>Sign Out</button></li>";
    }

    console.log("Loop starts")
    for(var i = 0; i < titles.length; i++){
        if (availability[i]['availability'] == 1){
            status = "Available"
        }
        else if (availability[i]['availability'] == 0){
            status = "Unavailable"
        }

        string = '<div id="book' + i + '" class="book">'
        string += '<img class="book-thumbnail" src="' + images[i] + '">'
        string += '<div class="book-details">'
        string += '<p class="book-title">' + titles[i] + '</p>'
        string += '<p class="idDisplay">' + pad(bookIDs[i]) + '</p>'
        string += '<p class="availability">' + status + '</p>'

        if (availability[i]['availability'] == 1){
            string += '<div class="buttons">'
            string += '<button id="booking' + i + '" class="booking">Book</button>'
            string += '<button  id="reserve' + i + '"  class="reserve">Reserve</button>'
            string += '</div>'
            availCount++

        }
        
        string += '</div>'
        string += '</div>'

        document.getElementById("main-body").innerHTML += string;        
    }

    var bookButtons = document.querySelectorAll(".booking");
    var reserveButtons = document.querySelectorAll(".reserve");

    document.addEventListener("DOMContentLoaded", () => {
        const signOut = document.getElementById("signout");
        const phoneSignOut = document.getElementById("phone-signout");

        if(currentUser != null){
            signOut.addEventListener("click", () =>{
                location.href = "end-session.php"
            });

            phoneSignOut.addEventListener("click", () =>{
                location.href = "end-session.php"
            });
        }
    });


    for (let bookButton of bookButtons) {
        bookButton.addEventListener("click", () => { 
            if(currentUser){
                $.ajax({
                method: "POST",
                url: "book.php",
                data: { 
                    book_ID: parseInt(bookButton.parentNode.previousSibling.previousSibling.innerHTML, 10), username: currentUser}
                }).success(function( msg ) {
                    console.log(msg);
                });
                console.log(bookButton.parentNode)
                bookButton.parentNode.style.display = "none"
                bookButton.parentNode.previousSibling.innerHTML = "Booking Successful"
            }
            else{
                location.href = ("../html/login.html")
            }           
            
            
        });
    }

    for (let reserveButton of reserveButtons) {
        reserveButton.addEventListener("click", () => { 
            if(currentUser){
                $.ajax({
                method: "POST",
                url: "reserve.php",
                data: { 
                    book_ID: parseInt(reserveButton.parentNode.previousSibling.previousSibling.innerHTML, 10),
                    username: currentUser}
                }).success(function( msg ) {
                    console.log(msg);
                });
                console.log(reserveButton.parentNode)
                reserveButton.parentNode.style.display = "none"
                reserveButton.parentNode.previousSibling.innerHTML = "Reservation Successful"
            }
            else{
                location.href = ("../html/login.html")
            }           
            
            
        });
    }
</script>