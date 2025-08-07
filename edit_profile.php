<?php
  include 'conns/css-links.php';
  include 'database/db_conn.php';
  session_start();
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_styles.css">
    <style type="text/css">
      @font-face{ font-family: thefont; src: url(fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: thefont-g; src: url(fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      .icon-img{max-width: 10%; height: auto; border-radius: 3px; border:1px solid rgba(0,0,0, 0.5); position: absolute; bottom: 0rem; right: 1%;}
      .error{color: red;}
      
   
     
    </style>
    <title>Profile Edit Page </title>
</head>
<body>

<?php 
//make sql query
    $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id']." ";

    //get the query results
    $result = mysqli_query($db_conn, $sql);

    //fetch result in array format
    $row = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($db_conn);
 ?>
  
 <?php include 'side_nav.php'; ?>

 <?php 
  $page="edit_profile";
 
$email1 = $username1  =''; //$fileNameNew = $fileDestination = '';
$errors = array('email' => '', 'username' => '', 'current_password' => '', 'new_password' => '', 'confirm_password' => '', 'both_password' => '',  'file' => '' );


if (isset($_GET['id'])) {

    $_SESSION['id_to_update'] =  $_GET['id'];

  }
//echo $_SESSION['id'];


if(isset($_POST['send'])) {

  //$id_to_update = mysqli_real_escape_string($db_conn, $_POST['id_to_update']);


  //if username is empty, validate and then update only email
  if (empty($_POST['username'])) {
    //$username1 = $_POST['username'];

    $email1 = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email format';
    }


    if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $email1 = mysqli_real_escape_string($db_conn, $_POST['email']);

    $sqlE= "SELECT * FROM users WHERE email = '$email1' ";

    $result_e=mysqli_query($db_conn, $sqlE); 

    //extra validation
    if(mysqli_num_rows($result_e) > 0){
      $errors['email']= 'Sorry... Email already Exists';
    }else{ 


    //write sql 
    $sqll_e = "UPDATE users SET email='$email1' WHERE id=".$_SESSION['id']."  ";
  

    //save to db and check
    if (mysqli_query($db_conn, $sqll_e)) { 
      $_SESSION['email']=$email1;
      //success
     ?>
<script type="text/javascript">
  alert("Email Update Successful"); 
  location.href="user_profile.php";
</script>
     
     <?php 


    }else{
      //error
      //header('Location: edit_profile.php');
      ?>
      <script type="text/javascript">
        alert("Unable to update profile <?php echo 'Error updating record: ' . mysqli_error($db_conn); ?>");
      </script>
      <?php
    }  
    

    // echo form is valid
    }
  }//end else from extra validation



  }//end if username was empty
  //elseif email is empty, validate and then update only username
  elseif (empty($_POST['email'])) {
    // $email1 = $_POST['email'];
    // // check if e-mail address is well-formed
    // if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
    //   $errors['email'] = 'Invalid email format';
    // }

    $username1 = $_POST['username'];

    if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $username1 = mysqli_real_escape_string($db_conn, $_POST['username']);

    $sqlU= "SELECT * FROM users WHERE username = '$username1' ";

    $result_u=mysqli_query($db_conn, $sqlU); 

    //extra validation
    if(mysqli_num_rows($result_u) > 0){
      $errors['username']= 'Sorry... Username already Exists';
    }else{ 


    //write sql 
    $sqll_u = "UPDATE users SET username='$username1' WHERE id=".$_SESSION['id']."  ";
  

    //save to db and check
    if (mysqli_query($db_conn, $sqll_u)) { 
      $_SESSION['username']=$username1;
      //success
     ?>
<script type="text/javascript">
  alert("Username Update Successful"); 
  location.href="user_profile.php";
</script>
     
     <?php 


    }else{
      //error
      //header('Location: edit_profile.php');
      ?>
      <script type="text/javascript">
        alert("Unable to update profile <?php echo 'Error updating record: ' . mysqli_error($db_conn); ?>");
      </script>
      <?php
    }  
    

    // echo form is valid
    }
  }//end else from extra validation



  }//end if email was empty
  //else, if both post email and username were not empty
  else{

    $username1 = $_POST['username'];

    $email1 = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email format';
    }

  if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $email1 = mysqli_real_escape_string($db_conn, $_POST['email']);
    $username1 = mysqli_real_escape_string($db_conn, $_POST['username']);


    $sqlU= "SELECT * FROM users WHERE username = '$username1' ";
    $sqlE= "SELECT * FROM users WHERE email = '$email1' ";
    $result_u=mysqli_query($db_conn, $sqlU);
    $result_e=mysqli_query($db_conn, $sqlE); 

    //extra validation
    if (mysqli_num_rows($result_u) > 0) {
      $errors['username']= 'Sorry... Username already Exists';
    }elseif(mysqli_num_rows($result_e) > 0){
      $errors['email']= 'Sorry... Email already Exists';
    }else{ 


    //write sql 
    $sqll = "UPDATE users SET username='$username1', email='$email1' WHERE id=".$_SESSION['id']."  ";
  

    //save to db and check
    if (mysqli_query($db_conn, $sqll)) { 
      $_SESSION['username']=$username1;
      $_SESSION['email']=$email1;
      //$_SESSION['password']=$password;
      //success
     ?>
<script type="text/javascript">
  alert("Update Successful"); 
  location.href="user_profile.php";
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

  }//end else, if both post email and username were not empty




}//end of POST check




if (isset($_POST['change_pic'])) {

  
  //file validation
    $file= $_FILES['file'];
    //print_r($file);
    $fileName= $_FILES['file']['name'];//or $fileName=$file['name']; 
    $fileTmpName= $_FILES['file']['tmp_name'];
    $fileSize= $_FILES['file']['size'];
    $fileError= $_FILES['file']['error'];
    $fileType= $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt= strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (!empty($_FILES['file'])) {
      if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 100000000) {
          $fileNameNew = uniqid('', true). ".".$fileActualExt;
          $fileDestination = 'profile_files/'. $fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          //header('Location: display.php?Uploadsuccess');

        }else{
          $errors['file'] = "Your file is too large";
        }
      }else{
        $errors['file'] = "There was an error uploading your file";
      }
    }else{
      $errors['file'] = "You cannot upload files of this type";
    }//end of file validation
  }




    if (array_filter($errors)) {
    //echo errors in the form
  }else{


      $sql_pic = "UPDATE users SET pic_name ='$$fileNameNew', pic_location = '$fileDestination' WHERE id=".$_SESSION['id']."  ";


       //save to db and check
      if (mysqli_query($db_conn, $sql_pic)) { 
        //success
       ?>
        <script type="text/javascript">
          alert("Profile Image Update Successful"); 
          location.href="user_profile.php";
        </script>
       
       <?php 


      }else{
        //error

        echo 'Error updating record: ' . mysqli_error($db_conn);
         ?>
      <script type="text/javascript">
        alert("Unable to Update Profile Image"); 
        location.href="edit_profile.php";
      </script>
     
     <?php 
      }//end else update not successful  


  }//end else, there was no error



}//end isset post check





//password update code
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

    $id = $_SESSION['id'];
    $sql_pass= "SELECT * FROM users WHERE id = '$id' AND password = '$current_password' LIMIT 1";
    //$result_pass=mysqli_query($db_conn, $sql_pass);
    $query_pass= mysqli_query($db_conn, $sql_pass);
    $row_pass = mysqli_fetch_array($query_pass);
    $db_id = $row_pass['id'];
    $db_curr_password = $row_pass['password'];

    if ($current_password !== $db_curr_password) {
      $errors['current_password']= 'Your current password is not correct';
    }elseif($new_password !== $confirm_password){
      $errors['password']= 'Make sure both passwords are the same';
    }else{

      $sqll = "UPDATE users SET password='$new_password' WHERE id=".$_SESSION['id_to_update']."  ";


       //save to db and check
      if (mysqli_query($db_conn, $sqll)) { 
        //$_SESSION['password']=$new_password;
        //success
       ?>
        <script type="text/javascript">
          alert("Password Update Successful"); 
          location.href="user_profile.php";
        </script>
       
       <?php 


      }else{
        //error
        //header('Location: edit_profile.php');
        echo 'Error updating record: ' . mysqli_error($db_conn);
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
    
    

    <div class="card wow fadeIn mx-4 p-4 border-0 rounded shadow-sm">
      <h2 class="mb-4 p-2 text-center wow fadeInDown">Edit Profile</h2>

      <form method="POST" action="" >
        <div class="form-row d-flex justify-content-between mb-3 wow fadeInRight">
          <div class="form-group col-5">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control text-capitalize" id="firstname" value="<?php echo $firstname; ?>" readonly>
          </div>
          <div class="form-group col-5">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control text-capitalize" id="lastname" value="<?php echo $lastname; ?>" readonly>
          </div>
        </div>
        <div class="form-row d-flex justify-content-between mb-2 wow fadeInRight" data-wow-delay="0.2s">
          <div class="form-group col-5">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="<?php echo $email; ?>">
            <div class="error"><?php echo $errors['email']; ?></div>
          </div>
          <div class="form-group col-5">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo $username0; ?>">
            <div class="error"><?php echo $errors['username']; ?></div>
          </div>
          
        </div>
        
 

        <input type="submit" name="send" class="btn btn-primary d-block mx-auto wow fadeInLeft" data-wow-delay="0.4s" value="Send">
      </form><br><br>



      <h5 class="text-center p-2 border border-left-0 border-right-0 wow fadeInDown" data-wow-delay="0.6s">Change Profile Image</h5>
      <br>
      <form method="POST" action="" enctype="multipart/form-data">
        
        <br>
        <div class="position-relative mt-0 mb-5 mx-5 wow fadeInRight">
            <label class="" for="pic">Select Profile Image: &nbsp;</label>
            <input type="file" class="" name="file" id="pic" onchange="readImageURL(this)" required>

            <img src="<?php echo $fileDestination; ?>" id="icon_image" class="icon-img">
            <div class="row mx-2">
            <input type="submit" value="Change" name="change_pic" class="btn btn-primary">
            <div class="error"><?php echo $errors['file']; ?></div>
            </div>

        </div>

      </form>






      <h4 class="mb-4 p-2 border border-left-0 border-right-0 wow fadeInDown">Password Management</h4>
      <h5 class="mb-4 p-2 text-center wow fadeInRight" data-wow-delay="0.2s">Change Password</h5>
      <form method="POST" action="">
        
        <div class="form-row d-flex justify-content-between mb-3 wow fadeInRight" data-wow-delay="0.4s">
          <div class="form-group col-5">
            <label for="password">Current Password:</label>
            <input type="password" name="current_password" class="form-control" id="password" placeholder="Enter Password">
            <div class="error"><?php echo $errors['current_password']; ?></div>
          </div>
        </div>

        <div class="form-row d-flex justify-content-between mb-3 wow fadeInRight" data-wow-delay="0.6s">
          <div class="form-group col-5">
            <label for="password">New Password:</label>
            <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
            <div class="error text-center "><?php echo $errors['new_password']; ?></div>
          </div>
          <div class="form-group col-5">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm New Password">
            <div class="error text-center "><?php echo $errors['confirm_password']; ?></div>
          </div>
          <div class="w-100">
            <div class="error text-center "><?php echo $errors['both_password']; ?></div>
          </div>
          
        </div><br>

        <input type="submit" name="change_password" class="btn btn-primary mt-4 d-block mx-auto wow fadeInLeft" data-wow-delay="0.6s" value="Submit">
      </form>

    </div>

  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>