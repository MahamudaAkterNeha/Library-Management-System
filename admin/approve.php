<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Approve Request</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>  

    <style>
        body {
        font-family: "Lato", sans-serif;
        transition: background-color .5s;
        }

        .sidenav {
        height: 100%;
        margin-top: 103px;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: purple;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        }

        .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
        }

        .sidenav a:hover {
        color: #f1f1f1;
        }

        .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
        }

        #main {
        transition: margin-left .5s;
        padding: 16px;
        }

        @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
        }
    </style>
</head>

<body>

    <div class="wrapper" style="overflow: auto;">
        <?php
            include "navbar.php";
        ?>
        <!--SIDENAV-->  
        <div id="mySidenav" class="sidenav" style="margin-top: 100px">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div style="color: white; text-align: center">
                <i style="font-size: 18px">
                    <?php
                        if(isset($_SESSION['login_user']))
                        {
                            echo "<img class='img-circle profile_img' height=100 width=100 src='images/".$_SESSION['pic']."'><br>";
                            echo $_SESSION['login_user'];
                            echo "<br><br>";
                        }
                    ?>
                </i>
            </div>   
            <div><a href="books.php">Books</a></div>
            <div><a href="add.php">Add Books</a></div>
            <div><a href="request.php">Book Requests</a></div>
            <div><a href="issueinfo.php">Issue Information</a></div>  
            <div><a href="expired.php">Expired List</a></div>  
        </div>

        <div id="main" style="">
            <span style="font-size:30px;cursor:pointer; margin-left: -570px;" onclick="openNav()">&#9776; Manage Books</span>
            <script>
                function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "300px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
                }

                function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
                }
            </script>

            <section>
                <div class="container-lg mt-3 border" style="margin-top: -8px; background-image: url(images/request.jpg);">  
                    <br>
                    <div class="container"style="height: 100%; background-color: purple; opacity: .9; color: white; text-align: center">
                        <br><br>    
                        <h2 style="font-size: 30px; margin-top: -3px"><b>Approve Request</b></h2><br>

                        <form class="navbar-form" method="post" name="form" action="">
                            <input class="form-control" type="text" name="approve" placeholder="Approve Or Not" required="" style="width: 300px;background-color: rgb(245, 225, 245);"><br><br>
                            <input class="form-control" type="text" name="issuedate" placeholder="Issue Date yyyy-mm-dd" required="" style="width: 300px;background-color: rgb(245, 225, 245);"><br><br>
                            <input class="form-control" type="text" name="returndate" placeholder="Return Date yyyy-mm-dd" required="" style="width: 300px;background-color: rgb(245, 225, 245);"><br><br>
                            <button class="btn btn-default" type="submit" name="submit" 
                            style="background-color: rgb(164, 89, 164);"><b>Approve</b></button><br><br><br>
                        </form>

                        <?php
                            if(isset($_POST['submit']))
                            {
                                mysqli_query($db, "UPDATE `issuebook` SET
                                approve='$_POST[approve]', issuedate='$_POST[issuedate]',returndate='$_POST[returndate]'
                                WHERE username='$_SESSION[name]' && bid= '$_SESSION[bid]';");

                                mysqli_query($db, "UPDATE `books` SET
                                quantity = quantity-1 WHERE bid= '$_SESSION[bid]';");

                                $res = mysqli_query($db, "SELECT quantity FROM `books` WHERE bid= '$_SESSION[bid]';");

                                while($row = mysqli_fetch_assoc($res))
                                {
                                    if($row['quantity']==0)
                                    {
                                        mysqli_query($db, "UPDATE `books` SET status='Not Available'
                                        WHERE bid='$_SESSION[bid]';");
                                    }
                                }
                                ?>
                                <script type="text/javascript">
                                    alert("Updated Successfully!");
                                    window.location="request.php";
                                </script>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>
</html>