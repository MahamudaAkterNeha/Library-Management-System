<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>  
</head>

<body style="background-image: url('images/bg.jpg');">
    <div class="wrapper">
        <?php
            include "navbar.php";
        ?>
        <section>
            <div class="container-lg mt-3 border" style="margin-top: -8px">  
                <form action="" method="post">
                    <button class="btn btn-default" name="submit1"
                    style="margin-left: 590px; background-color: rgb(164, 89, 164); width: 90px; font-weight: bold;">Edit Profile</button>
                </form>
                <div class="wrap" style="width: 430px; margin: 0 auto; background-color: rgb(245, 225, 245);">

                    <?php
                        if(isset($_POST['submit1']))
                        {
                            ?>
                            <script type="text/javascript">
                                window.location= "edit.php";
                            </script>    
                            <?php
                        }
                        $q=mysqli_query($db,"SELECT * FROM `users` WHERE username='$_SESSION[login_user]';");
                    ?>

                    <h2 style="text-align: center; font-size: 28px; font-weight: bold; 
                    font-color: black; background-color: rgb(164, 89, 164);">My Profile</h2>

                    <?php
                        $row=mysqli_fetch_assoc($q);
                        echo "<div style='text-align: center'>
                                <img class='img-circle profile_img' height=90 width=90 src='images/".$_SESSION['pic']."'>
                              </div>";
                    ?>
                    <div style="text-align: center; font-size: 15px;"><b>Welcome</b></div>
                    <div style="text-align: center; font-size: 17px;">
                        <i><b>
                            <?php
                                echo $_SESSION['login_user'];
                            ?>
                        </b></i>
                    </div>
                    <?php
                        echo "<b>";
                        echo "<table class='table table-bordered' style='border: 1px solid black; border-collapse: collapse;'>";
                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>ID:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['id']; echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Fisrt Name:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['firstname']; echo "</td>";
                            echo "</tr>";  

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Last Name:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['lastname']; echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Username:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['username']; echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Email:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['email']; echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Password:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['password']; echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo "<b>Phone Number:</b>"; echo "</td>";
                                echo "<td style='border: 1px solid black; border-collapse: collapse;'>"; echo $row['phonenumber']; echo "</td>";
                            echo "</tr>";
                        echo "</table>";
                        echo "</b>";
                    ?>
                </div>   
            </div>
        </section>
    </div>

</body>
</html>