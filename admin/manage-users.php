<?php
  session_start();
  include './partials/header.php';

//   fecth all users except us
 $current_admin_id = $_SESSION['user-id'];
 $query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
 $users = mysqli_query($connection , $query);

 ?>


    <section class="dashboard">
    <?php if(isset($_SESSION['add-user-success'])) : ?>
          <div class="alert__message  succes container">
            <p>
                <?= $_SESSION['add-user-success'];
                unset($_SESSION['add-user-success']);
                ?>
            </p>
          </div>
          <?php endif ?> 
          <?php if(isset($_SESSION['edit-user-succes'])) :  ?>
          <div class="alert__message  succes container">
            <p>
                <?= $_SESSION['edit-user-succes'];
                unset($_SESSION['edit-user-succes']);
                ?>
            </p>
          </div>
          <?php endif ?> 
          <?php if(isset($_SESSION['edit-user'])) :  ?>
          <div class="alert__message  error container">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
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
                        <a href="add-post.php"><i class="uil uil-pen"></i><h5>Add Post </h5></a>
                    </li>
                    <li>
                        <a href="index.php"><i class="uil uil-postcard"></i><h5>Manage Post</h5></a>
                    </li>
                    <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <li>
                        <a href="add-user.php"><i class="uil uil-user-plus"></i><h5>Add User</h5></a>
                    </li>
                    <li>
                        <a class="active" href="manage-users.php"><i class="uil  uil-users-alt"></i><h5>Manage User</h5></a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i><h5>Add Category</h5></a>
                    </li>
                    <li>
                        <a  href="manage-categories.php"><i class="uil uil-list-ul"></i><h5>Manage Categories</h5></a>
                    </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage users</h2>
                <?php  if(mysqli_num_rows($users) > 0) :  ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)) : ?>
                        <tr>
                            <td><?= " {$user['firstname']} {$user['lastname'] }"?></td>
                            <td><?= $user['username'] ?> </td>
                            <td><a class="btn sm" href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?> ">Edit</a></td>
                            <td><a class="btn sm danger" href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>">Delete</a></td>
                            <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                        </tr>
                       <?php endwhile ?>    
                    </tbody>
                </table>
                <?php  else : ?> 
                    <div class="alert__message error"> <?= "No users found" ?></div>
                <?php endif ?>    
            </main>
        </div>
    </section>

<?php
  include '../partials/footer.php';
?>
