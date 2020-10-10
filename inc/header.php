<?php 
  ob_start();
  include "admin/inc/db.php";
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Website Description -->
    <meta name="description" content="Blue Chip: Corporate Multi Purpose Business Template" />
    <meta name="author" content="Blue Chip" />

    <!--  Favicons / Title Bar Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon/favicon.png" />

    <title>Blue Chip | Blog Right Sidebar</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">

    <!-- Flat Icon CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/flaticon.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.min.css">

    <!-- Fency Box CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/toastr.min.css">

    <!-- Theme Main Style CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>

  <body>
    
    <!-- :::::::::: Header Section Start :::::::: -->
    <header>
        <div class="bg-nav">
            <div class="top-menu">
                <div class="container">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="index.php">Blog</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                  <?php 
                                    $sql="SELECT * FROM category WHERE cat_status=1 ORDER BY cat_name ASC";
                                    $all_menu=mysqli_query($db,$sql);
                                    while( $row = mysqli_fetch_assoc($all_menu) ){
                                      $cat_id     =$row['cat_id'];
                                      $cat_name   =$row['cat_name'];
                                      ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="category.php?id=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a>
                                        </li>
                                    <?php }
                                  ?>

                                  <?php 
                                    if ( !empty($_SESSION['sub_id']) ) { ?>
                                        <li class="nav-item">
                                         
                                          <a class="nav-link" href="logout.php">Logout
                                          <?php
                                            if (!empty($_SESSION['image'])) { ?>
                                              <img src="img/<?php echo $_SESSION['image']; ?>" width="30">
                                            <?php } else { ?>
                                              <img src="img/default.jpg" width="35">
                                            <?php }
                                          ?>
                                          </a>
                                        </li>
                                        <li class="nav-item">
                                          <a href="" class="nav-link">
                                              <?php
                                                if (!empty($_SESSION['name'])){ ?>
                                                  <?php echo $_SESSION['name']; ?>
                                               <?php }
                                              ?>
                                          </a>
                                        </li>
                                        <?php }

                                    else { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="register.php">Login/SignUp</a>
                                        </li>
                                   <?php }
                                  
                                  ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- ::::::::::: Header Section End ::::::::: -->