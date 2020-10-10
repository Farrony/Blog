<?php 
    include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Login/Register Yourself</h2>
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Single Posts -->
                <div class="col-md-8">  
                    <?php
                        if(isset($_GET['Success'])==true){
                            echo '<div class="btn btn-success">Registration Successfully Done. You Can Login Now.</div>';
                        }
                    ?>  
                    <div class="pb-4"></div>                  
                    <div class="widget" id="login">
                        <h4>Login</h4>
                        <div class="title-border"></div>
                        <!-- Meta Tag List Start -->
                        <div class="meta-tags">
                            <form action="login.php" method="POST" class="contact-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn-main" value="Sign In" name="signin">
                                </div>
                            </form>
                        </div> 
                    </div>

                    <div class="widget" id="register">
                        <h4>Register</h4>
                        <div class="title-border"></div>
                        <!-- Meta Tag List Start -->
                        <div class="meta-tags">
                            <form action="register.php?do=Insert" method="POST" class="contact-form" enctype="multipart/form-data">
                                 <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" placeholder="Phone" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="repassword" placeholder="Retype Password" class="form-input" autocomplete="off" required="required">
                                    <i class="fa fa-key"></i>
                                </div>
                                <div class="form-group">
                                    <label>Prifile Picture</label>
                                    <input type="file" name="image" class="form-control-file" >
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn-main" value="Sign Up" name="signup">
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>

                 <?php
                    $do= isset($_GET['do']) ? $_GET['do'] : 'Insert';
                    
                    // Insert 
                    if ( $do == 'Insert') {
                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $name        = $_POST['name'];
                            $email       = $_POST['email'];
                            $password    = $_POST['password'];
                            $repassword  = $_POST['repassword'];
                            $phone       = $_POST['phone'];
            
                           
                            $image  = $_FILES['image']['name'];
                            $imageTmp   = $_FILES['image']['tmp_name'];
            
                            if( $password == $repassword ){
                                //Encryption
                                $hassPass=sha1($password);
            
                                if ( !empty($image) ) {
                                      //Change the image name
                                    $image = rand(0,50000) . '_' . $image;
                                    move_uploaded_file($imageTmp,"img/". $image);
            
                                    $sql = "INSERT INTO subscriber ( name, email , password, phone,
                                    image, join_date ) VALUES ('$name' ,'$email', '$hassPass', '$phone'
                                    ,'$image',now())";
                                   
                                   $addUser= mysqli_query($db,$sql);
                                   if ($addUser) {
                                        header("Location: register.php?Success=1"); 
                                    }
                                   else {
                                       die("Mysqli Error". mysqli_error($db));
                                   }
                                }
                                else{
                                    $sql = "INSERT INTO subscriber ( name, email , password, phone,
                                    image, join_date ) VALUES ('$name' ,'$email', '$hassPass', '$phone'
                                    ,'$image',now())";
                                    $addUser= mysqli_query($db,$sql);
                                    if ($addUser) {
                                        header("Location: register.php?Success=1"); 
                                    }
                                    else {
                                        die("Mysqli Error". mysqli_error($db));
                                    }
                                }
                            }
                            else { ?>
                                <div class="btn btn-danger">Password Doesn't Match</div>
                            <?php }
                        }
                    }

                 ?>


                <!-- Blog Right Sidebar -->
                <?php
                    include "inc/sidebar.php";
                ?>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    




    <?php 
     include "inc/footer.php";
    ?>