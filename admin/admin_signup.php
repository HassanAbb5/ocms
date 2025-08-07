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
    <link rel="stylesheet" type="text/css" href="../main_styles.css">
    <style type="text/css">
      @font-face{ font-family: thefont; src: url(../fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: thefont-g; src: url(../fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: 2s;}
      form.form-group{font-size: 1.5rem;}
     .error{color: red;}
      
   
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body>
 <?php include 'side_nav.php'; $page="add_admin"; ?>
  <div class="main-content">
    
  <?php include 'admin_signup_code.php'; ?>  

    <div class="card mx-4 p-5 border-0 rounded shadow-sm">

      <h3 class="mb-5 p-2 text-center">Add Administrator</h3>
      
      <form method="POST" name="add_admin" action="" >

        <div class="form-row d-flex justify-content-between mb-3 px-3 mb-4">
          <div class="form-group col-5">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" class="form-control text-capitalize" id="firstname" placeholder="Enter First Name" required>
            <div class="error"><?php echo $errors['firstname']; ?></div>
          </div>
          <div class="form-group col-5">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" class="form-control text-capitalize" id="lastname" placeholder="Enter Last Name" required>
            <div class="error"><?php echo $errors['lastname']; ?></div>
          </div>
        </div>
          <div class="form-group row px-3 mb-4">
            <label for="email" class="col-2 mr-1 col-form-label">Email:</label>
            <div class="col-9">
              <input type="email" name="email" class="form-control" value="" id="email" placeholder="Enter Email" required="required">
              <div class="error"><?php echo $errors['email']; ?></div>
            </div>
          </div>
          <div class="form-row d-flex justify-content-between mb-3 px-3">

            <div class="form-group col-5">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="new_password" placeholder="Enter New Password">
              <div class="error text-center "><?php echo $errors['password']; ?></div>
            </div>
            <div class="form-group col-5">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
              <div class="error text-center "><?php echo $errors['confirm_password']; ?></div>           
            </div>
            <div class="w-100">
              <div class="error text-center "><?php echo $errors['both_password']; ?></div>
            </div> 

          </div>
         
          <div class="form-group row mt-3">
              <input type="submit" name="submit" value="Submit" class="sign-in-btn text-white mx-auto">       
          </div>

        </form>

    </div>

  </div>
    
</body>



<?php include 'conns/js-links.php'; ?>
</html>