<?php
  include '../conns/css-links.php';
  session_start();
  include '../database/db_conn.php';


  //make sql query
    $sql = "SELECT * FROM admin WHERE admin_id = ".$_SESSION['admin_id']." ";

    //get the query results
    $result = mysqli_query($db_conn, $sql);

    //fetch result in array format
    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($db_conn);

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
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: 2s;}
      form.form-group{font-size: 1.5rem;}
      tr{display: flex; flex-direction: row; margin-bottom: 1.5rem;}

      td{width: 50%; margin: 0 2%;}
      .display-pic{width: 30%; max-height: 9rem; border-radius: 10%; }
   
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body>
 <?php include 'side_nav.php'; $page="admin_profile"; ?>
  <div class="main-content">
    
    <h4 class="mb-4 p-2 border border-left-0 border-right-0">Admin Profile</h4>

    <div class="card wow fadeIn mx-4 p-4 border-0 rounded shadow-sm" data-wow-duration="">
      
      <table>
      <tr>
        <form class="form-inline ">
        <td class="mx-auto">
          
        </td>
      </form>
      </tr>
      <tr>
        <form class="form-inline ">
        <td>
          <div class="form-group mb-2">
          <label for="id" class="">User Id</label>
          <input type="text" readonly class="form-control-plaintext w-75 border rounded px-3" id="id" value="<?php echo $id; ?>">
        </div>
        </td>
      </form>
      </tr>
      <tr>
        <form class="form-inline ">
        <td>
          <div class="form-group mb-2">
          <label for="firstname" class="">First Name</label>
          <input type="text" readonly class="form-control-plaintext border rounded px-3 text-capitalize" id="firstname" value="<?php echo $firstname; ?>">
        </div>
        </td>
        <td>
          <div class="form-group mb-2">
          <label for="lastname" class="">Last Name</label>
          <input type="text" readonly class="form-control-plaintext border rounded px-3 text-capitalize" id="lastname" value="<?php echo $lastname; ?>">
        </div>
        </td>
      </form>
      </tr>
      <tr>
        <form class="form-inline d-flex justify-content-around">
        <td>
          <div class="form-group mb-2">
          <label for="email" class="">Email</label>
          <input type="text" readonly class="form-control-plaintext border rounded px-3" id="email" value="<?php echo $email; ?>">
        </div>
        </td>
        <td>
          
        </td>
      </form>
      </tr>
      <tr>
        <td>
          <a href="edit_admin.php?id=<?php echo $id; ?>" class="btn btn-primary float-right">Edit Profile</a>
        </td>
      </tr>
      </table>

    </div>

  </div>
    
</body>

<?php 

     $_SESSION['id'] = $id ;
      

 ?>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>