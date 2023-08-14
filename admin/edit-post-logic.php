<?php


require 'config/database.php';



// make sure edit post is clicked

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];


    // set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

       // check and validate inout values
    if (!$title){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif(!$category_id) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
    } elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit post page";
     
    } else{
      
        if($thumbnail['name']) {
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            if ($previous_thumbnail_path) {
                echo $previous_thumbnail_path;
                unlink($previous_thumbnail_path);
            }

            // WORK ON NEW THUMBNAIL
            // Rename image
            $time = time(); //make each image name upload unique using current timestamp
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;


            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            var_dump($extension . " the extention end");
            var_dump($allowed_files);

            if(in_array($extension,  $allowed_files)) {
                // make sure avatar is not too large (2mb+)
                if($thumbnail['size'] < 3000000) {
                    // uplaod avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                    echo 'image uplaoded';
                }else{ 
                    $_SESSION['edit-post'] = "Couldn't update post. Thumbnail size too big. Should be less than 2mb";
                    echo  "Couldn't update post. Thumbnail size too big. Should be less than 2mb";
                }
            } else{
                $_SESSION['edit-post'] = " this is bad";

                
            }
        }
    }

    if(isset($_SESSION['edit-post'])){
        echo "form was invalid";
        var_dump($_SESSION['edit-post']);
        // redirect to manage form page if form was invalid
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        echo "Form was valid";
        // set is_featured of all posts to 0 if is_featured for this post is 1
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        // set thumbnail name if a new one was uplaoded else keep old thumbnail name
        $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        // echo $body;

        $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured=$is_featured  WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        echo "post uploaded succesfully";   
    }

    if (!mysqli_errno($connection)){
        $_SESSION['edit-post-success'] = "post updated seccessfully";
      
    }
}

header('location: ' .ROOT_URL . 'admin/');
die();




    ?>