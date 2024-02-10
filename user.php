<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>User</title>
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
             <div class="userbg">
                <br><br>
                <div class="box" style="height:470px">
                    <br>
                    <h1 style="text-align: center; font-size: 40px; color: black;">Welcome Back!</h1>
                    <h1 style="text-align: center; font-size: 35px; color: black;">Login As:</h1><br>

                    <form name="user" action="" method="post">

                        <input type="radio" name="users" id="admin" value="admin" style="margin-left:120px; width:20px;">
                        <label for="admin" style="font-size:18px; color: black;">Admin</label>
                        <input type="radio" name="users" id="user" value="user" checked="" style="margin-left:50px; width:20px">
                        <label for="user" style="font-size:18px; color: black;">User</label>
                        
                        <div class="login">
                        <br>
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Log In"
                        style="background-color: purple; color: white;  width: 100px; height: 40px; text-align: center;  
                        display: inline-block; font-size: 18px; border-radius: 3px; margin-left: 105px; border: 2px;">
                        </div>
                        <p style="font-size: medium; text-align: center;">
                            <br>
                            Forgot Password?&nbsp<a style="font-weight: bold;" href="user/updatepassword.php">Click Here.</a><br>
                            New To This Website?&nbsp<a style="font-weight: bold;" href="registration.php">Sign Up.</a>
                        </p>
                    </form>
                </div>
             </div>
        </section>
        <?php
            if(isset($_POST['submit']))
            {
                /*FOR ADMIN*/
                if($_POST['users']=='admin')
                {
                    $count=0;
                    $res=mysqli_query($db,"SELECT * FROM `admin` WHERE
                    username='$_POST[username]' and password='$_POST[password]' and status='Yes';");

                    $row = mysqli_fetch_assoc($res);
                    $count = mysqli_num_rows($res);
                    
                    if($count==0)
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissible"
                            style=" height: 50px; width: 400px; font-size: 12px; margin-left:1060px; margin-top: -20px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>The Username or Password Don't Match or You're Not Approved as Admin Yet!</strong>
                        </div>
                        <?php
                    }
                    else
                    {
                        /*IF USERNAME & PASSWORD MATCHES*/
                        $_SESSION['login_user'] = $_POST['username'];
                        $_SESSION['pic'] = $row['pic'];
                        ?>
                        <div class="alert alert-success alert-dismissible"
                            style=" height: 50px; width: 400px; font-size: 15px; margin-left:1060px; margin-top: -20px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Login Successsful!</strong>
                            <script type="text/javascript">
                                window.location = "admin/index.php";
                            </script>
                        </div>
                        <?php
                    }
                }
                else
                {
                    /*FOR USER*/
                    $count=0;
                    $res=mysqli_query($db,"SELECT * FROM `users` WHERE
                    username='$_POST[username]' && password='$_POST[password]';");

                    $row=mysqli_fetch_assoc($res);
                    $count=mysqli_num_rows($res);
                    
                    if($count==0)
                    {
                        ?>
                        <div class="alert alert-danger alert-dismissible"
                            style=" height: 50px; width: 400px; font-size: 15px; margin-left:1060px; margin-top: -20px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>The Username and Password don't match!</strong>
                        </div>
                        <?php
                    }
                    else
                    {
                        /*IF USERNAME & PASSWORD MATCHES*/
                        $_SESSION['login_user'] = $_POST['username'];
                        $_SESSION['pic'] = $row['pic'];
                        ?>
                        <div class="alert alert-success alert-dismissible"
                            style=" height: 50px; width: 400px; font-size: 15px; margin-left:1060px; margin-top: -20px">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Login Successsful!</strong>
                            <script type="text/javascript">
                                window.location = "user/index.php";
                            </script>
                        </div>
                        <?php
                    }
                }  
            }
        ?>
         
    </div>

</body>
</html>