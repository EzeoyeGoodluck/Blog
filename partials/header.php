<?php
require 'config/database.php';

// fetch current user from database
if(isset($_SESSION['user-id'])){
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar FROM users WHERE id=$id";
  $result = mysqli_query($connection, $query);
  $avatar = mysqli_fetch_assoc($result);

}

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
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Blog Website</title>
  </head>
  <body>
    <nav>
      <div class="container nav__container">
        <a href="<?php echo ROOT_URL?>" class="nav__logo">EZEOYE</a>
        <ul class="nav__items">
          <li><a href="<?php echo ROOT_URL?>blog.php">Blog</a></li>
          <li><a href="<?php echo ROOT_URL?>about.php">About</a></li>
          <li><a href="<?php echo ROOT_URL?>services.php">Services</a></li>
          <li><a href="<?php echo ROOT_URL?>contact.php">Contact</a></li>
       
          <?php if(isset($_SESSION['user-id'])) : ?>
          <li class="nav__profile">
            <div class="avater">
              <img src="<?=  ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="images" />
            </div>
            <ul>
              <li><a href="<?php echo ROOT_URL?>admin/index.php">Dashboard</a></li>
              <li><a href="<?php echo ROOT_URL?>logout.php">Logout</a></li>
            </ul>
          </li>
          <?php else  : ?>
                <li><a href="<?php echo ROOT_URL?>signing.php">Signing</a></li>
          <?php endif ?>      
        </ul>
        <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
        <button id="close__nav-btn">
          <i class="uil uil-multiply"></i>
        </button>
      </div>
    </nav>

    <!-- ========================END OF NAV========================== -->