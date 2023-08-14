<?php

require './config/constants.php';

// get back data if there was a regisrtation error
$firstname = $_SESSION['signup-data']['fistname'] ?? null ;
$lastname = $_SESSION['signup-data']['lastname'] ?? null ;
$username = $_SESSION['signup-data']['username'] ?? null ;
$email = $_SESSION['signup-data']['email'] ?? null ;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null ;
$confirmpasssword = $_SESSION['signup-data']['confirmpassword'] ?? null ;

// delete session

unset($_SESSION['signup-data']);


?>

<!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.8/css/line.css"
    />
    <link rel="stylesheet" href="./css/style.css" />
    <title>Blog Website</title>
  </head>
  <body>



    
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>
            <?php if (isset($_SESSION['signup'])) : ?>
              <div class="alert__message error">
                <p>
                  <?= $_SESSION['signup'];
                  unset($_SESSION['signup']);
                  ?>
                </p>
            </div>

            <?php endif ?>
            <form action="<?php echo ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?= $lastname ?>"  placeholder="Last Name">
                <input type="text" name="username"  value="<?= $username ?>" placeholder="UserName">
                <input type="text" name="email"  value="<?= $email ?>" placeholder="Email">
                <input type="text" name="createpassword"  value="<?= $createpassword ?>" placeholder="Create password">
                <input type="text"  value="<?= $confirmpasssword ?>" name="confirmpassword" placeholder="Confirm password">
                <div class="form__control">
                    <label for="avatar"> User Avatar</label>
                    <input name="avatar" type="file" id="avatar">
                </div>
                <button type="submit"  name="submit" class="btn">Sign Up</button>
                <small>Already have an account? <a href="signing.php">sign in</a></small>
            </form>
        </div>
    </section>

    
    
 
    <?php
 include './partials/footer.php';  
 
 ?>