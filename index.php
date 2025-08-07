<?php
  include 'conns/css-links.php';
  include 'database/db_conn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_styles.css">
    <style type="text/css">
      .container-fluid{padding: 0; margin: 0;}
      @font-face{ font-family: thefont; src: url(fonts/poppins-font/Poppins-SemiBold.ttf);}
      @font-face{ font-family: thefont-g; src: url(fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .col-6 h5, h1{font-family: thefont; }
      .the-font{font-family: thefont;}
      .error{color: red;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: 2s;}
      .icon-img{max-width: 20%; height: auto; border-radius: 3px; border:1px solid rgba(0,0,0, 0.5); position: absolute; bottom: 0rem; right: 1%;}
      .dropdown-menu{z-index: 2001;}
      


      
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body style="margin: 0; padding: 0;">


  <div class="container-fluid">
    
    <nav class="navbar navbar-expand-lg navbar-light mb-5 animated fadeInDown">
      <a class="navbar-brand" href="#"></a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sign In As
            </a>
            <div class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item font-weight-bold" href="sign_in.php"> <i class="far fa-user"></i> User</a>
              <a class="dropdown-item font-weight-bold" style="z-index: ;" href="admin/login.php"> <i class="fa fa-user-circle"></i> Admin</a>    
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href=".sign-up-modal">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>
        </ul>
      </div>
    </nav>


    <div class="row pt-2">
      
      <div class="col-6 p-5  animated fadeInLeft">
        <h1 class="font-weight-bold" style="font-family: thefont-g">Online Complaint Managemnt System</h1>
        <h5 class="mb-5">Improves Student Experience and Communication with your Institution. <br> An Online system where complaints are easily made with <span class="brand-text-color">24/7</span> fast response</h5>

        <a class="sign-up-btn text-white" data-toggle="modal" href=".sign-up-modal" >Sign Up Here</a>
      </div>
      <div class="col-6 m-0 p-0 pr-5 animated fadeInRight">
        <img src="images/1comp.jpg" class="bg-image ">
      </div>

    </div>



  </div>


<?php include 'signup_code.php'; ?>




<div class="modal fade sign-up-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0 my-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <div class=" px-2  pb-3">
          <h3 class="text-center mb-3 mt-0">Register Here</h3>
        
        <form method="POST" name="reg_form" action="index.php" enctype="multipart/form-data" onsubmit="">
          <div class="form-group row d-flex justify-content-between">
            <label for="firstname" class="col-2 mr-1 col-form-label">Firstname: </label>
            <div class="col-9">
              <input type="text" class="form-control" value="" name="firstname" id="firstname" placeholder="Enter Firstname" required="required">
              <div class="error"><?php echo $errors['firstname']; ?></div>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-between">
            <label for="lastname" class="col-2 mr-1 col-form-label">Lastname:</label>
            <div class="col-9">
              <input type="text" class="form-control" value="" name="lastname" id="lastname" placeholder="Enter Lastname" required="required">
              <div class="error"><?php echo $errors['lastname']; ?></div>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-between">
            <label for="username" class="col-2 mr-1 col-form-label">Username:</label>
            <div class="col-9">
              <input type="text" class="form-control" value="" name="username" id="username" placeholder="Enter Username" required="required">
              <div class="error"><?php echo $errors['username']; ?></div>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-between">
            <label for="email" class="col-2 mr-1 col-form-label">Email:</label>
            <div class="col-9">
              <input type="email" class="form-control" value="" name="email" id="email" placeholder="Enter Email" required="required">
              <div class="error"><?php echo $errors['email']; ?></div>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-between">
            <label for="password" class="col-2 mr-1 col-form-label">Password:</label>
            <div class="col-9">
              <input type="password" class="form-control" value="" name="password" id="password" placeholder="Enter Password" required="required">
              <div class="error"><?php echo $errors['password']; ?></div>
            </div>
          </div>
          <div class="form-group row d-flex justify-content-between">
            <label for="confirm_password" class="col-2 mr-1 col-form-label">Confirm Password:</label>
            <div class="col-9">
              <input type="password" class="form-control" value="" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required">
              <div class="error" id="confirm_error"><?php echo $errors['confirm_password']; ?></div>
            </div>
          </div>
          <div class="position-relative">
            <label class="" for="pic">Select Profile Image: &nbsp;</label>
            <input type="file" class="" name="file" id="pic" onchange="readImageURL(this)" required="required">
            <img src="images/icon_pic.png" id="icon_image" class="icon-img">
            <div class="error"><?php echo $errors['file']; ?></div>
          </div>

         
          <div class="form-group row mt-3">
              <input type="submit" name="submit" value="Submit" class="sign-in-btn text-white mx-auto">
              
          </div>
        </form>
        <h5 class="text-right mt-0">Already have an account? <a href="sign_in.php">Login</a></h5>

      </div>


      </div>
      




    </div>
  </div>
</div>

    
</body>

<?php include 'conns/js-links.php'; ?>
</html>