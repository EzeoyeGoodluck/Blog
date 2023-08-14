<?php
  include './partials/header.php';


//   fetch categories from database
$query = "SELECT * FROM categories ORDER BY title";
$categories = mysqli_query($connection, $query);

?>

    <section class="dashboard">
    <?php if(isset($_SESSION['add-category-success'])) ://shows if add category was succesful ?>
          <div class="alert__message  succes container">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
          </div>
          <?php if(isset($_SESSION['edit-category'])) ://shows if edit category was  NOT succesful ?>
          <div class="alert__message  error container">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
          </div>
          <?php endif ?> 
          <?php elseif(isset($_SESSION['edit-category-success'])) ://shows if edit category was  succesful ?>
          <div class="alert__message  succes container">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
          </div>
          <?php elseif(isset($_SESSION['delete-category-success'])) ://shows if delete category was  succesful ?>
          <div class="alert__message  succes container">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
          </div>
          <?php elseif(isset($_SESSION['add-category-success'])) : //shows if add category was not successful ?>
          <div class="alert__message   error container">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
          </div>
    <?php endif ?>      
        <div class="container dashboard__container">
          <button class="sidebar__toggle" id="show__side-bar-btn"><i class="uil uil-angle-right"></i></button>
          <button class="sidebar__toggle" id="hide__side-bar-btn"><i class="uil uil-angle-left"></i></button>
            <aside>
                <ul>
                    <li>
                        <a href="<?= ROOT_URL . 'admin/add-post.php'   ?>"><i class="uil uil-pen"></i><h5>Add Post </h5></a>
                    </li>
                    <li>
                        <a href="<?= ROOT_URL . 'admin/index.php' ?>"><i class="uil uil-postcard"></i><h5>Manage Post</h5></a>
                    </li>
                    <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="<?= ROOT_URL .  'admin/add-user.php' ?>"><i class="uil uil-user-plus"></i><h5>Add User</h5></a>
                    </li>
                    <li>
                        <a href="<?= ROOT_URL . 'admin/manage-users.php'  ?> "><i class="uil  uil-users-alt"></i><h5>Manage User</h5></a>
                    </li>
                    <li>
                        <a href="<?= ROOT_URL . 'admin/add-category.php'    ?>"><i class="uil uil-edit"></i><h5>Add Category</h5></a>
                    </li>
                    <li>
                        <a class="active" href="<?= ROOT_URL . 'admin/manage-categories.php'    ?> "><i class="uil uil-list-ul"></i><h5>Manage Categories</h5></a>
                    </li>
                    <?php endif ?>   
                </ul>
            </aside>
            <main>
                <h2>Manage Categories</h2>
                <?php if(mysqli_num_rows($categories) > 0 ) : ?>  
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  while($category = mysqli_fetch_assoc($categories)) : ?>
                        <tr>
                            <td><?= $category['title'] ?></td>
                            <td><a class="btn sm" href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>">Edit</a></td>
                            <td><a class="btn sm danger" href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>">Delete</a></td>
                        </tr>
                        <?php  endwhile ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <div class="alert__message error"><?= "No categories found"  ?></div>
                <?php endif ?>
            </main>
        </div>
    </section>
<?php
  include '../partials/footer.php';
?>
