<?php 
    include "inc/header.php";
?>

    
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Right Sidebar</li>
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
                <!-- Blog Single Posts -->
                <div class="col-md-8">

                <?php
                    if(isset($_GET['post'])){
                        $post_id    = $_GET['post'];
                        $sql = "SELECT * FROM post WHERE id='$post_id' ";
                        $read_post = mysqli_query($db,$sql);
                        while( $row = mysqli_fetch_assoc($read_post) ){
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
      
                          <div class="blog-single">
                              <!-- Blog Title -->
                              <h3 class="post-title"><?php echo $title; ?></h3>
      
                              <!-- Blog Categories -->
                              <div class="single-categories">
                                  <span><?php echo $tags; ?></span>
                              </div>
                              
                              <!-- Blog Thumbnail Image Start -->
                              <div class="blog-banner">
                                  <img src="admin/img/post/<?php echo $image; ?>">
                              </div>
                              <!-- Blog Thumbnail Image End -->
      
                              <!-- Blog Description Start -->
                              <p><?php echo $description; ?></p>
                              <!-- Blog Description End -->
                          </div>
      
                        <?php }
                    
                    }
                ?>

                    
                    <div class="row">
                        <div class="col-md-12">
                                <!-- Post New Comment Section Start -->
                                <?php
                                    if ( !empty($_SESSION['email']) ) { ?>
                                    <div class="post-comments">
                                        <h4>Post Your Comments</h4>
                                        <div class="title-border"></div>
                                        <!-- Form Start -->
                                        <form action="" method="POST" class="contact-form">
                                            <!-- Right Side Start -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Comments Textarea Field -->
                                                    <div class="form-group">
                                                        <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </div>
                                                    <!-- Post Comment Button -->
                                                    <button type="submit" class="btn-main" name="post_comment"><i class="fa fa-paper-plane-o"></i> Post Your Comments</button>
                                                </div>
                                            </div>
                                            <!-- Right Side End -->
                                        </form>
                                        <!-- Form End -->
                                    </div>                           
                                    <?php }

                                    else{ ?>
                                        <a class="cmt" href="register.php"><button type="submit" class="btn-main"><i class="fa fa-paper-plane-o"></i>Please Login/SignUp To Comment</button></a>
                                <?php }
                                ?>

                                <?php
                                    if (isset($_POST['post_comment'])) {
                                        $name       = $_SESSION['name'] ;
                                        $comments   = mysqli_real_escape_string($db,$_POST['comments']);

                                        $post_id       = $post_id;

                                        $sql = "INSERT INTO comments (cmnt_name,comments,post_id,cmnt_status,cmnt_date) VALUES ('$name','$comments','$post_id',0,now())";
                                        
                                        $add_comment = mysqli_query($db,$sql);

                                        if ( $add_comment ) {
                                            header("Location: single.php?post=$post_id");
                                        }
                                        else{
                                            die("System error. Please contact with system administrator.". mysqli_error());
                                        }

                                    }
                                
                                ?>
                                <!-- Post New Comment Section End --> 
                            </div>
                        </div>


                    <!-- Single Comment Section Start -->
                    <div class="single-comments">
                        <!-- Comment Heading Start -->
                        <div class="row">                            
                            <div class="col-md-12">
                                <?php
                                    $sql = "SELECT * FROM comments WHERE post_id='$post_id' AND cmnt_status=1 AND reply_id='0'
                                    ORDER BY cmnt_id DESC";
                                    $read_cmnt   = mysqli_query($db,$sql);
                                    $cmnt_number = mysqli_num_rows($read_cmnt); 
                                ?>
                                <h4>All Latest Comments (<?php echo $cmnt_number;?>)</h4>
                                <div class="title-border"></div>
                            </div>
                        </div>
                        <!-- Comment Heading End -->

                        <?php
                            if( $cmnt_number == 0){
                                echo '<div class="alert alert-warning">No comments posted yet. Be the first one.</div>';
                            }
                            else {
                                while( $row = mysqli_fetch_assoc($read_cmnt)){
                                    $cmnt_id      = $row['cmnt_id'];
                                    $cmnt_name    = $row['cmnt_name'];
                                    $comments     = $row['comments'];
                                    $post_id      = $row['post_id'];
                                    $cmnt_status  = $row['cmnt_status'];
                                    $cmnt_date    = $row['cmnt_date'];
                                    ?>
                          
                                    <!-- Single Comment Post Start -->
                                    <div class="row each-comments">
                                        <div class="col-md-2">
                                            <!-- Commented Person Thumbnail -->
                                            <div class="comments-person">
                                            <?php
                                                $sql = "SELECT * FROM subscriber WHERE name='$cmnt_name' ";
                                                $read_sub   = mysqli_query($db,$sql) ;
                                                while( $row = mysqli_fetch_assoc ($read_sub)){
                                                    $sub_img      = $row['image'];
                                                    if( $sub_img ){ ?>
                                                        <img src="img/<?php echo $sub_img; ?>" alt="">
                                                    <?php }
                                                    else  { ?>
                                                        <img src="img/default.jpg" alt="">
                                                    <?php }                                                   
                                                } 
                                            ?>
                                            </div>
                                        </div>

                                        <div class="col-md-10 no-padding">
                                            <!-- Comment Box Start -->
                                            <div class="comment-box">
                                                <div class="comment-box-header">
                                                    <ul>
                                                        <li class="post-by-name"><?php echo $cmnt_name;?></li>
                                                        <li class="post-by-hour"><?php echo $cmnt_date;?></li>
                                                    </ul>
                                                </div>
                                                <p><?php echo $comments;?></p>

                                                <!-- reply code start  -->
                                                <?php 
                                                    $sql = "SELECT * FROM comments WHERE reply_id='$cmnt_id' ";
                                                    $read_reply   = mysqli_query($db,$sql);
                                                    while( $row = mysqli_fetch_assoc($read_reply)){
                                                        $r_cmnt_id    = $row['cmnt_id'];
                                                        $reply_id     = $row['reply_id'];
                                                        $cmnt_name    = $row['cmnt_name'];
                                                        $comments     = $row['comments'];
                                                        $post_id      = $row['post_id'];
                                                        $cmnt_status  = $row['cmnt_status'];
                                                        $cmnt_date    = $row['cmnt_date']; 
                                                        ?>

                                                        <!-- Comment Reply Post Start -->
                                                        <div class="row each-comments">
                                                            <div class="col-md-2 offset-md-2">
                                                                <div class="comments-person">
                                                                    <?php
                                                                        $sql_r = "SELECT * FROM subscriber WHERE name='$cmnt_name' ";
                                                                        $read_sub_r   = mysqli_query($db,$sql_r) ;
                                                                        while( $row = mysqli_fetch_assoc ($read_sub_r)){
                                                                            $sub_img_r      = $row['image'];
                                                                            if( !empty($sub_img_r) ){ ?>
                                                                                <img src="img/<?php echo $sub_img_r; ?>" alt="">
                                                                            <?php }
                                                                            else { ?>
                                                                                <img src="img/default.jpg" alt="">
                                                                            <?php }                                                   
                                                                        }
                                                                    ?>
                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="col-md-8 no-padding">
                                                                <div class="comment-box">
                                                                    <div class="comment-box-header">
                                                                        <ul>
                                                                            <li class="post-by-name"><?php echo $cmnt_name; ?></li>
                                                                            <li class="post-by-hour"><?php echo $cmnt_date; ?></li>
                                                                        </ul> 
                                                                    </div>
                                                                    <p><?php echo $comments; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                ?>
                                                <!-- reply code end  -->
                                         
                                            </div>

                                            <!-- reply button  -->
                                            <?php
                                                if(!empty($_SESSION['email'])){ ?>
                                                    <form action="" method="POST" class="contact-form">
                                                        <!-- Right Side Start -->
                                                        <div class="row">
                                                            <div class="col-md-11 offset-md-1">
                                                                    <!-- Comments Textarea Field -->
                                                                <p>
                                                                    <a href="" data-toggle="collapse" data-target="#collapseExample<?php echo $cmnt_id;?>" aria-expanded="false" aria-controls="collapseExample">
                                                                    <i class="fa fa-comments"></i> Reply
                                                                    </a>
                                                                </p>
                                                                <div class="collapse" id="collapseExample<?php echo $cmnt_id;?>">
                                                                    <div class="card card-body">
                                                                    <!-- <i class="fa fa-pencil-square-o"></i> -->
                                                                    <textarea name="comments" class="form-input" placeholder="Your Reply Here..."></textarea>
                                                                     <!-- Post reply Button -->
                                                                     <input type="hidden" name="reply_id" value="<?php echo $cmnt_id; ?>">
                                                                    <button type="submit" class="btn-main" name="replyPostComment"><i class="fa fa-paper-plane-o"></i> Post Your Reply</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Right Side End -->
                                                    </form>
                                                <?php }
                                                else { ?>
                                                    <a class="cmt" href="register.php"><button type="submit" class="btn-main"><i class="fa fa-paper-plane-o"></i>Please Login/SignUp To reply</button></a>
                                                <?php }
                                            ?>
                                            <!-- reply button  -->

                                            
                                            <!-- Comment Box End -->
                                        </div>
                                    </div>
                                    <!-- Single Comment Post End -->
                                <?php }
                            }
                        ?>

                        <?php
                             if (isset($_POST['replyPostComment'])) {
                                $r_name         = $_SESSION['name'] ;
                                 $r_comments    = mysqli_real_escape_string($db,$_POST['comments']);

                                 $r_post_id     = $post_id;
                                 $r_id          = $_POST['reply_id'];

                                 $r_sql = "INSERT INTO comments (reply_id,cmnt_name,comments,post_id,cmnt_status,cmnt_date) VALUES ('$r_id','$r_name','$r_comments','$r_post_id',1,now())";
                                 $add_reply = mysqli_query($db,$r_sql);

                                 if ( $add_reply ) {
                                    header("Location: single.php?post=$post_id");
                                 }
                                 else{
                                    die("System error. Please contact with syadministrator.". mysqli_error());
                                }
                            }                
                        ?>


                    </div>
                    <!-- Single Comment Section End -->
             
                </div>

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