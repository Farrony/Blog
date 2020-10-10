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
              <li class="breadcrumb-item active">Manage All Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php

        // if(isset($_GET['do'])){
        //     $do=$_GET['do'];
        // }
        // else{
        //     $do='Manage';
        // }
        if( $_SESSION['role'] == 1 ) {
        $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

        // All Users Data
        if( $do == 'Manage'){ ?>
                <!-- Body Content Start -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Manage All Users</h3>
                            </div>
                            <div class="card-body">
                            <table class="table table-border table-hover table-striped table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">#Sl.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">User Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Join Date</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $sql="SELECT * FROM users ORDER BY id DESC";
                                    $allusers=mysqli_query($db,$sql);
                                    $i = 0;
                                    while($row=mysqli_fetch_assoc($allusers)){
                                        $id         = $row['id'];
                                        $fullname   = $row['fullname'];
                                        $email      = $row['email'];
                                        $username   = $row['username'];
                                        $password   = $row['password'];
                                        $phone      = $row['phone'];
                                        $address    = $row['address'];
                                        $role       = $row['role'];
                                        $status     = $row['status'];
                                        $image      = $row['image'];
                                        $joindate   = $row['joindate'];
                                        $i++;
                                     ?>

                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td>
                                            <?php
                                                if( !empty($image) ){ ?>
                                                    <img src="img/users/<?php echo $image; ?>" width="35" alt="">
                                               <?php }
                                                else { ?>
                                                    <img src="img/users/default.jpg" width="35" alt="">
                                                <?php }
                                            ?>
                                        </td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td>
                                            <?php
                                            if( $role == 1){ ?>
                                                    <span class="badge badge-success">Admin</span>
                                                <?php }
                                                elseif ( $role == 2){ ?>
                                                    <span class="badge badge-primary">Editor</span>
                                                <?php }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if( $status == 0){ ?>
                                                    <span class="badge badge-danger">In-Active</span>
                                                <?php }
                                                elseif ( $status == 1){ ?>
                                                    <span class="badge badge-success">Active</span>
                                                <?php }
                                            ?>
                                        </td>
                                        <td><?php echo $joindate; ?></td>
                                        <td>
                                            <div class="action-bar">
                                                <ul>
                                                    <li><a href="users.php?do=Edit&id=<?php echo $id ?>"><i class="fa fa-edit"></i></a></li>
                                                    <li><a href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                                    <i class="fa fa-trash"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this User?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body text-center">

                                            <div class="modal-confirmation">
                                                <ul>
                                                <li>
                                                    <a href="users.php?do=Delete&id=<?php echo $id; ?>" class="btn btn-danger">Confirm</a>
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
        else if ( $do == 'Add'){ ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Add User Info</h3>
                            </div>
                            <div class="card-body">
                                <form action="users.php?do=Insert" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" class="form-control" autocomplete="off" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" autocomplete="off" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" autocomplete="off" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" autocomplete="off" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Re-Type Password</label>
                                                <input type="password" name="repassword" class="form-control" autocomplete="off" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input type="text" name="phone" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>User Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="1">Super Admin</option>
                                                    <option value="2">Editor</option>
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
                                                <label>Prifile Picture</label>
                                                <input type="file" name="image" class="form-control-file" >
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="addUser" class="btn btn-primary" value="Register User">
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

        else if ($do == 'Insert'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $fullname    = $_POST['fullname'];
                $username    = $_POST['username'];
                $email       = $_POST['email'];
                $password    = $_POST['password'];
                $repassword  = $_POST['repassword'];
                $phone       = $_POST['phone'];
                $address     = $_POST['address'];
                $role        = $_POST['role'];
                $status      = $_POST['status'];

               
                $image  = $_FILES['image']['name'];
                $imageTmp   = $_FILES['image']['tmp_name'];

                if( $password == $repassword ){
                    //Encryption
                    $hassPass=sha1($password);

                    if ( !empty($image) ) {
                          //Change the image name
                        $image = rand(0,50000) . '_' . $image;
                        move_uploaded_file($imageTmp,"img/users/". $image);

                        $sql = "INSERT INTO users ( fullname, username, email , password, phone, address, role, status,
                        image, joindate ) VALUES ('$fullname', '$username' ,'$email', '$hassPass', '$phone'
                        ,'$address', '$role','$status','$image',now())";
                       
                       $addUser= mysqli_query($db,$sql);
                       if ($addUser) {
                            $_SESSION['stat'] = "User Added Successfully.";
                            header("Location: users.php?do=Manage");
                            exit(0);
                       }
                       else {
                           die("Mysqli Error". mysqli_error($db));
                       }
                    }
                    else{
                        $image = null;
                        $sql = "INSERT INTO users ( fullname, username, email , password, phone, address, role, status,
                        image, joindate ) VALUES ('$fullname', '$username' ,'$email', '$hassPass', '$phone'
                        ,'$address', '$role','$status','$image',now())";
                        $addUser= mysqli_query($db,$sql);
                        if ($addUser) {
                            $_SESSION['stat_wr'] = "User Added Successfully Without Photo.";
                            header("Location: users.php?do=Manage");
                            exit(0);
                        }
                        else {
                            die("Mysqli Error". mysqli_error($db));
                        }
                    }
                }
                else { 
                    $_SESSION['msg'] = "Password Doesn't Match!! Please Try Again";
                    $_SESSION['msg_sts'] = "error";
                    header("Location: users.php?do=Add");
                    exit(0);
                    // $_SESSION['stat_er'] = "Password Doesn't Match";
                    // header("Location: users.php?do=Add");
                    // exit(0);
                }
            }
        }

        // Edit Form 
        else if ($do == 'Edit'){
            if (isset($_GET['id']) ) {
                $updateid = $_GET['id'];
                
                $sql = "SELECT * FROM users WHERE id = '$updateid' ";
                $theUser = mysqli_query($db,$sql);
                while ($row = mysqli_fetch_assoc($theUser)) {
                    $id         = $row['id'];
                    $fullname   = $row['fullname'];
                    $email      = $row['email'];
                    $username   = $row['username'];
                    $password   = $row['password'];
                    $phone      = $row['phone'];
                    $address    = $row['address'];
                    $role       = $row['role'];
                    $status     = $row['status'];
                    $image      = $row['image'];
                    $joindate   = $row['joindate'];
                    ?>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Update User Info</h3>
                            </div>
                            <div class="card-body">
                                <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" class="form-control" autocomplete="off" required="required"
                                                value="<?php echo $fullname; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" autocomplete="off" required="required"
                                                value="<?php echo $username; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" autocomplete="off" required="required"
                                                value="<?php echo $email; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" autocomplete="off" 
                                                placeholder="Change Password or Left blank" >
                                            </div>
                                            <div class="form-group">
                                                <label>Re-Type Password</label>
                                                <input type="password" name="repassword" class="form-control" autocomplete="off" 
                                                placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input type="text" name="phone" class="form-control" autocomplete="off"
                                                value="<?php echo $phone; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off"
                                                value="<?php echo $address; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>User Role</label>
                                                <select name="role" class="form-control">
                                                    <option value="1" <?php if ($role == 1) { echo "selected";} ?> >Super Admin</option>
                                                    <option value="2" <?php if ($role == 2) { echo "selected";} ?> >Editor</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="0" <?php if ($status == 0) { echo "selected";} ?> >In-Active</option>
                                                    <option value="1" <?php if ($status == 1) { echo "selected";} ?> >Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Prifile Picture</label>
                                                <?php 
                                                    if ( !empty($image)) { ?>
                                                        <img src="img/users/<?php echo $image; ?>" width="35">
                                                   <?php }
                                                    else { ?>
                                                        <img src="img/users/default.jpg" width="35">
                                                   <?php }
                                                ?>
                                                <input type="file" name="image" class="form-control-file" >
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="updateUserId" value="<?php echo $id; ?>">
                                                <input type="submit" name="updateUser" class="btn btn-primary" value="Save Changes">
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

        // update userinfo 
        else if ($do == 'Update'){
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                $updateUserId = $_POST['updateUserId'];
                $fullname    = $_POST['fullname'];
                // $username    = $_POST['username'];
                $email       = $_POST['email'];
                $password    = $_POST['password'];
                $repassword  = $_POST['repassword'];
                $phone       = $_POST['phone'];
                $address     = $_POST['address'];
                $role        = $_POST['role'];
                $status      = $_POST['status'];

               
                $image  = $_FILES['image']['name'];
                $imageTmp   = $_FILES['image']['tmp_name'];

                if ( !empty($password) && !empty($image) ) {
                    if($password == $repassword){
                        //Encryption
                        $hassPass=sha1($password);
                    }
                
                    //Change the image name
                      $image = rand(0,50000) . '_' . $image;
                      move_uploaded_file($imageTmp,"img/users/". $image);

                    //   Delete existing image 
                    $query= "SELECT * FROM users WHERE id='$updateUserId' ";
                    $readUserData= mysqli_query($db,$query);
                    while ( $row=mysqli_fetch_assoc($readUserData) ) {
                       $exitingImage = $row['image'];
                    }
                    unlink("img/users/".$exitingImage);

                    // Update SQL 
                      $sql = "UPDATE users SET  fullname='$fullname', email='$email' , password='$hassPass',
                      phone='$phone', address='$address', role='$role', status='$status', image='$image'
                      WHERE id='$updateUserId' ";
                     
                     $addUser= mysqli_query($db,$sql);
                     if ($addUser) {
                        $_SESSION['stat'] = "User Info Updated Successfully";
                        header("Location: users.php?do=Manage");
                        exit(0);
                     }
                     else {
                         die("Mysqli Error". mysqli_error($db));
                     }

                }
                else if(!empty($image) ){
                    $image = rand(0,50000) . '_' . $image;
                      move_uploaded_file($imageTmp,"img/users/". $image);

                    //   Delete existing image 
                    $query= "SELECT * FROM users WHERE id='$updateUserId' ";
                    $readUserData= mysqli_query($db,$query);
                    while ( $row=mysqli_fetch_assoc($readUserData) ) {
                       $exitingImage = $row['image'];
                    }
                    unlink("img/users/".$exitingImage);

                    // Update SQL 
                      $sql = "UPDATE users SET  fullname='$fullname', email='$email' ,
                      phone='$phone', address='$address', role='$role', status='$status', image='$image'
                      WHERE id='$updateUserId' ";
                     
                     $addUser= mysqli_query($db,$sql);
                     if ($addUser) {
                        $_SESSION['stat'] = "User Info Updated Successfully";
                        header("Location: users.php?do=Manage");
                        exit(0);
                     }
                     else {
                         die("Mysqli Error". mysqli_error($db));
                     }
                }
                else if( empty($image) && empty($password ) ){
                    // Update SQL 
                      $sql = "UPDATE users SET  fullname='$fullname', email='$email' ,
                      phone='$phone', address='$address', role='$role', status='$status'
                      WHERE id='$updateUserId' ";
                     
                     $addUser= mysqli_query($db,$sql);
                     if ($addUser) {
                         header("Location: users.php?do=Manage");
                     }
                     else {
                         die("Mysqli Error". mysqli_error($db));
                     }
                }
                else if ( !empty($password) ) {
                    if($password == $repassword){
                        //Encryption
                        $hassPass=sha1($password);
                    }
                    $query= "SELECT * FROM users WHERE id='$updateUserId' ";
                    $readUserData= mysqli_query($db,$query);;

                    // Update SQL 
                      $sql = "UPDATE users SET  fullname='$fullname', email='$email' , password='$hassPass',
                      phone='$phone', address='$address', role='$role', status='$status'
                      WHERE id='$updateUserId' ";
                     
                     $addUser= mysqli_query($db,$sql);
                     if ($addUser) {
                        $_SESSION['stat'] = "User Info Updated Successfully";
                        header("Location: users.php?do=Manage");
                        exit(0);
                     }
                     else {
                        die("Mysqli Error". mysqli_error($db));
                     }
                }
                else{
                    // Update SQL
                      $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', address='$address', 
                      role='$role', status='$status' WHERE id = '$updateUserID'";
        
                      $addUser = mysqli_query($db, $sql);
        
                      if ( $addUser ){
                        $_SESSION['stat'] = "User Info Updated Successfully";
                        header("Location: users.php?do=Manage");
                        exit(0);
                      }
                      else{
                        die( "MySQLi Error. " . mysqli_error($db) );
                      }
                  }
            }
        }

        // Delete
        else if ($do == 'Delete'){
            if (isset($_GET['id'])){
                $deleteUserId=$_GET['id'];

                //   Delete existing image 
                $query= "SELECT * FROM users WHERE id='$deleteUserId' ";
                $readUserData= mysqli_query($db,$query);
                while ( $row=mysqli_fetch_assoc($readUserData) ) {
                   $exitingImage = $row['image'];
                }
                unlink("img/users/".$exitingImage);

                $sql="DELETE FROM users WHERE id='$deleteUserId' ";
                $confirmDelete= mysqli_query($db,$sql);
                     if ($confirmDelete) {
                        $_SESSION['stat'] = "User Deleted Successfully";
                        header("Location: users.php?do=Manage");
                        exit(0);
                     }
                     else {
                         die("Mysqli Error". mysqli_error($db));
                     }
            }
        }
     }
     else {
         header("Location: dashboard.php");
     }

    ?>

  </div>


<?php include('inc/footer.php'); ?>