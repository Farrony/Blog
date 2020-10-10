<?php 
    include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Blog</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
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
                <!-- Blog Posts Start -->
                <div class="col-md-8">
                    <?php
                        if( isset($_GET['id']) ){
                            $categoryId=    $_GET['id'];
                            $sql = "SELECT * FROM post WHERE cat_id='$categoryId' AND status=1 ORDER BY id DESC" ;

                            $read_category_post = mysqli_query($db,$sql);
                            $total_cat     = mysqli_num_rows($read_category_post);
                            if($total_cat == 0){ ?>
                                <div class="alert alert-warning">
                                    Opps !!! No Blog Post Found In This Category.
                                </div>
                           <?php }
                           else {
                               while( $row = mysqli_fetch_assoc( $read_category_post)){
                                $post_id       = $row['id'];
                                $title         = $row['title'];
                                $description   = $row['description'];
                                $cat_id        = $row['cat_id'];
                                $auth_id       = $row['auth_id'];
                                $status        = $row['status'];
                                $tags          = $row['tags'];
                                $image         = $row['image'];
                                $post_date     = $row['post_date'];
                                ?>
                                <!-- Single Item Blog Post Start -->
                                <div class="blog-post">
                                    <!-- Blog Banner Image --> 
                                    <div class="blog-banner">
                                        <a href="#">
                                            <img src="admin/img/post/<?php echo $image; ?>">
                                            <!-- Post Category Names -->
                                            <div class="blog-category-name">
                                            <?php 
                                                $sql = "SELECT * FROM category WHERE cat_id='$cat_id' ";
                                                $category_detais = mysqli_query($db,$sql);
                                                while ( $row = mysqli_fetch_assoc($category_detais)) {
                                                    $cat_id = $row['cat_id'];
                                                    $cat_name = $row['cat_name'];
                                                    ?>
                                                        <h6><?php echo $cat_name; ?></h6>
                                                    <?php 
                                                }
                                            ?>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- Blog Title and Description -->
                                    <div class="blog-description">
                                        <a href="single.php?post=<?php echo $post_id; ?>">
                                            <h3 class="post-title"><?php echo $title; ?></h3>
                                        </a>
                                        <p><?php echo substr($description ,0 ,275); ?></p>
                                        <!-- Blog Info, Date and Author -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="blog-info">
                                                    <ul>
                                                        <li><i class="fa fa-calendar"></i><?php echo $post_date; ?></li>
                                                        <li><i class="fa fa-user"></i>
                                                        <?php 
                                                            $sql = "SELECT * FROM users WHERE id='$auth_id' ";
                                                            $post_user = mysqli_query($db,$sql);
                                                            while ( $row = mysqli_fetch_assoc($post_user)) {
                                                                $uid    = $row['id'];
                                                                $uname  = $row['fullname'];
                                                                ?>
                                                                    by - <?php echo $uname; ?>
                                                                <?php 
                                                            }
                                                        ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="col-md-4 read-more-btn">
                                                <a href="single.php?post=<?php echo $post_id;?>"><button type="button" class="btn-main"><i class="fa fa-angle-double-right"></i>Read More</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Item Blog Post End --> 
                               <?php }
                           }
                        }
                    ?>         
                </div>

                <?php
                    include "inc/sidebar.php";
                ?>
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
    


<?php 
    include "inc/footer.php";
?>