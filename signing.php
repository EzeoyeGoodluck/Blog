<?php
require 'config/constants.php';


$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signing-data']['password'] ?? null;

unset($_SESSION['signing_data']);



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
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
              <div class="alert__message succes">
                <p>
                  <?= $_SESSION['signup-success'];
                  unset($_SESSION['signup-success']);
                  ?>
                </p>
            </div>
           <?php elseif(isset($_SESSION['signin'])) : ?> 
            <div class="alert__message error">
                <p>
                  <?= $_SESSION['signin'];
                  unset($_SESSION['signin']);
                  ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signing-logic.php" method="POST">
                <input type="text" name="username_email" placeholder="Username or Email" value="<?= $username_email ?>">
                <input type="password" name="password" placeholder="Password" value="<?= $password ?>">
                <button type="submit" name="submit"  class="btn">Sign In</button>
                <small>Don't have an account? <a href="signup.php">sign Up</a></small>
            </form>
        </div>
    </section>

    
    
 
<?php
 include './partials/footer.php';  
 
?>