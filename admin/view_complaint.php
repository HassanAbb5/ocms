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
      tr{text-align:left; display: flex; justify-content:; margin-bottom: 1rem;}
      td{font-size: 105%; margin-right: 2rem;}
      tr.response{display: flex; justify-content: flex-end;}
      .fname,.lname{text-transform: capitalize;}
      .type::first-letter,.subject::first-letter{text-transform: capitalize;}
      .content{margin-right: .2rem; max-width: 70%; height: auto; font-size: 105%; background-color: rgba(0,0,0, 0.05); box-shadow: 0 2px 4px rgba(0,0,0, 0.3); border-radius: 0 10px 10px 10px;}
      tr.response td.response-content{margin-right: .2rem; max-width: 70%; height: auto; font-size: 105%; background-color: #3399ff; color: white; box-shadow: 0 2px 4px rgba(0,0,0, 0.3); border-radius: 10px 0px 10px 10px;}
      tr.enter-response{ display: flex; flex-direction: column; }
      .content::first-letter, .response-content::first-letter{text-transform: capitalize;}
      .time{right: 2%; bottom: 2%; font-size: .8rem; font-style: ; color: grey;}
      

      
   
     
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
  $page="view_complaint";

  if (isset($_GET['complaint_id'])) {

    $complaint_id =  $_GET['complaint_id'];

    //make sql query
    $sql_for_complaint = "SELECT * FROM complaints WHERE complaint_id = '$complaint_id' ";

    //get the query results
    $result_for_complaint = mysqli_query($db_conn, $sql_for_complaint);
    //fetch result in array format
    $complaint_row = mysqli_fetch_assoc($result_for_complaint);

    //mysqli_free_result($result_for_complaint);
    //mysqli_close($db_conn);

  }


  ?>

  <?php 
    $errors = array( 'response_message' => '' );

    if(isset($_POST['send_response'])) {
      //$complaint_id_r =  $complaint_row['complaint_id'];
      date_default_timezone_set("Africa/Lagos");
      $current_date = date('Y-m-d H:i:s');

      $response_message = $_POST['response_message'];

      if (array_filter($errors)) {
        //echo errors in the form
      }else{

        $response_message = mysqli_real_escape_string($db_conn, $_POST['response_message']);
        
        //write sql 
        $sql_response = "UPDATE complaints SET admin_response='$response_message', responded='1', response_date = '$current_date' WHERE complaint_id='$complaint_id'  ";

         //save to db and check
    if (mysqli_query($db_conn, $sql_response)) { 
      //$_SESSION['email']=$email1;
      //success
     ?>
    <script type="text/javascript">
      alert("Response Sent"); 
      location.href="view_complaint.php?complaint_id=<?php echo $complaint_id; ?>";

    </script>
     
     <?php 


    }else{
      //error
      ?>
      <script type="text/javascript">
        alert("Unable to Send Response <?php echo 'Error updating record: ' . mysqli_error($db_conn); ?>");
      </script>
      <?php
    }  //end else error sent
    

      }//end else for sql query and co


    }//end isset post check


   ?>


   <?php 
   //Code to delete complaint
    if(isset($_GET['delete'])){

        $id_to_delete = $_GET['delete'];
        $sql_delete = "DELETE FROM complaints WHERE complaint_id='$id_to_delete' ";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_delete)) {
          //success
        ?>
        <script type="text/javascript">
          alert('Complaint has been Deleted');
          location.href="all_complaints.php";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end get

     
    ?>


  <?php include '../time_ago.php'; ?>

  <div class="main-content">

    

    <div class="card mx-4 wow fadeIn p-5 border-0 rounded shadow-sm">
      <div>
        <a href="all_complaints.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">Complaint Details</h2>
      </div>

      
        <table>
          
          <tr class="wow fadeInRight" >
            <td>Complaint Id:</td>
            <td><?php echo $complaint_row['complaint_id']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.1s">
            <td>Sender Id:</td>
            <td><?php echo $complaint_row['sender_id']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.2s">
            <td>Sender Full Name:</td>
            <td class="fname"><?php echo $complaint_row['sender_firstname']; ?></td>
            <td class="lname"><?php echo $complaint_row['sender_lastname']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.3s">
            <td>Sender Email:</td>
            <td><?php echo $complaint_row['sender_email']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.4s">
            <td>Sender Username:</td>
            <td><?php echo $complaint_row['sender_username']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.5s">
            <td>Complaint Type:</td>
            <td class="type"><?php echo $complaint_row['complaint_type']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.6s">
            <td>Complaint Subject:</td>
            <td class="subject"><?php echo $complaint_row['complaint_subject']; ?></td>
          </tr>
          <tr class="wow fadeInLeft" data-wow-delay="0.7s">
            <td>
              <a href="view_complaint.php?delete=<?php echo $complaint_row['complaint_id']; ?> "  title="Delete" class="btn btn-danger bi bi-trash"> &nbsp;Delete Complaint</a>
            </td>
          </tr>
          <tr class="mb-1 wow fadeInLeft" data-wow-delay="0.8s">
            <td style="" class="">Message</td>
          </tr>
          <tr class="wow fadeInLeft" data-wow-delay="0.8s">            
            <td class="content ml-3  p-3 position-relative mb-4">
             <?php echo $complaint_row['complaint_message']; ?>
             <small class="time position-absolute">
               <?php echo time_ago(date($complaint_row['date_sent'])); ?>
             </small>
            </td>
          </tr>
          <?php if ($complaint_row['responded'] == 1): ?>          
          
          <tr class="response mb-1 wow fadeInRight" data-wow-delay="0.9s">
            <td class="mr-0">Admin Response</td>
          </tr>
          <tr class="response wow fadeInRight" data-wow-delay="0.9s">
            <td class="response-content mr-3  p-3 position-relative">
              <?php echo $complaint_row['admin_response']; ?>                  
              <small class="time position-absolute " style="color: #cce6ff;">
                <?php echo time_ago(date($complaint_row['response_date'])); ?>
              </small> 
            </td>           
          </tr>
          <?php else: ?>
            <tr class="d-flex justify-content-end my-3" >
              <td class="">
                No Response Yet
              </td>
            </tr>
          <?php endif ?>
          <tr class=" mb-1 wow fadeInLeft mx-5" data-wow-delay="0.6s">
            <td class="mr-0">Response</td>
          </tr>
          <tr class="enter-response mx-5 wow fadeInLeft" data-wow-delay="0.6s">
            <?php  ?>
            <form method="POST" action="">
              <td class="">
              
                <div class="input-group mb-3">
                  <textarea type="text" name="response_message" class="form-control" placeholder="Enter Response Here" aria-label="response" aria-describedby="button-addon2"></textarea>
                  <div class="input-group-append">
                    <button type="submit" name="send_response" class="btn btn-primary" id="button-addon2">Send</button>
                  </div>
                </div>
                <div class="error"><?php echo $errors['response_message']; ?></div>
              </td>

            </form>
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