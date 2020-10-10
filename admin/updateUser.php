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
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Update User Info</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $authId = $_SESSION['id'];
                            $sql = "SELECT * FROM users WHERE id='$authId' ";
                            $userData = mysqli_query($db, $sql);

                            while ($row = mysqli_fetch_array($userData)) {
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

                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="fullname" class="form-control" autocomplete="off" value="<?php echo $fullname; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" autocomplete="off" value="<?php echo $username; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" autocomplete="off"  value="<?php echo $email; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Change Password or Left blank">
                                            </div>
                                            <div class="form-group">
                                                <label>Re-Type Password</label>
                                                <input type="password" name="repassword" class="form-control"  placeholder="Repeat Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input type="text" name="phone" class="form-control" autocomplete="off" value="<?php echo $phone; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off" value="<?php echo $address; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>User Role</label>
                                                <select name="role" class="form-control" disabled>
                                                    <option value="1" <?php if ($role == 1) {
                                                                            echo "selected";
                                                                        } ?>>Super Admin</option>
                                                    <option value="2" <?php if ($role == 2) {
                                                                            echo "selected";
                                                                        } ?>>Editor</option>
                                                                        
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" disabled>
                                                    <option value="0" <?php if ($status == 0) {
                                                                            echo "selected";
                                                                        } ?>>In-Active</option>
                                                    <option value="1" <?php if ($status == 1) {
                                                                            echo "selected";
                                                                        } ?>>Active</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Prifile Picture</label>
                                                <?php
                                                if (!empty($image)) { ?>
                                                    <img src="img/users/<?php echo $image; ?>" width="35">
                                                <?php } else { ?>
                                                    <img src="img/users/default.jpg" width="35">
                                                <?php }
                                                ?>
                                                <input type="file" name="image" class="form-control-file">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="updateUser" class="btn btn-primary" value="Save Changes">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php }

                            ?>

                            <?php 
                                if(isset($_POST['updateUser'])){
                                    $updateUserId    = $_SESSION['id'];
                                    $fullname        = $_POST['fullname'];
                                    $phone           = $_POST['phone'];
                                    $password        = $_POST['password'];
                                    $repassword      = $_POST['repassword'];
                                    $address         = $_POST['address'];

                                    $image  = $_FILES['image']['name'];
                                    $imageTmp   = $_FILES['image']['tmp_name'];

                                    if( !empty($password) && !empty($image) ){
                                        //Encryption
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
                                            $sql = "UPDATE users SET  fullname='$fullname',  password='$hassPass',
                                            phone='$phone', address='$address', image='$image'
                                            WHERE id='$updateUserId' ";
                                            // echo $sql;
                                           
                                           $addUser= mysqli_query($db,$sql);
                                           if ($addUser) {
                                               $_SESSION['stat'] = "Profile Updated";
                                               header("Location: myProfile.php");
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
                                          phone='$phone', address='$address', image='$image'
                                          WHERE id='$updateUserId' ";
                                         
                                         $addUser= mysqli_query($db,$sql);
                                         if ($addUser) {
                                            $_SESSION['stat'] = "Profile Updated";
                                            header("Location: myProfile.php");
                                            exit(0);
                                         }
                                         else {
                                            die("Mysqli Error". mysqli_error($db));
                                         }
                                    }
                                    else {
                                        $sql = "UPDATE users SET  fullname='$fullname', 
                                        phone='$phone', address='$address'
                                        WHERE id='$updateUserId' ";
                                       
                                       $addUser= mysqli_query($db,$sql);
                                       if ($addUser) {
                                           $_SESSION['stat'] = "Profile Updated";
                                           header("Location: myprofile.php");
                                           exit(0);
                                       }
                                       else {
                                           die("Mysqli Error". mysqli_error($db));
                                       }
                                    }
                                }
                                
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Body Content End -->



</div>


<?php include('inc/footer.php'); ?>