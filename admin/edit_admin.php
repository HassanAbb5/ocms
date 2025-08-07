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
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      .icon-img{max-width: 10%; height: auto; border-radius: 3px; border:1px solid rgba(0,0,0, 0.5); position: absolute; bottom: 0rem; right: 1%;}
      .error{color: red;}
      
   
     
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
  $page="edit_admin";
 
 $username1  =''; 
$errors = array('email' => '', 'username' => '', 'new_password' => '', 'confirm_password' => '', 'both_password' =>'', 'current_password' => '' );


if (isset($_GET['id'])) {

    $_SESSION['id_to_update'] =  $_GET['id'];

    //make sql query
    //$sql_for_update = "SELECT * FROM users WHERE id = ".$_SESSION['id_to_update']." ";

    //get the query results
    // $result_for_update = mysqli_query($db_conn, $sql_for_update);

    // //fetch result in array format
    // $user_to_update = mysqli_fetch_assoc($result_for_update);

    // mysqli_free_result($result_for_update);
    // mysqli_close($db_conn);

  }
//echo $_SESSION['admin_id'];

if(isset($_POST['send'])) {

  //$id_to_update = mysqli_real_escape_string($db_conn, $_POST['id_to_update']);

    

  
    $email1 = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email format';
    }



  if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $email1 = mysqli_real_escape_string($db_conn, $_POST['email']);

    $sqlE= "SELECT * FROM admin WHERE admin_email = '$email1' ";
    $result_e=mysqli_query($db_conn, $sqlE); 

    //extra validation
    if(mysqli_num_rows($result_e) > 0){
      $errors['email']= 'Sorry... Email already Exists';
    }else{ 


    //write sql 
    $sqll = "UPDATE admin SET admin_email='$email1' WHERE admin_id=".$_SESSION['admin_id']."  ";
  

    //save to db and check
    if (mysqli_query($db_conn, $sqll)) { 
      $_SESSION['email']=$email1;

     ?>
<script type="text/javascript">
  alert("Update Successful"); 
  location.href="admin_profile.php";
</script>
     
     <?php 


    }else{
      //error
      //header('Location: edit_profile.php');
      //echo 'Error updating record: ' . mysqli_error($db_conn);
      ?>
      <script type="text/javascript">
        alert("Unable to update profile <?php echo 'Error updating record: ' . mysqli_error($db_conn); ?>");
      </script>
      <?php
    }  
    

    // echo form is valid
    }
  }//end else from extra validation

}//end of POST check




if (isset($_POST['change_password'])) {
  

  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if (empty($_POST['current_password'])) {
    $errors['current_password'] = 'Password is required';
  } else {
    if (strlen($_POST['current_password']) < 3) {
      $errors['current_password'] = 'Password cannot be less than 3 characters';
    }else{
      $current_password = $_POST['current_password'];
    }
  }

  if (empty($_POST['new_password'])) {
    $errors['new_password'] = 'New Password is required';
  } else {
    if (strlen($_POST['new_password']) < 3) {
      $errors['new_password'] = 'Password cannot be less than 3 characters';
    }else{
      $new_password = $_POST['new_password'];
    }
  }

  if (empty($_POST['confirm_password'])) {
    $errors['confirm_password'] = 'Password Confirmation is required';
  } else {
    if (strlen($_POST['confirm_password']) < 3) {
      $errors['confirm_password'] = 'Password Confirmation cannot be less than 3 characters';
    }else{
      $confirm_password = $_POST['confirm_password'];
    }
  }


  $current_password=stripcslashes($current_password);
  $new_password=stripcslashes($new_password);
  $confirm_password=stripcslashes($confirm_password);

  $current_password=mysqli_real_escape_string($db_conn, $current_password);
  $new_password=mysqli_real_escape_string($db_conn, $new_password);
  $confirm_password=mysqli_real_escape_string($db_conn, $confirm_password);


  if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $admin_id=$_SESSION['admin_id'];
    $sql_pass= "SELECT * FROM admin WHERE admin_id='$admin_id' AND admin_password = '$current_password' LIMIT 1";
    //$result_pass=mysqli_query($db_conn, $sql_pass);
    $query_pass= mysqli_query($db_conn, $sql_pass);
    $row_pass = mysqli_fetch_array($query_pass);
    $db_id = $row_pass['admin_id'];
    $db_curr_password = $row_pass['admin_password'];

    if ($current_password !== $db_curr_password) {
      $errors['current_password']= 'Your current password is not correct';
    }elseif($new_password !== $confirm_password){
      $errors['both_password']= 'Make sure both passwords are the same';
    }else{

      $sqll = "UPDATE admin SET admin_password='$new_password' WHERE admin_id=".$_SESSION['admin_id']."  ";


       //save to db and check
      if (mysqli_query($db_conn, $sqll)) { 
        //$_SESSION['password']=$new_password;
        //success
       ?>
        <script type="text/javascript">
          alert("Password Update Successful"); 
          location.href="admin_profile.php";
        </script>
       
       <?php 


      }else{
        //error

        echo 'Error updating record: ' . mysqli_error($db_conn);
         ?>
      <script type="text/javascript">
        alert("Unable to update Password"); 
        location.href="admin_profile.php";
      </script>
     
     <?php 
      }  


    }


  }


}

  ?>


<script type="text/javascript">
  function readImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#icon_image')
                        .attr('src', e.target.result)
                         .width(150)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }      
</script>
  <div class="main-content">
    
    

    <div class="card mx-4 wow fadeIn p-4 border-0 rounded shadow-sm">
      <div>
        <a href="admin_profile.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">Edit Profile</h2>
      </div>
      
      <form method="POST" action="" >
        <div class="form-row d-flex justify-content-between mb-3">
          <div class="form-group col-5">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control text-capitalize" id="firstname" value="<?php echo $firstname; ?>" readonly>
          </div>
          <div class="form-group col-5">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control text-capitalize" id="lastname" value="<?php echo $lastname; ?>" readonly>
          </div>
        </div>
        <div class="form-row d-flex justify-content-between mb-3">
          <div class="form-group col-5">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $email; ?>">
            <div class="error"><?php echo $errors['email']; ?></div>
          </div>
                    
        </div>
        <br>
 

        <input type="submit" name="send" class="btn btn-primary mt-4 d-block mx-auto" value="Send">
      </form><br>






      <h4 class="mb-4 p-2 border border-left-0 border-right-0">Password Management</h4>
      <h5 class="mb-4 p-2 text-center">Change Password</h5>
      <form method="POST" action="">
        
        <div class="form-row d-flex justify-content-between mb-3">
          <div class="form-group col-5">
            <label for="password">Current Password</label>
            <input type="password" name="current_password" class="form-control" id="password" placeholder="Enter Password">
            <div class="error"><?php echo $errors['current_password']; ?></div>
          </div>
        </div>

        <div class="form-row d-flex justify-content-between mb-3">
          <div class="form-group col-5">
            <label for="password">New Password</label>
            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
            <div class="error text-center "><?php echo $errors['new_password']; ?></div>
          </div>
          <div class="form-group col-5">
            <label for="confirm_password">Confirm New Password</label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
            <div class="error text-center "><?php echo $errors['confirm_password']; ?></div>
          </div>
          <div class="w-100">
            <div class="error text-center "><?php echo $errors['both_password']; ?></div>
          </div>
          
        </div><br>

        <input type="submit" name="change_password" class="btn btn-primary mt-4 d-block mx-auto" value="Submit">
      </form>

    </div>

  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>