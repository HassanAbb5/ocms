<?php 
  include '../database/db_conn.php';

  $errors = array( 'email' => '', 'firstname' => '', 'lastname' => '',  'password' => '', 'confirm_password' => '', 'both_password' => '');

if(isset($_POST['submit'])) {

  if (empty($_POST['firstname'])) {
    $errors['firstname'] = 'Firstname is required';
  } else {
    $firstname = $_POST['firstname'];
    // check if firstname only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z ]*$/',$firstname)) {
      $errors['firstname'] = 'Only letters and white space allowed';
    }
  }


  if (empty($_POST['lastname'])) {
    $errors['lastname'] = 'Lastname is required';
  } else {
    $lastname = $_POST['lastname'];
    // check if lastname only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z ]*$/',$lastname)) {
      $errors['lastname'] = 'Only letters and white space allowed';
    }
  }



 if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required';
  } else {
    $email = $_POST['email'];
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email format';
    }
    
  }


  if (empty($_POST['password'])) {
    $errors['password'] = 'Password is required';
  } else {
    if (strlen($_POST['password']) < 3) {
      $errors['password'] = 'Password cannot be less than 3 characters';
    }else{
      $password = $_POST['password'];
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



  if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $firstname = mysqli_real_escape_string($db_conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db_conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($db_conn, $_POST['email']);
    $password = mysqli_real_escape_string($db_conn, $_POST['password']);
    
    //$confirm_password = mysqli_real_escape_string($db_conn, $_POST['confirm_password']);

      
      $sqlE= "SELECT * FROM admin WHERE admin_email = '$email'";
      $result_e=mysqli_query($db_conn, $sqlE);

      if(mysqli_num_rows($result_e) > 0){
        $errors['email']= 'Sorry... Email already Exists';
      }elseif($password !== $confirm_password) {
        $errors['both_password'] = 'Make sure both passwords are the same';
      }else{   

      //write sql 
      $sql = "INSERT INTO admin(admin_firstname, admin_lastname, admin_email, admin_password) VALUES( '$firstname', '$lastname', '$email', '$password')";

      if (mysqli_query($db_conn, $sql)) {
        //success
      ?>
      <script type="text/javascript">
        alert("Registration Successful!"); 
        location.href="all_admins.php";
      </script>

      <?php 
      }else{
            //echo 'query error: ' . mysqli_error($db_conn);
        ?>
        <script type="text/javascript">
          alert("Administrator Registration UnSuccessful!"); 
        </script>

        <?php
          }
      }//end else statement from username and email verification
    
    // echo form is valid
  }//end of else from array filter errors


}//end of POST check

         ?>

