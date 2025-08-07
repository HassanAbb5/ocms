<?php
  include '../conns/css-links.php';
  include '../database/db_conn.php';
  session_start();
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_styles.css">
    <style type="text/css">
      @font-face{ font-family: thefont; src: url(../fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: thefont-g; src: url(../fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: 1s;}
      .icon-img{max-width: 10%; height: auto; border-radius: 3px; border:1px solid rgba(0,0,0, 0.5); position: absolute; bottom: 0rem; right: 1%;}
      tr{text-align:left; display: flex; justify-content:; margin-bottom: 1rem;}
      td{font-size: 115%; margin-right: 2rem;}
      tr.response{display: flex; justify-content: flex-end;}
      .fname,.lname{text-transform: capitalize;}
      .display-pic{width: 20%; max-height: 11.5rem; border-radius: 5%; }

      
   
     
    </style>
    <title>Admin Profile Update Page</title>
</head>
<body>

<?php 
//make sql query
    $sql = "SELECT * FROM admin WHERE admin_id = ".$_SESSION['admin_id']." ";

    //get the query results
    $result = mysqli_query($db_conn, $sql);

    //fetch result in array format
    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($db_conn);
 ?>
  
 <?php include 'side_nav.php'; ?>

 <?php 
  $page="view_user";

  if (isset($_GET['user_id'])) {

    $user_id =  $_GET['user_id'];

    //make sql query
    $sql_for_user = "SELECT * FROM users WHERE id = '$user_id' ";

    //get the query results
    $result_for_user = mysqli_query($db_conn, $sql_for_user);
    //fetch result in array format
    $user_row = mysqli_fetch_assoc($result_for_user);

    //mysqli_free_result($result_for_user);
    //mysqli_close($db_conn);

  }

  ?>


   <?php 
   /*
   //Code to block user
    if(isset($_GET['block'])){

        $id_to_block = $_GET['block'];
        $sql_block = "UPDATE users SET blocked = '1' WHERE id = '$id_to_block' ";
        //$query = "UPDATE stud_register SET status='no' WHERE id='$id'";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_block)) {
          //success
          header('Location: view_user.php?user_id=<?php echo $user_row["id"]; ?>');
        ?>
        <script type="text/javascript">
          alert('User has been Blocked');
          location.href="view_user.php?user_id=<?php echo $user_row['id']; ?>";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end get
    */
    if (isset($_POST['block'])) {
    
    $id_to_block = mysqli_real_escape_string($db_conn, $_POST['id_to_block']);

    $sql_block = "UPDATE users SET blocked = '1' WHERE id = '$id_to_block' ";
        //$query = "UPDATE stud_register SET status='no' WHERE id='$id'";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_block)) {
          //success
          //header('Location: view_user.php?user_id= echo $user_row["id"]; ');
        ?>
        <script type="text/javascript">
          alert('User has been Blocked');
          location.href="view_user.php?user_id=<?php echo $user_row['id']; ?>";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end isset post check
     
    ?>

    <?php 
    /*
   //Code to block user
    if(isset($_GET['unblock'])){

        $id_to_unblock = $_GET['unblock'];
        $sql_unblock = "UPDATE users SET blocked = '0' WHERE id = '$id_to_unblock' ";
        //$query = "UPDATE stud_register SET status='no' WHERE id='$id'";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_unblock)) {
          //success
          header('Location: view_user.php?user_id=<?php echo $user_row["id"]; ?>');
        ?>
        <script type="text/javascript">
          alert('User has been UnBlocked');
          location.href="view_user.php?user_id=<?php echo $user_row['id']; ?>";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end get
    */
    if (isset($_POST['unblock'])) {
    
    $id_to_unblock = mysqli_real_escape_string($db_conn, $_POST['id_to_unblock']);

    $sql_unblock = "UPDATE users SET blocked = '0' WHERE id = '$id_to_unblock' ";
        //$query = "UPDATE stud_register SET status='no' WHERE id='$id'";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_unblock)) {
          //success
      //header('Location: view_user.php?user_id= echo $user_row["id"]; ');
        ?>
        <script type="text/javascript">
          alert('User has been UnBlocked');
          location.href="view_user.php?user_id=<?php echo $user_row['id']; ?>";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end isset post check

     
    ?>


  <div class="main-content">

    

    <div class="card mx-4 wow fadeInRight p-5 border-0 rounded shadow-sm">
      <div>
        <a href="all_users.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">User Details</h2>
      </div>
     
      
        <table>
          
          <tr>
            <td>User Id:</td>
            <td><?php echo $user_row['id']; ?></td>
          </tr>
          <tr class="mb-1">
            <td class="">Profile Photo:</td>
          </tr>
          <tr>           
            <td>
              <img src="../<?php echo $user_row['pic_location']; ?>"  alt="User Profile Photo" class="display-pic d-block border" >
            </td>
          </tr>
          <tr>
            <td>User Full Name:</td>
            <td class="fname"><?php echo $user_row['firstname']; ?></td>
            <td class="lname"><?php echo $user_row['lastname']; ?></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td><?php echo $user_row['email']; ?></td>
          </tr>
          <tr>
            <td>Username:</td>
            <td><?php echo $user_row['username']; ?></td>
          </tr>
          <?php if ($user_row['blocked'] == '0'): ?>  
          <tr>
            <td>
              Block Status:
            </td>
            <td class="text-success">
              User not Blocked
            </td>
          </tr>      
          <tr>          
            <td>
              <!--<a href="view_user.php?block=<?php //echo $user_row['id']; ?> "  title="Block User" class="btn btn-danger bi bi-person-x"> &nbsp;Block User</a>-->
              <form  method="POST" action="">
                <input type="hidden" name="id_to_block" value="<?php echo $user_row['id']; ?>">
                <button type="submit" name="block" class="btn btn-danger bi bi-person-x">&nbsp;Block User</button>
              </form>
            </td>
          </tr>
          <?php else: ?>
          <tr>
            <td>
              Block Status:
            </td>
            <td class="text-danger">
              User Blocked
            </td>
          </tr>
          <tr>
            <td>
              <!--<a href="view_user.php?unblock=<?php //echo $user_row['id']; ?> "  title="UnBlock User" class="btn btn-primary bi bi-person-check"> &nbsp;UnBlock User</a>-->
              <form  method="POST" action="">
                <input type="hidden" name="id_to_unblock" value="<?php echo $user_row['id']; ?>">
                <button type="submit" name="unblock" class="btn btn-primary bi bi-person-check">&nbsp;UnBlock User</button>
              </form>
            </td>
          </tr>
          <?php endif ?>
          


        </table>
       

    </div>

  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>