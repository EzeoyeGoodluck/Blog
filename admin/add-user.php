<?php

  include './partials/header.php';

 //get back form data if there was an error

 $firstname = $_SESSION['add-user-data']['firstname'] ?? null;
 $lastname = $_SESSION['add-user-data']['lastname'] ?? null;
 $username = $_SESSION['add-user-data']['username'] ?? null;
 $email = $_SESSION['add-user-data']['email']['email'] ?? null;
 $createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
 $confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
 $is_admin = $_SESSION['add-user-data']['user-role'] ?? null;

//  delete session data
unset($_SESSION['add-user-data']);



?>

    
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add User</h2>
            <?php if (isset($_SESSION['add-user'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                     ?>
                </p>
            </div>

            <?php endif ?>
            <form action=" <?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" value="<?= $firstname ?>" name="firstname" placeholder="firstname">
                <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="UserName">
                <input type="text" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="text" name="createpassword" value="<?= $createpassword ?>" placeholder="Create password">
                <input type="text" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm password">
                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form__control">
                    <label for="avater"> User Avater</label>
                    <input type="file" name="avatar" id="averter">
                </div>
                <button type="submit" name="submit" class="btn">Add User</button>
        </div>
    </section>

    
    <?php
  include '../partials/footer.php';
?>
