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
                        if($_GET['action'] == "delete"){
                            if(q($connect, "DELETE FROM taxi WHERE id = '".$_GET['id']."'")){
                                header('location:taxi-form.php?success=1');
                            }
                        }
                        if($_GET['success'] == 1){
                            echo '<h4 class="color-green" style="font-size:1.2em; margin-bottom:20px;">Your transaction is successful!</h4>';
                        }
                        if($_POST && $_GET['action'] != "edit"){
                            $user_id = strip_tags($_POST['user_id']);
                            $name = strip_tags($_POST['name']);
                            $email = strip_tags($_POST['email']);
                            $phone = strip_tags($_POST['phone']);
                            $address = strip_tags($_POST['address']);
                            if(q($connect, "INSERT INTO taxi (user_id, name, email, phone, address) VALUES ('$user_id','$name', '$email', '$phone', '$address') ")){
                                header('location:taxi-form.php?success=1');
                            }else{
                                echo '<strong class="color-red">Error!</strong>';
                            }
                        }else if($_POST && $_GET['action'] == "edit"){
                            $user_id = strip_tags($_POST['user_id']);
                            $name = strip_tags($_POST['name']);
                            $email = strip_tags($_POST['email']);
                            $phone = strip_tags($_POST['phone']);
                            $address = strip_tags($_POST['address']);
                            if(q($connect, "UPDATE taxi SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = '".$_POST['id']."' ")){
                                header('location:taxi-form.php?success=1');
                            }else{
                                echo '<strong class="color-red">Error!</strong>';
                            }
                        }
              
                    ?>
                </div>
                <?php 
                // $user = select($connect, "SELECT * FROM taxi WHERE id = '".$_SESSION['login']."'");
                ?>
                <form action="taxi-form.php?action=<?=empty($_GET['action']) ? 'insert' : $_GET['action']?>" method="post" class="myform">
                    <input type="hidden" name="user_id" value="<?=$_SESSION['login']?>" />
                    <input type="hidden" name="id" value="<?=$_GET['action'] == "edit" ? $_GET['id'] : 0?>" />
                    <div class="inputBox">
                        <?php 
                            if($_GET['action'] != "edit"){
                        ?>
                        <input type="text" name="name" value="<?=$user['data']['name']?>" placeholder="Name" class="input" required>
                        <input type="email" name="email" value="<?=$user['data']['email']?>" placeholder="Email" class="input" required>
                        <input type="text" name="phone" value="<?=$user['data']['phone']?>" placeholder="Phone" class="input" required>
                        <input type="text" name="address" value="<?=$user['data']['address']?>" placeholder="Address" class="input" required>
                        <?php 
                            }else{
                            $update = select($connect, "SELECT * FROM taxi WHERE id = '".$_GET['id']."'");
                        ?>
                        <input type="text" name="name" value="<?=$update['data']['name']?>" placeholder="Name" class="input" required>
                        <input type="email" name="email" value="<?=$update['data']['email']?>" placeholder="Email" class="input" required>
                        <input type="text" name="phone" value="<?=$update['data']['phone']?>" placeholder="Phone" class="input" required>
                        <input type="text" name="address" value="<?=$update['data']['address']?>" placeholder="Address" class="input" required>
                        <?php 
                            }
                        ?>
                    </div>
                    <input type="submit" value="Save" class="btn">
                </form>
                <br>
                <br>
                <h3>All Taxi List</h3>
                <table width="100%"  style="border-top:1px solid #ddd; margin-top:20px; padding-top:20px;">
                <tr>
                    <td><strong>Name</strong></td>
                    <td><strong>Email</strong></td>
                    <td><strong>Phone</strong></td>
                    <td><strong>Address</strong></td>
                    <td><strong>Delete</strong></td>
                </tr>
                    <?php 
                    foreach(r($connect, "select * from taxi where user_id = '".$_SESSION['login']."' ")['data'] as $item): 
                    ?>
                    <?php if(!empty($item['name'])): ?>
                    <tr>
                        <td><?=$item['name']?></td>
                        <td><?=$item['email']?></td>
                        <td><?=$item['phone']?></td>
                        <td><?=$item['address']?></td>
                        <td>
                            <a href="taxi-form.php?action=edit&id=<?=$item['id']?>">Edit</a><br>
                            <a href="taxi-form.php?action=delete&id=<?=$item['id']?>">Delete</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </table>
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