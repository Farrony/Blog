                <!-- Blog Right Sidebar -->
                <div class="col-md-4">

                    <!-- Latest News -->
                    <div class="widget">
                        <h4>Latest News</h4>
                        <div class="title-border"></div>

                        <!-- Sidebar Latest News Slider Start -->
                        <div class="sidebar-latest-news owl-carousel owl-theme">

                            <?php
                                $sql = "SELECT * FROM post ORDER BY id DESC LIMIT 3";
                                $latest_post = mysqli_query($db,$sql);

                                while( $row = mysqli_fetch_assoc($latest_post) ){
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
                            <!-- First Latest News Start -->
                            <div class="item">
                                <div class="latest-news">
                                    <!-- Latest News Slider Image -->
                                    <div class="latest-news-image">
                                        <a href="single.php?post=<?php echo $post_id; ?>">
                                            <img src="admin/img/post/<?php echo $image; ?>">
                                        </a>
                                    </div>
                                    <!-- Latest News Slider Heading -->
                                    <h5><?php echo $title; ?></h5>
                                    <!-- Latest News Slider Paragraph -->
                                    <p><?php echo substr($description,0,100); ?></p>
                                </div>
                            </div>
                            <!-- First Latest News End -->
                            <?php }
                            ?>
                        </div>
                        <!-- Sidebar Latest News Slider End -->
                    </div>


                    <!-- Search Bar Start -->
                    <div class="widget">
                        <!-- Search Bar -->
                        <h4>Blog Search</h4>
                        <div class="title-border"></div>
                        <div class="search-bar">
                            <!-- Search Form Start -->
                            <form action="search.php" method="POST">
                                <div class="form-group">
                                    <input type="text" name="search" placeholder="Search Here" autocomplete="off"
                                        class="form-input">
                                    <i class="fa fa-paper-plane-o"></i>
                                </div>
                            </form>
                            <!-- Search Form End -->
                        </div>
                    </div>
                    <!-- Search Bar End -->

                    <!-- Recent Post -->
                    <div class="widget">
                        <h4>Recent Posts</h4>
                        <div class="title-border"></div>
                        <div class="recent-post">
                            <?php
                            $sql = "SELECT * FROM post ORDER BY id DESC LIMIT 4";
                            $result = mysqli_query($db,$sql);

                            while( $row = mysqli_fetch_assoc($result) ){
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
                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                        <a href="single.php?post=<?php echo $post_id; ?>">
                                            <img src="admin/img/post/<?php echo $image; ?>">
                                        </a>
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <h5><?php echo $title; ?></h5>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i><?php echo $post_date; ?></li>
                                            <li><i class="fa fa-comment-o"></i>15</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Recent Post Item Content End -->
                            <?php }
                        ?>
                        </div>
                    </div>

                    <!-- All Category -->
                    <div class="widget">
                        <h4>Blog Categories</h4>
                        <div class="title-border"></div>
                        <!-- Blog Category Start -->
                        <div class="blog-categories">
                            <ul>
                                <?php
                            $sql = "SELECT * FROM category ORDER BY cat_id DESC";
                            $all_category = mysqli_query($db,$sql);

                            while ( $row = mysqli_fetch_assoc($all_category) ){
                                $cat_id     = $row['cat_id'];
                                $cat_name   = $row['cat_name'];
                                $cat_desc   = $row['cat_desc'];
                                $cat_status = $row['cat_status'];

                                $count = 0;
                                $query = "SELECT * FROM post WHERE cat_id='$cat_id' ";
                                $count_post=mysqli_query($db,$query);
                                while ( $row = mysqli_fetch_assoc($count_post) ) {
                                    $count++;
                                } ?>


                                <!-- Category Item -->
                                <li>
                                    <i class="fa fa-check"></i>
                                    <a href="category.php?id=<?php echo $cat_id; ?>"> <?php echo $cat_name; ?> </a>
                                    <span>[<?php echo $count; ?>]</span>
                                </li>
                                <!-- Category Item -->

                                <?php }
                        ?>
                            </ul>
                        </div>
                        <!-- Blog Category End -->
                    </div>

                    <!-- Recent Comments -->
                    <div class="widget">
                        <h4>Recent Comments</h4>
                        <div class="title-border"></div>
                        <div class="recent-comments">

                            <!-- Recent Comments Item Start -->
                            <div class="recent-comments-item">
                                <div class="row">
                                <?php
                                    $sql = "SELECT * FROM comments ORDER BY cmnt_id desc LIMIT 3";
                                    $all_comments = mysqli_query($db,$sql);
                                    while ($row = mysqli_fetch_assoc($all_comments)) {
                                        $cmnt_id      = $row['cmnt_id'];
                                        $cmnt_name    = $row['cmnt_name'];
                                        $comments     = $row['comments'];
                                        $post_id      = $row['post_id'];
                                        $cmnt_status  = $row['cmnt_status'];
                                        $cmnt_date    = $row['cmnt_date'];
                                        ?>
                                          <!-- Comments Thumbnails -->
                                        <div class="col-md-4">
                                            <i class="fa fa-comments-o"></i>
                                        </div>
                                        <!-- Comments Content -->
                                        <div class="col-md-8 no-padding">
                                            <a href="single.php?post=<?php echo $post_id;?>"><h5><?php echo substr($comments ,0 ,40);?>....</h5></a>
                                            <!-- Comments Date -->
                                            <ul>
                                                <li>
                                                    <i class="fa fa-clock-o"></i><?php echo $cmnt_date;?>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php }
                                
                                ?>
                                </div>
                            </div>
                            <!-- Recent Comments Item End -->
                        </div>
                    </div>

                    <!-- Meta Tag -->
                    <div class="widget">
                        <h4>Tags</h4>
                        <div class="title-border"></div>
                        <!-- Meta Tag List Start -->
                        <div class="meta-tags">
                            <?php
                                $sql = "SELECT * FROM post";
                                $all_post = mysqli_query($db,$sql);
     
                                while( $row = mysqli_fetch_assoc($all_post) ){
                                    $post_id       = $row['id'];
                                    $tags          = $row['tags'];
                                    ?>

                            <a href="tags.php?post=<?php echo $post_id; ?>"> <span><?php echo $tags; ?></span> </a>

                            <?php }
                            ?>
                        </div>
                        <!-- Meta Tag List End -->
                    </div>

                     <!-- Login Form-->
                   

                </div>
                <!-- Right Sidebar End -->