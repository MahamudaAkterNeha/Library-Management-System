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
            <div><a href="add.php">Add Books</a></div>
            <div><a href="request.php">Book Requests</a></div>
            <div><a href="issueinfo.php">Issue Information</a></div>  
            <div><a href="expired.php">Expired List</a></div>  
            <div><a href="fine.php">Fines</a></div>
        </div>

        <div id="main" style="margin-top: 15px">
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
                <div class="container-lg mt-3 border" style="margin-top: -8px;">  

                    
                    <!--SEARCH BAR-->    
                    <div class="search" style="padding-left: 1020px;">
                        <form class="navbar-form" method="post" name="form1" action="">

                            <h4 style="color: black; background-color: rgb(164, 89, 164);margin-top: -3px; width:425px">
                            <b>Search one username at a time to approve the request.</b></h4>

                            <input class="form-control" type="text" name="search" placeholder="Search Username" required="" style="width: 380px;">
                            <button style="background-color: rgb(164, 89, 164);" type="submit" name="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </form>
                    </div>
                    <br>
                    <h2 style="margin-right:1080px; font-size: 35px; color: black; margin-top: -3px">New Admin Requests:</h2><br>
                    <?php

                        if(isset($_POST['submit']))
                        {
                            $q=mysqli_query($db,"SELECT id, firstname, lastname, username, email, phonenumber
                                                FROM `admin` WHERE username like '%$_POST[search]%' and status='' ");
                            if(mysqli_num_rows($q)==0)
                            {
                                echo "<h3><b>Sorry! No request found with that username.</b></h3>";
                            }
                            else
                            {
                                echo "<table class='table table-bordered table-hover' style='font-size:18px;'>";
                                    echo "<tr style='background-color: rgb(164, 89, 164);'>";
                                        //table header
                                        echo "<th>"; echo "ID"; echo "</th>";
                                        echo "<th>"; echo "First Name"; echo "</th>";
                                        echo "<th>"; echo "Last Name"; echo "</th>";
                                        echo "<th>"; echo "Username"; echo "</th>";
                                        echo "<th>"; echo "Email"; echo "</th>";
                                        echo "<th>"; echo "Phone Number"; echo "</th>";
                                    echo "</tr>";
                                    while($row=mysqli_fetch_assoc($q))
                                    {
                                        $_SESSION['test_name'] = $row['username'];
                                        echo "<tr>";
                                            echo "<td>"; echo $row['id']; echo "</td>";
                                            echo "<td>"; echo $row['firstname']; echo "</td>";
                                            echo "<td>"; echo $row['lastname']; echo "</td>";
                                            echo "<td>"; echo $row['username']; echo "</td>";
                                            echo "<td>"; echo $row['email']; echo "</td>";
                                            echo "<td>"; echo $row['phonenumber']; echo "</td>";
                                        echo "</tr>";
                                    }
                                echo "</table>";
                                ?>
                                <form class="navbar-form" method="post" action="">
                                    <button type="submit" name="submit1" class="btn btn-default" style="background-color: #eeddef; margin-left:645px">
                                    <span class="glyphicon glyphicon-remove-sign" style="color:red"></span><b>&nbsp Remove</b></button> 

                                    <button type="submit" name="submit2" class="btn btn-default" style="background-color: #eeddef">
                                    <span class="glyphicon glyphicon-ok-sign" style="color:green"></span><b>&nbsp Approve</b></button>
                                </form>  
                                <?php
                            }
                        }
                        /*IF BUTTON IS NOT PRESSED*/
                        else
                        {
                            $res=mysqli_query($db,"SELECT id, firstname, lastname, username, email, phonenumber
                                                    FROM `admin` WHERE status = '' ORDER BY `id` ASC;");
                            echo "<table class='table table-bordered table-hover' style='font-size:18px;'>";
                                echo "<tr style='background-color: rgb(164, 89, 164);'>";
                                    //table header
                                    echo "<th>"; echo "ID"; echo "</th>";
                                    echo "<th>"; echo "First Name"; echo "</th>";
                                    echo "<th>"; echo "Last Name"; echo "</th>";
                                    echo "<th>"; echo "Username"; echo "</th>";
                                    echo "<th>"; echo "Email"; echo "</th>";
                                    echo "<th>"; echo "Phone Number"; echo "</th>";
                                echo "</tr>";
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    echo "<tr>";
                                        echo "<td>"; echo $row['id']; echo "</td>";
                                        echo "<td>"; echo $row['firstname']; echo "</td>";
                                        echo "<td>"; echo $row['lastname']; echo "</td>";
                                        echo "<td>"; echo $row['username']; echo "</td>";
                                        echo "<td>"; echo $row['email']; echo "</td>";
                                        echo "<td>"; echo $row['phonenumber']; echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        }
                        if(isset($_POST['submit1']))
                        {
                            mysqli_query($db,"DELETE FROM `admin` WHERE username='$_SESSION[test_name]' and `status`='';");
                            unset($_SESSION['test_name']);
                        }
                        if(isset($_POST['submit2']))
                        {
                            mysqli_query($db,"UPDATE `admin` SET `status`='Yes' WHERE username='$_SESSION[test_name]';");
                            unset($_SESSION['test_name']);
                        }
                    ?>
                </div>
            </section>
        </div>   
    </div>

</body>
</html>