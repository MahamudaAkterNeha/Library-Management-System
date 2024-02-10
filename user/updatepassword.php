<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
             <div class="userbg" style="background-image: url('images/change.jpg');">
                <br><br><br>
                <div class="box">
                    <br><br>
                    <h1 style="text-align: center; font-size: 50px; color: black;">Change Password</h1><br><br>
                    <form action="" method="post">
                        <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="New Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Update"
                        style="background-color: purple; color: white;  width: 100px; height: 40px; text-align: center;  
                        display: inline-block; font-size: 18px; border-radius: 3px; margin-left: 105px; border: 2px;">
                        </div>
                    </form>
                </div>
             </div>
        </section>
        <?php
            if(isset($_POST['submit']))
            {
                $sql=mysqli_query($db,"UPDATE users SET password='$_POST[password]' WHERE 
                username='$_POST[username]' && email='$_POST[email]';");
                if($count==0)
                {
                    ?>
                    <script type = "text/javascript">
                        alert("Password Updated Successfully!");
                        window.location = "user.php";
                    </script>
                    <?php
                }
            }
        ?>
         
    </div>

</body>
</html>