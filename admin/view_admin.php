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
  $page="view_admin";

  if (isset($_GET['admin_id'])) {

    $admin_id =  $_GET['admin_id'];

    //make sql query
    $sql_for_admin = "SELECT * FROM admin WHERE admin_id = '$admin_id' ";

    //get the query results
    $result_for_admin = mysqli_query($db_conn, $sql_for_admin);
    //fetch result in array format
    $admin_row = mysqli_fetch_assoc($result_for_admin);

    //mysqli_free_result($result_for_user);
    //mysqli_close($db_conn);

  }

  ?>
   


  <div class="main-content">

    

    <div class="card mx-4 p-5 border-0 rounded shadow-sm">
      <div>
        <a href="all_admins.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">Admin Details</h2>
      </div>
      
        <table>
          
          <tr class="wow fadeInRight">
            <td>Admin Id:</td>
            <td><?php echo $admin_row['admin_id']; ?></td>
          </tr>
          <tr class="wow fadeInRight">
            <td>Admin Full Name:</td>
            <td class="fname"><?php echo $admin_row['admin_firstname']; ?></td>
            <td class="lname"><?php echo $admin_row['admin_lastname']; ?></td>
          </tr>
          <tr class="wow fadeInRight">
            <td>Email:</td>
            <td><?php echo $admin_row['admin_email']; ?></td>
          </tr>
          
          


        </table>
       

    </div>

  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>