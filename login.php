<?php 
  ob_start();
  include "admin/inc/db.php";
  session_start();
?>

<?php
    if (isset($_POST['signin'])) {
        $email      =$_POST['email'];
        $password   =$_POST['password'];

        $hassedpass = sha1($password);

         // Find User from db
         $sql = "SELECT * FROM subscriber WHERE email='$email' ";
         $user = mysqli_query($db,$sql);

         while($row = mysqli_fetch_array($user)){
            $_SESSION['sub_id']     = $row['sub_id'];
            $_SESSION['name']       = $row['name'];
            $_SESSION['email']      = $row['email'];
            $_SESSION['password']   = $row['password'];
            $_SESSION['phone']      = $row['phone'];
            $_SESSION['joindate']   = $row['joindate'];
            $_SESSION['image']      = $row['image'];

            if( $email == $_SESSION['email'] && $hassedPass == $_SESSION['password'] ){ 
                header("Location: index.php");
            }
            else if( $email != $_SESSION['email'] || $hassedPass != $_SESSION['password'] ){
                header("Location: index.php");
            }
            else {
             header("Location: index.php");
            }
         }

    }
?>


<?php
    ob_end_flush();
?>