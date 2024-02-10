<?php
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
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
             <div class="mainbg">
                <br>
                <div class="boxfb" style="height: 500px; width: 450px; background-color:rgb(210 169 210); margin: 25px auto; opacity: .9;">
                    <br>
                    <h2 style="text-align: center; font-size: 30px; color: black; font-weight: bold;">Feedback</h2>
                    <h6 style="text-align: center; font-size: 17px; color: black;">Leave your feedback here:</h6>
                    <form action="" method="post">
                        <div class="login">
                        <input  class="form-control" type="text" name="comment" placeholder="Enter your feedback." required="">
                        <input class="btn btn-default" type="submit" name="submit" value="Comment"
                        style="background-color: purple; color: white;  width: 100px; height: 35px; text-align: center;  
                        display: inline-block; font-size: 16px; border-radius: 3px; margin-left: 105px; border: 2px;">
                        </div>
                    </form>
                    <br>
                    <div class="container" style="width: 100%; height: 275px; overflow: auto;">
                        <?php
                            if(isset($_POST['submit']))
                            {
                                $sql="INSERT INTO `comments` VALUES('', 'Admin', '$_POST[comment]')";
                                if(mysqli_query($db, $sql))
                                {
                                    $q="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
                                    $res=mysqli_query($db, $q);
                                    echo "<table class='table table-bordered'>";
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        echo "<tr style='color: black'>"; 
                                            echo "<td>"; echo $row['username']; echo "</td>";  
                                            echo "<td>"; echo $row['comment']; echo "</td>";   
                                        echo "</tr>";         
                                    }
                                    echo "</table>";
                                    
                                }
                            }
                            else
                            {
                                $q="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
                                $res=mysqli_query($db, $q);  
                                echo "<table class='table table-bordered'>";
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    echo "<tr style='color: black'>";  
                                        echo "<td>"; echo $row['username']; echo "</td>"; 
                                        echo "<td>"; echo $row['comment']; echo "</td>";   
                                    echo "</tr>";         
                                }
                                echo "</table>";
                            }
                        ?>
                    </div>
                </div> 
             </div>
        </section> 
    </div>
</body>
</html>