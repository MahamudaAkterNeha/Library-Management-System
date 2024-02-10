<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
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
                <br><br>
                <div class="box">
                    <br>
                    <h1 style="text-align: center; font-size: 40px; color: black;">Admin Registration</h1><br>
                    <form name="registration" action="" method="post">
                        <div class="signup">
                        <input class="form-control" type="text" name="firstname" placeholder="FirstName" required=""><br>
                        <input class="form-control" type="text" name="lastname" placeholder="LastName" required=""><br>
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="text" name="email" placeholder="Email e.g. abc@email.com" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="form-control" type="text" name="phonenumber" placeholder="PhoneNumber" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Sign Up"
                        style="background-color: purple; color: white;  width: 100px; height: 40px; text-align: center;  
                        display: inline-block; font-size: 18px; border-radius: 3px; margin-left: 110px; border: 2px;">
                        </div>
                        </div>
                    </form> 
                </div>
             </div>
        </section>   
        <?php
        if(isset($_POST['submit']))
        {
            $count = 0;
            $sql = "SELECT username FROM `admin`";
            $result = mysqli_query($db, $sql);

            while($row = mysqli_fetch_assoc($result))
            {
                if($row['username'] == $_POST['username'])
                {
                    $count = $count+1;
                }
            }
            if($count==0)
            {
                mysqli_query($db,"INSERT INTO admin (firstname, lastname, username, email, password, phonenumber, pic, status)
                VALUES('$_POST[firstname]', '$_POST[lastname]', '$_POST[username]',
                '$_POST[email]', '$_POST[password]', '$_POST[phonenumber]', 'dp.png', '');");             
                ?>
                   <script type="text/javascript">
                        window.location = "../user.php";
                    </script>
                <?php
            }
            else
            {
                ?>
                <div class="alert alert-danger alert-dismissible"
                    style=" height: 50px; width: 400px; font-size: 15px; margin-left:1060px; margin-top: -20px">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The username already exist!</strong>
                </div>
                <?php
            }
        }
        ?>
    </div>
</body>
</html>