<?php
  include 'conns/css-links.php';
  session_start();
  include 'database/db_conn.php';


  //make sql query
    $sql = "SELECT * FROM users WHERE id = ".$_SESSION['id']." ";

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
      @font-face{ font-family: thefont; src: url(fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: poppins-bold; src: url(fonts/poppins-font/Poppins-SemiBold.ttf);}
       @font-face{ font-family: thefont-g; src: url(fonts/gotham-font/GothamMedium.ttf);}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      form.form-group{font-size: 1.5rem;}
      tr{display: flex; flex-direction: row; margin-bottom: 1.5rem;}

      td{width: 50%; margin: 0 2%;}
      .display-pic{width: 30%; max-height: 9rem; border-radius: 10%; }
      .poppins-bold{font-family: poppins-bold;}
      .textarea{height: 400px;}
   
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body>
 <?php include 'side_nav.php'; $page="make_complaint"; ?>
  <div class="main-content">
    
<?php 

$errors = array('complaint_type' => '', 'complaint_subject' => '', 'complaint_message' => '' );


if (isset($_POST['send_complaint'])) {


  
  if (empty($_POST['complaint_type'])) {
    $errors['complaint_type'] = 'A Complaint Type is required';
  } else {
    $complaint_type = $_POST['complaint_type'];    
  }


  if (empty($_POST['complaint_subject'])) {
    $errors['complaint_subject'] = 'A Complaint Subject is required';
  } else {
    $complaint_subject = $_POST['complaint_subject'];
    // check if complaint_subject only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z ]*$/',$complaint_subject)) {
      $errors['complaint_subject'] = 'Only letters and white space allowed';
    }
  }



  if (empty($_POST['complaint_message'])) {
    $errors['complaint_message'] = 'Make sure you enter your complaint details';
  } else {
    $complaint_message = $_POST['complaint_message'];    
  }



  if (array_filter($errors)) {
    //echo errors in the form
  }else{

    $complaint_type = mysqli_real_escape_string($db_conn, $_POST['complaint_type']);
    $complaint_subject = mysqli_real_escape_string($db_conn, $_POST['complaint_subject']);
    $complaint_message = mysqli_real_escape_string($db_conn, $_POST['complaint_message']);


    //write sql 
    $complaint_sql = "INSERT INTO complaints(sender_id, sender_firstname, sender_lastname, sender_username, sender_email, complaint_type, complaint_subject, complaint_message) VALUES( '$id','$firstname', '$lastname', '$username0', '$email', '$complaint_type', '$complaint_subject', '$complaint_message')";



      if (mysqli_query($db_conn, $complaint_sql)) {
            
      ?>
      <script type="text/javascript">
        alert("Complaint Successfully Logged!"); 
        location.href="my_complaints.php";
      </script>

      <?php 
      }else{
            //echo 'query error: ' . mysqli_error($db_conn);
      ?>
        <script type="text/javascript">
          alert("Complaint Log is not Successful!"); 
        </script>

      <?php
          }


  }//end of else from array filter errors



}//end of isset post

 ?>    

    <div class="card mx-4 p-4 border-0 rounded shadow-sm">

      <h3 class="mb-4 p-2 text-center wow fadeInDown">Make a Complaint</h3>
      
      
        <div class="form-row d-flex justify-content-around mb-3">
          <div class="form-group col-5 wow fadeInDown" data-wow-delay="0.2s">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control text-capitalize" id="firstname" value="<?php echo $firstname; ?>" readonly>
          </div>
          <div class="form-group col-5 wow fadeInDown" data-wow-delay="0.4s">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control text-capitalize" id="lastname" value="<?php echo $lastname; ?>" readonly>
          </div>
        </div>
        <div class="form-row d-flex justify-content-around mb-3 wow fadeInRight">
          <div class="form-group col-5">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
            
          </div>
          <div class="form-group col-5">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" value="<?php echo $username0; ?>" readonly>
            
          </div>
        </div>
      <form method="POST" action="" >
        <div class="form-row d-flex justify-content-between mx-2 mb-3 wow fadeInRight" data-wow-delay="0.2s">
          <div class="form-group col-5">
            <label for="complaint-type">Select Complaint Type</label>
            <select class="form-control" name="complaint_type" id="complaint-type" required>
              <option value="general">General</option>
              <option value="personal">Personal</option>
            </select>
            <div class="error"><?php echo $errors['complaint_type']; ?></div>
          </div>
          <div class="form-group col-5">
            <label for="subject">Complaint Subject</label>
            <input type="text" name="complaint_subject" placeholder="Enter Complaint Subject" class="form-control" id="subject" value="" required>
            <div class="error"><?php echo $errors['complaint_subject']; ?></div>
          </div>          

        </div>
        <br>
        <div class="form-row d-flex justify-content-between mx-3 mb-3 wow fadeInRight" data-wow-delay="0.4s">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Enter Complaint:</span>
            </div>
            <textarea class="textarea form-control" name="complaint_message" placeholder="Enter complaint details here" style="height: 7rem;" aria-label="With textarea" required></textarea>
          </div>
          <div class="error"><?php echo $errors['complaint_message']; ?></div>
        </div>
        
        <?php 
          $user_id = $_SESSION['id'];
          $sql_check_blocked = "SELECT blocked, id FROM users WHERE blocked = '1' AND id = '$user_id' ";
          $blocked_results=mysqli_query($db_conn, $sql_check_blocked);
          $blocked = mysqli_fetch_assoc($blocked_results)
        ?> 
      
        <?php if ($blocked['blocked'] == '1'): ?>
          <h5 class="text-danger text-center">You have been blocked! Therefore you cannot make any Complaints for now!</h5>
        <?php endif ?>
        
        <input type="submit" name="send_complaint" class="btn btn-primary mt-4 d-block mx-auto wow fadeInLeft" data-wow-delay="0.6s" value="Submit" <?php if($blocked['blocked'] == '1'){echo "disabled";} ?> >
        
        
      </form><br>
      

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