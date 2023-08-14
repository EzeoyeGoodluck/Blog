<?php
session_start();

require './config/database.php';


// GET SIGNUP DATA IF BUTTON WAS CLICKED

if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];



    // VALIDATE INPUT VALUES
    if (!$firstname){
        $_SESSION['signup'] = 'please enter you firstname';
    }elseif (!$lastname){
        $_SESSION['signup'] = 'please enter your lastname';
    }elseif (!$username){
        $_SESSION['signup'] = 'please enter your username';
    }elseif (!$email){
        $_SESSION['signup'] = 'please enter your email';
    }elseif (strlen($createpassword) < 8){
        $_SESSION['signup'] = 'password should be 8+ characters';
    } elseif(!$avatar['name']){
        $_SESSION['signup'] = 'please add avater';
    } else{
        // CHECK IF PASSWORDS MATCH
        if($createpassword !== $confirmpassword){
            $_SESSION['signup'] = "passwords do not match";
        } else{
            // hash password
            $hash_password = password_hash($createpassword, PASSWORD_DEFAULT); 

            // CHECK IF THE USERNAME OR EMAIL ALREADY EXIST IN THE DATEBASE
            $user_check_query = " SELECT * FROM users WHERE username= '$username' OR email= '$email'"; 
            $user_check_result = mysqli_query($connection, $user_check_query);

            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup'] = "Username or Email already exist";
            }  else{
                // WORK ON AVATAR
                // RENAME AVATAR
                $time = time(); //to make each of the name of the avater unique
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                // MAKE SURE ITS AN IMAGE
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if(in_array($extention , $allowed_files)){
                    // make sure image is not too large(1mb+)
                    if($avatar['size'] < 1000000){
                        // uplaod avater
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path );
    
                    }else{
                        $_SESSION['signup'] = 'File size is too big. Should be less than 1mb';
                    }
                } else{
                    $_SESSION['signup'] = 'Files should be png , jpg , jpeg';

                }
            }   
        }

    }

    // redirect back to signup id there was  any problem
    if (isset($_SESSION['signup'])) {
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // insert new user into users table

        $insert_user_query = " INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hash_password', avatar= '$avatar_name', is_admin=0";

        $insert_user_result = mysqli_query($connection , $insert_user_query);


        if(!mysqli_errno($connection)){
            // redirect to login page with succes message
            $_SESSION['signup-success'] = "Registration succesful. Please log in";
            header('location: ' . ROOT_URL . 'signing.php');
            die();
          
        }
    }
// var_dump($avatar);          
   
} else {

    // if the button wasnt clicked
    header('location:' .ROOT_URL . 'signup.php');
    die();
 
}








?>






