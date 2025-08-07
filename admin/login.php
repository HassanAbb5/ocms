<?php
  include '../conns/css-links.php';
  //include 'conns/css-links.php';
  session_start();
  include '../database/db_conn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../main_styles.css">
    <style type="text/css">
      .container-fluid{padding: 0; margin: 0;}
      @font-face{ font-family: thefont; src: url(../fonts/poppins-font/Poppins-SemiBold.ttf);}
       @font-face{ font-family: thefont-g; src: url(../fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .col-6 h5, h1{font-family: thefont;  font-size: 102%; font-weight: normal;}
      .the-font{font-family: thefont;}
      .error{ margin-left: 1rem; color: red;}
      .nav-link{font-size: 115%;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: 2s;}


      
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body style="margin: 0; padding: 0;">


  <div class="container-fluid">
    
    <nav class="navbar navbar-expand-lg navbar-light mb-3 animated fadeInDown">
      <a class="navbar-brand" href="#"></a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sign In As
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item font-weight-bold d-block" href="../sign_in.php"> <i class="far fa-user"></i> User</a>
              <a class="dropdown-item font-weight-bold d-block" href="login.php"> <i class="fa fa-user-circle"></i> Admin</a>    
            </div>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sign Up</a>
          </li>
          -->
          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>
        </ul>
      </div>
    </nav>


    <?php 
      $errors = array('email' => '', 'password' => '');

       if (isset($_POST['submit'])) {

        if (empty($_POST['email'])) {
          $errors['email'] = 'Email is required';
        } else {
          $email = $_POST['email'];
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
          }
          
        }
    
        $email = strip_tags($email);
        $password = strip_tags($_POST['password']);

        //prevent mysql injection
        $email=stripcslashes($email);
        $password=stripcslashes($password);
        $email=mysqli_real_escape_string($db_conn, $email);
        $password=mysqli_real_escape_string($db_conn, $password);

        //$password=md5($password);

        $sql = "SELECT * FROM admin WHERE admin_email ='$email' LIMIT 1";
        $query= mysqli_query($db_conn, $sql);

        if (mysqli_num_rows($query) > 0) {
        
        $row = mysqli_fetch_array($query);
        $db_id = $row['admin_id'];
        $db_email = $row['admin_email'];
        $db_password = $row['admin_password'];

        //if ($username == $db_email) {      
          if ($password == $db_password) {
            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_password']= $password;
            $_SESSION['admin_id'] = $db_id;
            header('Location: admin_dashboard.php');
          }else{
            $errors['password']= "Incorrect Password";
          }
       // }else{  echo "Incorrect Emaail"; }

        }else{ $errors['email']= "Incorrect Email"; }  

      }

     ?>

    <script type="text/javascript">
       function showPassFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
     </script>


    <div class="row pt-5">
      
      <div class="col-6 px-5  animated fadeInLeft">
       
       <div class="border pt-4 px-5 pb-4">
          <h3 class="text-center">Sign In As Admin</h3>
        <form method="POST" action="" >
          <div class="form-group">
            <label for="email">Email: </label>
            <input type="text" class="form-control" placeholder="Enter Email" name="email" id="email" >
          </div>
          <div class="text-danger error pb-3"><?php echo $errors['email']; ?></div>
          <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
          </div>
          <div class="text-danger error pb-3"><?php echo $errors['password']; ?></div>
          <div class="form-group form-check">
            <input type="checkbox" id="checkbox"  class="form-check-input" onclick="showPassFunction()">
            <label class="form-check-label" for="checkbox">Show Password</label>
          </div>
      
          <input type="submit" class="sign-in-btn text-white" name="submit" value="Sign In">
        </form>
        
       </div>

      </div>
      <div class="col-6 m-0 p-0 pr-5 animated fadeInRight">
        <img src="../images/1comp.jpg" class="bg-image">
      </div>

    </div>



  </div>

    
</body>

<?php include '../conns/js-links.php'; ?>
</html>