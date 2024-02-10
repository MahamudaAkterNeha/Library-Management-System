<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>  
    
    <style>
         
    </style>
</head>

<body>
      <div class="wrapper">
        <?php
            include "navbar.php";
        ?> 
        <div id="main" style="background-image: url(images/edit.jpg);">
            <section>
            <div class="container-lg mt-3 border" style="text-align: center;">
            <?php
                $sql = "SELECT * FROM `admin` WHERE username = '$_SESSION[login_user]'";
                $result = mysqli_query($db, $sql);

                while($row = mysqli_fetch_assoc($result))
                {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $phonenumber = $row['phonenumber'];
                }
            ?>  
            <br> 
            <h2 style="color: black;width: 440px; margin-left:510px;"><b>Edit Profile Information</b></h2>
                <h4 style="text-align: center;color: purple"><i><b>
                    <?php
                        echo $_SESSION['login_user'];
                    ?>
                </b></i></h4>   
                <form class="navbar-form" action="" method="post" enctype="multipart/form-data">
                    <input class="form-control" type="text" name="firstname" value="<?php echo $firstname;?>" required=""style="height:40px; width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="lastname" value="<?php echo $lastname;?>" required="" style="height:40px;width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="username" value="<?php echo $username;?>" required="" style="height:40px;width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="email" value="<?php echo $email;?>" required="" style="height:40px;width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="password" value="<?php echo $password;?>" required="" style="height:40px;width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <input class="form-control" type="text" name="phonenumber" value="<?php echo $phonenumber;?>" required="" style="height:40px;width: 400px; margin-left: -15px; background-color:rgb(245, 225, 245); color: black"><br><br>
                    <button class="btn btn-default" type="submit" name="submit"
                    style="background-color: rgb(164, 89, 164);width: 130px; font-weight:bold; font-size: 18px">Save</button><br><br>
                </form>

                <?php
                    if(isset($_POST['submit']))
                    {
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $phonenumber = $_POST['phonenumber']; 

                        $sql1 = "UPDATE `admin` SET firstname='$firstname', lastname='$lastname', username='$username',
                        email='$email', password='$password', phonenumber='$phonenumber' WHERE username = '".$_SESSION['login_user']."';";

                        if(mysqli_query($db,$sql1))
                        {
                            ?>
                            <div class="alert alert-success alert-dismissible"
                                style=" height: 50px; width: 400px; font-size: 15px; margin-left:1060px; margin-top: -20px">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Saved Successfully!</strong>
                                <script type="text/javascript">
                                    window.location="profile.php";
                                </script>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
            </section>
        </div>
    </div>
</body>
</html>