<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>   
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="logo">
                <img src="images/logo.png">
                <p>LIBRARY MANAGEMENT SYSTEM</p>
            </div>

            <?php
                if(isset($_SESSION['login_user']))
                {
                    ?>
                    <nav>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="books.php">BOOKS</a></li>
                            <li><a href="feedback.php">FEEDBACK</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
                            <li style="color: white;">
                                <a href="profile.php">
                                    <i style="font-size: 18px">
                                        <?php
                                            echo "<img class='img-circle profile_img' height=35 width=35 src='images/".$_SESSION['pic']."'>";
                                            echo $_SESSION['login_user'];
                                        ?>
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                }
                else
                {
                   ?>
                   <nav>
                        <ul>
                            <li><a href="index.php">HOME</a></li>
                            <li><a href="books.php">BOOKS</a></li>
                            <li><a href="feedback.php">FEEDBACK</a></li>
                            <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span>SIGNUP</a></li>
                            <li><a href="user.php"><span class="glyphicon glyphicon-log-in"></span>LOGIN</a></li>
                        </ul>
                    </nav>
                    <?php 
                }   
            ?>
        </header>
        <section>  
            <div class="mainbg">
                <br><br><br>   
                <div class="box">
                    <br><br><br> <br>
                    <h1 style="text-align: center; font-size: 43px; color: black; font-weight: bold;">Welcome to Library!</h1><br><br>
                    <h1 style="text-align: center; font-size: 25px; color: black;">~ Opens At 09:00 AM ~</h1>
                    <h1 style="text-align: center; font-size: 25px; color: black;">~ Closes At 06:00 PM ~</h1>
                </div>
            </div>
        </section>
        <footer>   
            <p style="color: white; text-align: center; font-size: large;">
                <br>Contact Us : libraryadmin@email.com <br>
            </p>
        </footer>
    </div>
</body>
</html>