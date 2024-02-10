<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expired List</title>
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
            <div><a href="request.php">Book Requests</a></div>
            <div><a href="expired.php">Delay Fine</a></div>
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
                <div class="container-lg mt-3 border" style="margin-top: -8px; background-image: url(images/issue.jpg);">  
                <br>       
                    <?php
                        if(isset($_SESSION['login_user']))
                        {
                            ?>
                            <!--BUTTONS-->
                            <form class="navbar-form" method="post" action=""> 
                                <button class="btn btn-default" type="submit" name="submit2" style="color:black;background-color:green;
                                    margin-left:151px;width:100px"><b>Returned</b></button>
                                <button class="btn btn-default" type="submit" name="submit3" style="color:black;background-color:red;
                                    margin-left:20px;width:100px"><b>Expired</b></button><br>
                            </form>

                            <!--FOR DELAY DAYS AFTER EXPIRED DATE-->
                            <?php
                                if(isset($_SESSION['login_user']))
                                {
                                    $day = 0;
                                    $expired = '<p style="color:red;"><i>Expired</i></p>';
                                    $x = mysqli_query($db, "SELECT returndate FROM issuebook
                                    WHERE username = '$_SESSION[login_user]' and approve = '$expired';");

                                    while($row=mysqli_fetch_assoc($x))
                                    {
                                        $d = strtotime($row['returndate']); //to change the date from returndate to seconds
                                        $c = strtotime(date("Y-m-d"));
                                        $diff = $c - $d;
                                        if($diff>=0)
                                        {
                                            $day = $day + floor($diff/(60*60*24));  //days    
                                        }
                                    }
                                    $fine = $day*100;
                                }
                            ?>
                            <h2 style="margin-left:930px; margin-top:-38px; color:black; background-color:rgb(164, 89, 164); opacity:.9; width: 400px"><b>
                                <?php
                                    echo "Delay: ".$day."Days;&nbsp Fine: ".$fine."TK!" ;
                                ?>
                            </b></h2>
                            <?php
                        }
                    ?>
                    <br>
                    <div class="container"style="height: 100%; background-color: purple; opacity: .9; color: black; ">
                        <br>                       
                        <?php
                            $c = 0;
                            if(isset($_SESSION['login_user']))
                            {
                                $return = '<p style="color:green;"><i>Returned</i></p>';
                                $expired = '<p style="color:red;"><i>Expired</i></p>';

                                //IF RETURNED BUTTON IS PRESSED
                                if(isset($_POST['submit2']))
                                {
                                    $sql= "SELECT users.username, id, books.bid, name, authors, edition, approve, issuedate, returndate 
                                    FROM `users` INNER JOIN `issuebook` ON users.username = issuebook.username
                                    INNER JOIN books ON issuebook.bid = books.bid WHERE issuebook.approve = '$return'
                                    ORDER BY `issuebook`.`returndate` DESC";
                                    $res=mysqli_query($db, $sql);
                                    
                                }
                                //IF EXPIRED BUTTON IS PRESSED
                                else if(isset($_POST['submit3']))
                                {
                                    $sql= "SELECT users.username, id, books.bid, name, authors, edition, approve, issuedate, returndate 
                                    FROM `users` INNER JOIN `issuebook` ON users.username = issuebook.username
                                    INNER JOIN books ON issuebook.bid = books.bid WHERE issuebook.approve = '$expired'
                                    ORDER BY `issuebook`.`returndate` DESC";
                                    $res=mysqli_query($db, $sql);
                                }
                                //IF ANY OF THE BUTTONS ARE NOT PRESSED
                                else
                                {      
                                    $sql= "SELECT users.username, id, books.bid, name, authors, edition, approve, issuedate, returndate 
                                    FROM `users` INNER JOIN `issuebook` ON users.username = issuebook.username
                                    INNER JOIN books ON issuebook.bid = books.bid WHERE issuebook.approve != '' and issuebook.approve != 'Yes'
                                    ORDER BY `issuebook`.`returndate` DESC";
                                    $res=mysqli_query($db, $sql);
                                }

                                echo "<table class='table table-bordered table-hover' style='font-size:18px;'>";
                                    echo "<tr style='background-color: rgb(164, 89, 164); color: black'>";
                                        //table header   
                                        echo "<th>"; echo "Username"; echo "</th>";
                                        echo "<th>"; echo "ID"; echo "</th>";
                                        echo "<th>"; echo "Book ID"; echo "</th>";
                                        echo "<th>"; echo "Book Name"; echo "</th>";
                                        echo "<th>"; echo "Authors"; echo "</th>";
                                        echo "<th>"; echo "Edition"; echo "</th>";
                                        echo "<th>"; echo "Status"; echo "</th>";
                                        echo "<th>"; echo "Issue Date"; echo "</th>";
                                        echo "<th>"; echo "Return Date"; echo "</th>";
                                    echo "</tr>";
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        echo "<tr style='background-color: rgb(245, 225, 245); color: black'>";
                                            echo "<td>"; echo $row['username']; echo "</td>";
                                            echo "<td>"; echo $row['id']; echo "</td>";
                                            echo "<td>"; echo $row['bid']; echo "</td>";
                                            echo "<td>"; echo $row['name']; echo "</td>";
                                            echo "<td>"; echo $row['authors']; echo "</td>";
                                            echo "<td>"; echo $row['edition']; echo "</td>";
                                            echo "<td>"; echo $row['approve']; echo "</td>";
                                            echo "<td>"; echo $row['issuedate']; echo "</td>";
                                            echo "<td>"; echo $row['returndate']; echo "</td>";
                                        echo "</tr>";
                                    }
                                echo "</table>";
                                
                            }
                            else
                            {
                                echo "<h3><b>You need to login to see the issued infromations.</b></h3>";
                            }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

</body>
</html>