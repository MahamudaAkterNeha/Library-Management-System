<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
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
        <?php
            include "navbar.php";
        ?>
        <section>
             <div class="registration">
                <br><br><br><br><br>
                <div class="box" style="height:400px">
                    <br><br>
                    <h1 style="text-align: center; font-size: 40px; color: black;">Registration</h1>
                    <h1 style="text-align: center; font-size: 35px; color: black;">Sign Up As:</h1><br><br>
                    <form name="registration" action="" method="post">
                        <div class="signup">
                        <input type="radio" name="users" id="admin" value="admin" style="margin-left:110px; width:20px;">
                        <label for="admin" style="font-size:18px; color: black;">Admin</label><br>
                        <input type="radio" name="users" id="user" value="user" checked="" style="margin-left:110px; width:20px">
                        <label for="user" style="font-size:18px; color: black;">User</label><br><br><br>

                        <input class="btn btn-default" type="submit" name="submit1" value="Proceed"
                        style="background-color: purple; color: white;  width: 100px; height: 40px; text-align: center;  
                        display: inline-block; font-size: 18px; border-radius: 3px; margin-left: 105px; border: 2px;">
                        </div>
                        </div>
                    </form> 
                </div>
             </div>
        </section>   
        <?php
        if(isset($_POST['submit1']))
        {
            if($_POST['users']=='admin')
            {
                ?>        
                <script type="text/javascript">
                    window.location = "admin/registration.php";
                </script>  
                <?php

            }
            else 
            {
                ?> 
                <script type="text/javascript">
                    window.location = "user/registration.php";
                </script>
                <?php
            } 
        }         
        ?>
         
    </div>
</body>
</html>