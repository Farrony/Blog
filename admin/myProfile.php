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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


  <!-- Body Content Start -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">User Information</h3>
            </div>
            <div class="card-body">
              <table class="table table-striped table-dark">
                <tbody>

                  <?php
                  $authId = $_SESSION['id'];
                  $sql = "SELECT * FROM users WHERE id='$authId' ";
                  $userData = mysqli_query($db, $sql);

                  while ($row = mysqli_fetch_array($userData)) {
                    $id          = $row['id'];
                    $image       = $row['image'];
                    $fullname    = $row['fullname'];
                    $username    = $row['username'];
                    $email       = $row['email'];
                    $password    = $row['password'];
                    $phone       = $row['phone'];
                    $address     = $row['address'];
                    $role        = $row['role'];
                    $status      = $row['status'];
                    $joindate    = $row['joindate'];
                  ?>
                    <tr class="bg-success">
                      <th scope="row">Image</th>
                      <td>
                        <?php
                        if (!empty($image)) { ?>
                          <img src="img/users/<?php echo $image; ?>" width="35">
                        <?php } else { ?>
                          <img src="img/users/default.jpg" width="35">
                        <?php }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Fullname</th>
                      <td> <?php echo $fullname; ?> </td>
                    </tr>
                    <tr>
                      <th scope="row">Username</th>
                      <td><?php echo $username; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Email</th>
                      <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Phone</th>
                      <td><?php echo $phone; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Address</th>
                      <td><?php echo $address; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">User Role</th>
                      <td>
                        <?php
                        if ($role == 1) { ?>
                          <span class="badge badge-success">Admin</span>
                        <?php } else { ?>
                          <span class="badge badge-primary">Editor</span>
                        <?php }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Active Status</th>
                      <td>
                        <?php
                        if ($status == 1) { ?>
                          <span class="badge badge-success">Active</span>
                        <?php } else { ?>
                          <span class="badge badge-danger">In-Active</span>
                        <?php }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Join Date</th>
                      <td><?php echo $joindate; ?></td>
                    </tr>
                  <?php }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <a href="updateUser.php?id=<?php echo $authId; ?>" class="btn btn-primary">Update Profile</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Body Content End -->



</div>


<?php include('inc/footer.php'); ?>