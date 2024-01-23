<?php 
    include "config/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/ders/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c1df782baf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="theme/style.css">
    <title>Island Taxi</title>
</head>

<body>
    <?php 
        include "./includes/header.php";
    ?>
   
    <div class="our-service page-content">
        <div class="service-heading">
            <h3>Login</h3>
            <h1>Login</h1>
        </div>

       <div class="form-container">
            <div class="form-req">
                <?php 
                    if($_POST){
                        $name = strip_tags($_POST['name']);
                        $email = strip_tags($_POST['email']);
                        $password = strip_tags($_POST['password']);
                        $login = select($connect, "SELECT * FROM users WHERE email = '$email' and password='$password' ");
                        if($login['count'] > 0){
                            $_SESSION["login"] = $login['data']['id'];
                            header('location:account.php');
                        }else{
                            echo '<strong class="color-red">Your email or password is incorrect!</strong>';
                        }
                    }
                ?>
            </div>
            <form action="" method="post" class="myform">
                <div class="inputBox">
                    <input type="email" name="email" placeholder="Email" class="input" required>
                    <input type="password" name="password" placeholder="Password" class="input" required>
                </div>
                <input type="submit" value="Login" class="btn">
            </form>
       </div>
    </div>
   
    <div class="image footer-image">
        <img src="images/comfort.jpg" alt="">
    </div>
    <?php 
        include "./includes/footer.php";
    ?>

    <div id="location"></div>
    <script src="theme/script.js"></script>
    <script src="theme/location1.js"></script>
</body>

</html>