<?php include('inc/header.php'); ?>
<?php include('inc/topbar.php'); ?>
<?php include('inc/menu.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage All Posts</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <?php

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  // All Users Data
  if ($do == 'Manage') { ?>
    <!-- Body Content Start -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Manage All Post</h3>
              </div>
              <div class="card-body">
                <table class="table table-border table-hover table-striped table-responsive">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#Sl.</th>
                      <th scope="col">Image</th>
                      <th scope="col">Title</th>
                      <th scope="col">Category</th>
                      <th scope="col">Author</th>
                      <th scope="col">Status</th>
                      <th scope="col">Post Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $sql = "SELECT * FROM post ORDER BY id DESC";
                    $allPost = mysqli_query($db, $sql);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($allPost)) {
                      $post_id       = $row['id'];
                      $title         = $row['title'];
                      $description   = $row['description'];
                      $cat_id        = $row['cat_id'];
                      $auth_id       = $row['auth_id'];
                      $status        = $row['status'];
                      $tags          = $row['tags'];
                      $image         = $row['image'];
                      $post_date     = $row['post_date'];
                      $i++;
                    ?>

                      <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td>
                          <?php
                          if (!empty($image)) { ?>
                            <img src="img/post/<?php echo $image; ?>" width="50" alt="">
                          <?php } else { ?>
                            <img src="img/post/default.jpg" width="50" alt="">
                          <?php }
                          ?>
                        </td>
                        <td><?php echo $title; ?></td>
                        <td>
                          <?php
                          $sql = "SELECT * FROM category";
                          $all_cat = mysqli_query($db, $sql);
                          while ($row = mysqli_fetch_assoc($all_cat)) {
                            $category_id     = $row['cat_id'];
                            $cat_name   = $row['cat_name'];

                            if ($category_id == $cat_id) {
                              echo '<p>' . $cat_name . '</p>';
                            }
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          $sql = "SELECT * FROM users";
                          $all_users = mysqli_query($db, $sql);
                          while ($row = mysqli_fetch_assoc($all_users)) {
                            $id         = $row['id'];
                            $fullname   = $row['fullname'];
                            if ($auth_id == $id) {
                              echo '<p>' . $fullname . '</p>';
                            }
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          if ($status == 0) { ?>
                            <span class="badge badge-danger">Draft</span>
                          <?php } else { ?>
                            <span class="badge badge-success">Published</span>
                          <?php }
                          ?>
                        </td>
                        <td><?php echo $post_date; ?></td>
                        <td>
                          <div class="action-bar">
                            <ul>
                              <li><a href="post.php?do=Edit&id=<?php echo $post_id; ?>"><i class="fa fa-edit"></i></a></li>
                              <li><a href="" data-toggle="modal" data-target="#delete<?php echo $post_id; ?>">
                                  <i class="fa fa-trash"></i></a></li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <!-- Modal -->
                      <div class="modal fade" id="delete<?php echo $post_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this Post?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-center">

                              <div class="modal-confirmation">
                                <ul>
                                  <li>
                                    <a href="post.php?do=Delete&id=<?php echo $post_id; ?>" class="btn btn-danger">Confirm</a>
                                  </li>
                                  <li>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Body Content End -->
  <?php }

  // Add Form
  else if ($do == 'Add') { ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Add New Post</h3>
              </div>
              <div class="card-body">
                <form action="post.php?do=Insert" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" autocomplete="off" required="required">
                      </div>

                      <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-control">
                          <option>Please select a category</option>
                          <?php
                          $sql = "SELECT * FROM category ORDER BY cat_name ASC ";
                          $all_cat = mysqli_query($db, $sql);

                          while ($row = mysqli_fetch_assoc($all_cat)) {
                            $cat_id     = $row['cat_id'];
                            $cat_name   = $row['cat_name']; ?>

                            <option value="<?php echo $cat_id ?>"><?php echo $cat_name ?></option>
                          <?php }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option value="0">In-Active</option>
                          <option value="1">Active</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tags</label>
                        <input type="text" name="tags" class="form-control" autocomplete="off" required="required">
                      </div>
                      <div class="form-group">
                        <label> Thumbnail </label>
                        <input type="file" name="image" class="form-control-file">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" autocomplete="off" required="required" rows="15"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="submit" name="addPost" class="btn btn-primary" value="Publish Post">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php }

  

//Insert Data
  else if ($do == 'Insert') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $title           = mysqli_real_escape_string($db, $_POST['title']);
      $description     = mysqli_real_escape_string($db, $_POST['description']);
      $cat_id          = $_POST['category'];
      $auth_id         = $_SESSION['id'];
      $status          = $_POST['status'];
      $tags            = mysqli_real_escape_string($db, $_POST['tags']);


      $image  = $_FILES['image']['name'];
      $imageTmp   = $_FILES['image']['tmp_name'];

      if (!empty($image)) {
        //Change the image name
        $image = rand(0, 50000) . '_' . $image;
        move_uploaded_file($imageTmp, "img/post/" . $image);

        $sql = "INSERT INTO post ( title, description, cat_id , auth_id, status, tags,
                image, post_date ) VALUES ('$title', '$description' ,'$cat_id', '$auth_id', '$status'
                ,'$tags', '$image',now())";

        $addPost = mysqli_query($db, $sql);
        if ($addPost) {
          $_SESSION['stat'] = "Post Added Successfully.";
          header("Location: post.php?do=Manage");
          exit(0);
        } else {
          die("Mysqli Error" . mysqli_error($db));
        }
      }
      else { 
        $_SESSION['stat_er'] = "Post Not Added. Photo is Mandatory";
        header("Location: post.php?do=Add");
        exit(0);
        ?>
      <?php }
    }
  }
  // Edit Form 
  else if ($do == 'Edit') {
    if (isset($_GET['id'])) {
      $updateid = $_GET['id'];

      $sql = "SELECT * FROM post WHERE id = '$updateid' ";
      $thePost = mysqli_query($db, $sql);
      while ($row = mysqli_fetch_assoc($thePost)) {
        $id            = $row['id'];
        $title         = $row['title'];
        $description   = $row['description'];
        $cat_id        = $row['cat_id'];
        $auth_id       = $row['auth_id'];
        $status        = $row['status'];
        $tags          = $row['tags'];
        $image         = $row['image'];
        $post_date     = $row['post_date'];
      ?>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Update Post Info</h3>
                  </div>
                  <div class="card-body">
                    <form action="post.php?do=Update" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" autocomplete="off" required="required" value="<?php echo $title; ?>">
                          </div>

                          <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control" required>
                              <option>Please select a category</option>
                              <?php
                              $sql = "SELECT * FROM category ORDER BY cat_name ASC ";
                              $all_cat = mysqli_query($db, $sql);

                              while ($row = mysqli_fetch_assoc($all_cat)) {
                                $c_id     = $row['cat_id'];
                                $c_name   = $row['cat_name']; ?>

                                <option 
                                  <?php 
                                    if( $cat_id == $c_id ){
                                      echo "selected";
                                    }
                                  ?>
                                  value="<?php echo $c_id; ?>"><?php echo $c_name;?>
                                </option>
                              <?php }

                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                              <option value="0" <?php if ($status == 0) {
                                                  echo "selected";
                                                } ?>>In-Active</option>
                              <option value="1" <?php if ($status == 1) {
                                                  echo "selected";
                                                } ?>>Active</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Tags</label>
                            <input type="text" name="tags" class="form-control" autocomplete="off" required="required" value="<?php echo $tags; ?>">
                          </div>
                          <div class="form-group">
                            <label> Thumbnail </label>
                            <?php
                            if (!empty($image)) { ?>
                              <img src="img/post/<?php echo $image; ?>" width="35">
                            <?php } else { ?>
                              <img src="img/post/default.jpg" width="35">
                            <?php }
                            ?>
                            <input type="file" name="image" class="form-control-file">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" name="description" class="form-control" autocomplete="off"
                             rows="15"><?php echo $description; ?></textarea>
                          </div>
                          <div class="form-group">
                            <input type="hidden" name="updatePostId" value="<?php echo $id; ?>">
                            <input type="submit" name="updatePost" class="btn btn-primary" value="Update Post">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

  <?php }
    }
  }
  // update postinfo 
  else if ($do == 'Update') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $updatePostId  = $_POST['updatePostId'];
      $title         = mysqli_real_escape_string($db,$_POST['title']);
      $description   = mysqli_real_escape_string($db,$_POST['description']);
      $cat_id        = $_POST['category'];
      $auth_id       = $_SESSION['id'];
      $status        = $_POST['status'];
      $tags          = mysqli_real_escape_string($db,$_POST['tags']);


      $image  = $_FILES['image']['name'];
      $imageTmp   = $_FILES['image']['tmp_name'];

      if (!empty($image)) {

        //Change the image name
        $image = rand(0, 50000) . '_' . $image;
        move_uploaded_file($imageTmp, "img/post/" . $image);

        //   Delete existing image 
        $query = "SELECT * FROM post WHERE id='$updatePostId' ";
        $readPostData = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($readPostData)) {
          $exitingImage = $row['image'];
        }
        unlink("img/post/" . $exitingImage);

        // Update SQL 
        $sql = "UPDATE post SET  title='$title', description='$description' , cat_id='$cat_id',
                      auth_id='$auth_id', status='$status', tags='$tags', post_date=now(), image='$image'
                      WHERE id='$updatePostId' ";

        $updatePost = mysqli_query($db, $sql);
        if ($updatePost) {
          $_SESSION['stat'] = "Post Updated Successfully.";
          header("Location: post.php?do=Manage");
          exit(0);
        } else {
          die("Mysqli Error" . mysqli_error($db));
        }
      } else {
        // Update SQL
        $sql = "UPDATE post SET  title='$title', description='$description' , cat_id='$cat_id',
        auth_id='$auth_id', status='$status',tags='$tags', post_date=now()
        WHERE id='$updatePostId' ";

        $updatePost = mysqli_query($db, $sql);

        if ($updatePost) {
          $_SESSION['stat'] = "Post Updated Successfully.";
          header("Location: post.php?do=Manage");
          exit(0);
        } else {
          die("Mysqli Error" . mysqli_error($db));
        }
      }
    }
  }

  // Delete
  else if ($do == 'Delete') {
    if (isset($_GET['id'])) {
      $deletePostId = $_GET['id'];

      //   Delete existing image 
      $query = "SELECT * FROM post WHERE id='$deletePostId' ";
      $readPostData = mysqli_query($db, $query);
      while ($row = mysqli_fetch_assoc($readPostData)) {
        $exitingImage = $row['image'];
      }
      unlink("img/post/" . $exitingImage);

      $sql = "DELETE FROM post WHERE id='$deletePostId' ";
  
      $confirmDelete = mysqli_query($db, $sql);
      if ($confirmDelete) {
        $_SESSION['stat'] = "Post Deleted Successfully.";
        header("Location: post.php?do=Manage");
        exit(0);
      } else {
        die("Mysqli Error" . mysqli_error($db));
      }
    }
  }
  ?>

</div>


<?php include('inc/footer.php'); ?>