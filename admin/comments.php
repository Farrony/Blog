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
            <h1 class="m-0 text-dark">Manage All Comments</h1>
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

    <?php
      $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

      if (  $do == 'Manage' ) { ?>
          <!-- Body Content Start -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">

                  <!-- Card Design Start -->
                  <div class="card card-primary card-outline">
                    <div class="card-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#Sl.</th>
                          <th scope="col">Subscriber</th>
                          <th scope="col">Comments</th>
                          <th scope="col">Post Title</th>
                          <th scope="col">Status</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql = "SELECT * FROM comments WHERE reply_id=0 ORDER BY cmnt_id desc";
                          $all_comments = mysqli_query($db,$sql);
                          $i=0;

                          while ($row = mysqli_fetch_assoc($all_comments)) {
                              $cmnt_id      = $row['cmnt_id'];
                              $cmnt_name    = $row['cmnt_name'];
                              $comments     = $row['comments'];
                              $post_id      = $row['post_id'];
                              $cmnt_status  = $row['cmnt_status'];
                              $cmnt_date    = $row['cmnt_date'];
                              $i++;
                              ?>

                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <td><?php echo $cmnt_name; ?></td>
                              <td><?php echo $comments; ?></td>
                              <td>
                                <?php
                                  $sql = "SELECT * FROM post WHERE id= '$post_id' ";
                                  $read_title = mysqli_query($db,$sql);
                                  while ($row = mysqli_fetch_assoc($read_title)) {
                                    $title      = $row['title'];
                                  }
                                  echo $title;
                                ?>
                              </td>
                              <td>
                                <?php 
                                  if( $cmnt_status == 0){ ?>
                                    <span class="badge badge-warning">Pending</span>
                                  <?php }
                                  else if ( $cmnt_status == 1 ) { ?>
                                    <span class="badge badge-success">Approved</span>
                                  <?php }
                                  else if ( $cmnt_status == 2 ) { ?>
                                    <span class="badge badge-danger">Suspended</span>
                                  <?php }
                                ?>
                              </td>
                              <td><?php echo $cmnt_date; ?></td>
                              <td>
                                  <div class="action-bar">
                                    <ul>
                                        <li><a href="comments.php?do=Edit&id=<?php echo $cmnt_id; ?>"><i class="fa fa-edit"></i></a></li>
                                        <li><a href="" data-toggle="modal" data-target="#delete<?php echo $cmnt_id; ?>">
                                        <i class="fa fa-trash"></i></a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="delete<?php echo $cmnt_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this Comment?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body text-center">

                                            <div class="modal-confirmation">
                                                <ul>
                                                <li>
                                                    <a href="comments.php?do=Delete&id=<?php echo $cmnt_id; ?>" class="btn btn-danger">Confirm</a>
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

                          <?php  }
                        
                        ?>
                      </tbody>
                    </table>
                    </div>
                  </div><!-- /.card -->
                  <!-- Card Design End -->

                </div>
              </div>
            </div>
          </section>
          <!-- Body Content End -->
      <?php }


      else if( $do == 'Edit'  ){
        if (isset($_GET['id'])) {
          $update_cmnt_id  = $_GET['id'];
          $sql = "SELECT * FROM comments WHERE cmnt_id='$update_cmnt_id' ";
          $read_cmt = mysqli_query($db,$sql);

          while ( $row = mysqli_fetch_array($read_cmt)){
            $cmnt_id      = $row['cmnt_id'];
            $cmnt_name    = $row['cmnt_name'];
            $comments     = $row['comments'];
            $post_id      = $row['post_id'];
            $cmnt_status  = $row['cmnt_status'];
            $cmnt_date    = $row['cmnt_date'];
            ?>

              <section class="content">
                <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Update Comment Status</h3>
                            </div>
                            <div class="card-body">
                                <form action="comments.php?do=Update" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Subscriber Name</label>
                                                <input type="text" name="cmnt_name" class="form-control"
                                                value="<?php echo $cmnt_name; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Comments</label>
                                                <textarea type="text" name="comments" class="form-control"   autocomplete="off"
                                                rows="4" disabled><?php echo $comments;?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Post Title</label>
                                                <input type="text" name="post_title" class="form-control" 
                                                value="<?php
                                                  $sql = "SELECT * FROM post WHERE id= '$post_id' ";
                                                  $read_title = mysqli_query($db,$sql);
                                                  while ($row = mysqli_fetch_assoc($read_title)) {
                                                    $title      = $row['title'];
                                                  }
                                                  echo $title;
                                                ?>"disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Comment Date</label>
                                                <input type="text" name="cmnt_date" class="form-control"
                                                value="<?php echo $cmnt_date; ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Comment Status</label>
                                                <select name="cmnt_status" class="form-control">
                                                    <option value="0" <?php if ($cmnt_status == 0) { echo "selected";} ?> >Pending</option>
                                                    <option value="1" <?php if ($cmnt_status == 1) { echo "selected";} ?> >Approved</option>
                                                    <option value="2" <?php if ($cmnt_status == 2) { echo "selected";} ?> >Suspended</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="update_cmnt_id" value="<?php echo $cmnt_id; ?>">
                                                <input type="submit" name="updateComment" class="btn btn-primary" value="Save Changes">
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

      
      else if( $do == 'Update'  ){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
          $update_cmnt_id     = $_POST['update_cmnt_id'];
          $update_cmnt_status = $_POST['cmnt_status'];
          
          $sql = "UPDATE comments SET cmnt_status='$update_cmnt_status' WHERE cmnt_id='$update_cmnt_id' ";
          $update_status = mysqli_query($db,$sql);

          if ( $update_status) {
            $_SESSION['stat'] = "Comment Status Updated.";
            header("Location: comments.php?do=Manage");
            exit(0);
          }
          else {
            die("Mysqli Error". mysqli_error($db));
          }
        }
      }

       // Delete
       else if ($do == 'Delete'){
        if (isset($_GET['id'])){
            $deleteCmntId=$_GET['id'];

            $sql="DELETE FROM comments WHERE cmnt_id='$deleteCmntId' ";
            $confirmDelete= mysqli_query($db,$sql);
                 if ($confirmDelete) {
                  $_SESSION['stat'] = "Comment Deleted";
                  header("Location: comments.php?do=Manage");
                  exit(0);
                 }
                 else {
                     die("Mysqli Error". mysqli_error($db));
                 }
        }
    }
      
    ?>

  </div>


<?php include('inc/footer.php'); ?>