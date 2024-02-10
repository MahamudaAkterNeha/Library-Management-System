<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Books</title>
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
      <div class="wrapper">
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

        <div id="main" style="background-image: url(images/books.jpg);">
            <span style="font-size:30px; cursor:pointer; margin-left: -570px;color:black;background-color:rgb(164, 89, 164);"
            onclick="openNav()">&#9776; Manage Books</span>
            <section>
            <div class="container-lg mt-3 border" style="margin-top: -20px; margin-left: 530px;">  
            <br>    
            <h1 style="color: black; background-color:rgb(164, 89, 164); width: 450px">Add New Books:</h1>          
                <form class="navbar-form" action="" method="post">
                    <input class="form-control" type="text" name="bid" placeholder="Book ID" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="name" placeholder="Book Name" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="authors" placeholder="Author Name" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="edition" placeholder="Edition" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="status" placeholder="Status" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="quantity" placeholder="Quantity" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="department" placeholder="Department" required="" style="width: 450px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <button class="btn btn-default" type="submit" name="submit"
                        style="background-color: rgb(164, 89, 164); margin-left: 150px; width: 130px; font-weight:bold; font-size: 18px">
                        Add Book</button><br><br>
                </form>

                <?php
                    if(isset($_POST['submit']))
                    {
                        if(isset($_SESSION['login_user']))
                        {
                            $q=mysqli_query($db,"INSERT INTO books (bid, name, authors, edition, status, quantity, department)
                            VALUES('$_POST[bid]', '$_POST[name]', '$_POST[authors]','$_POST[edition]',
                            '$_POST[status]', '$_POST[quantity]', '$_POST[department]');");
                            ?>
                            <div class="alert alert-success alert-dismissible"
                                style=" height: 50px; width: 450px; font-size: 15px; margin-left: 500px; margin-top: -45px">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Book Added Successfully!</strong>
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="alert alert-danger alert-dismissible"
                                style=" height: 50px; width: 450px; font-size: 15px; margin-left: 500px; margin-top: -45px">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>You need to login first!</strong>
                            </div> 
                            <?php
                        }
                        
                    }
                ?>
            </div>
            </section>
        </div>
        
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
    </div>
</body>
</html>