<?php 
    include "config/config.php";
    if(empty($_SESSION['login'])){
        header('location:index.php');
    }
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
    <title>Account - Island Taxi</title>
</head>

<body>
    <?php 
        include "./includes/header.php";
    ?>

    <div class="our-service page-content">
        <div class="service-heading">
            <h3>Profile Edit</h3>
        </div>

        <div class="account-container">
            <div class="account-content">
                <div class="form-req">
                    <?php 
                        if($_POST){
                            $name = strip_tags($_POST['name']);
                            $email = strip_tags($_POST['email']);
                            $password = strip_tags($_POST['password']);
                            if(q($connect, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id = '".$_SESSION['login']."'")){
                                header('location:account.php?success=1');
                            }else{
                                echo '<strong class="color-red">Your email or password is incorrect!</strong>';
                            }
                        }
                        if($_GET['success'] == 1){
                            echo '<strong class="color-green">Updated!</strong>';
                        }
                    ?>
                </div>
                <?php 
                $user = select($connect, "SELECT * FROM users WHERE id = '".$_SESSION['login']."'");
                ?>
                <form action="" method="post" class="myform">
                    <div class="inputBox">
                        <input type="text" name="name" value="<?=$user['data']['name']?>" placeholder="Name" class="input" required>
                        <input type="email" name="email" value="<?=$user['data']['email']?>" placeholder="Email" class="input" required>
                        <input type="password" name="password" value="<?=$user['data']['password']?>" placeholder="Password" class="input" required>
                    </div>
                    <input type="submit" value="Update" class="btn">
                </form>
            </div>
            <div class="account-sidebar">
                <ul>
                    <li><a href="admin">Administrator</a></li>
                    <li><a href="account.php">Profile Edit</a></li>
                    <li><a href="taxi-form.php">Taxi Form</a></li>
                </ul>
            </div>
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