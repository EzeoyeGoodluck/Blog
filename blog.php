<?php
include './partials/header.php';

// fetch all posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC ";
$posts = mysqli_query($connection, $query);


?>

    <!--===================================== SEARCH============================================== -->

    <section class="search__bar" >
        <form class="container search__bar-container" method="GET" action="<?= ROOT_URL ?>search.php">
            <div>
                <i class="uil uil-search"></i>
                <input type="search"  name="search" placeholder="search">
            </div>
            <button type="submit" name="submit" class="btn">GO</button>
        </form>
    </section>
   
    <!--================ End of SEARCH section============================== -->

    <!--=============================POST SECTION=======================  -->
    <section class="posts <? $featured ? '' : 'section__extra-margin' ?> ">
      <div class="container posts__container">
        <?php  while ($post = mysqli_fetch_assoc($posts)) : ?>
        <!-- ARTICLE ONE -->
        <article class="post">
          <div class="post__thumbnail">
            <img src="./images/<?=  $post['thumbnail'] ?> " alt="blog">
          </div>
          <div class="post__info">
          <?php
            // fetch category from categories table using category_id of post

           

            $category_id = $post['category_id'];
            $category_query = "SELECT  * FROM categories WHERE id=$category_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            // $category_title = $category['title'];
              ?>

            <a href="<?= ROOT_URL  ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"> <?= $category['title']  ?></a>
            <h3 class="post__title"> <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $post['title'] ?></a></h3>
            <p class="post__body">
              <?= substr($post['body'] , 0,300) ?>...
            </p>
          </div>
          <div class="post__author">
          <?php
                 $author_id = $id;
                 $author_query = "SELECT * FROM users WHERE id=$id";
                 $author_result = mysqli_query($connection, $author_query);
                 $author = mysqli_fetch_assoc($author_result);

                ?>
            <div class="post__author-averter">
              <img src="./images/<?= $author['avatar']  ?>" alt="">
            </div>
            <div class="post__author-info">
             <?php
            // fetch category from categories table using category_id of post

            $category_id = $id;
            $category_query = "SELECT  * FROM categories WHERE id=$id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
    
              ?>
              <h5>By : <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
              <small>
              <?= date("M d, Y - H:i", strtotime($post['date_time']))   ?>
              </small>
            </div>
          </div>
        </article>

        <?php  endwhile ?>
  
      </div>
    </section>

    <!-- ================================ End of Post =================================================== -->


    <section class="category__buttons">
      <div class="container category__buttons-container">
      <?php
      $all_categories = "SELECT * FROM categories";
      $all_categories_result = mysqli_query($connection, $all_categories);
       ?>
       <?php while($category = mysqli_fetch_assoc($all_categories_result))   :?>
        <a href="<?=  ROOT_URL ?>category-posts.php?id=<?= $category['id']  ?>" class="category__button"><?= $category['title']  ?></a>
      <?php endwhile  ?> 
      </div>
    </section>
    <!-- ================================ End of category__buttons=================================================== -->

    <?php
 include './partials/footer.php';
?>