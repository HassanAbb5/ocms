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
      tr{text-align:left; display: flex; justify-content:; margin-bottom: 1rem;}
      td{font-size: 105%; margin-right: 2rem;}
      tr.message-sent{display: flex; justify-content: flex-end;}
      .fname,.lname{text-transform: capitalize;}
      .type::first-letter,.subject::first-letter{text-transform: capitalize;}
      .content{margin-right: .2rem; max-width: 70%; height: auto; font-size: 105%; background-color: #3399ff; color: white; box-shadow: 0 2px 4px rgba(0,0,0, 0.3); border-radius: 10px 0px 10px 10px;}
      tr.response td.response-content{margin-right: .2rem; max-width: 70%; height: auto; font-size: 105%; background-color: rgba(0,0,0, 0.05); box-shadow: 0 2px 4px rgba(0,0,0, 0.3); border-radius: 0 10px 10px 10px;}
      tr.enter-response{ display: flex; flex-direction: column; }
      .content::first-letter, .response-content::first-letter{text-transform: capitalize;}
      .time{right: 2%; bottom: 2%; font-size: .8rem; font-style: ; color: grey;}
      

      
   
     
    </style>
    <title>Complaint Details Page</title>
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
  $page="complaint_details";

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
   //Code to delete complaint
    if(isset($_GET['delete'])){
        $sender_id = $_SESSION['id'];

        $id_to_delete = $_GET['delete'];
        $sql_delete = "DELETE FROM complaints WHERE complaint_id='$id_to_delete' AND sender_id = '$sender_id'  ";
        //$db->query($query);

        if (mysqli_query($db_conn, $sql_delete)) {
          //success
        ?>
        <script type="text/javascript">
          alert('Complaint has been Deleted');
          location.href="my_complaints.php";
        </script>
        <?php 
          //header('Location: index.php');
        }else{
          //failure
          echo 'query error: ' . mysqli_error($db_conn);
        }//end else

    }//end get

     
    ?>


  <?php include 'time_ago.php'; ?>

  <div class="main-content">

    

    <div class="card mx-4 wow fadeIn p-5 pt-1 border-0 rounded shadow-sm">
      <div>
        <a href="my_complaints.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">Complaint Details</h2>
      </div>
      
        <table>
          
          <tr class="wow fadeInRight" data-wow-delay="0.2s">
            <td>Complaint Id:</td>
            <td><?php echo $complaint_row['complaint_id']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.4s">
            <td>Sender Id:</td>
            <td><?php echo $complaint_row['sender_id']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.6s">
            <td>Sender Full Name:</td>
            <td class="fname"><?php echo $complaint_row['sender_firstname']; ?></td>
            <td class="lname"><?php echo $complaint_row['sender_lastname']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="0.8s">
            <td>Sender Email:</td>
            <td><?php echo $complaint_row['sender_email']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="1s">
            <td>Sender Username:</td>
            <td><?php echo $complaint_row['sender_username']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="1.2s">
            <td>Complaint Type:</td>
            <td class="type"><?php echo $complaint_row['complaint_type']; ?></td>
          </tr>
          <tr class="wow fadeInRight" data-wow-delay="1.4s">
            <td>Complaint Subject:</td>
            <td class="subject"><?php echo $complaint_row['complaint_subject']; ?></td>
          </tr>
          
          <tr class="message-sent mb-1 wow fadeInRight" data-wow-delay="1.6s">
            <td style="" class="">Message</td>
          </tr>
          <tr class="message-sent wow fadeInRight" data-wow-delay="1.6s">            
            <td class="content ml-3  p-3 position-relative mb-4">
             <?php echo $complaint_row['complaint_message']; ?>
             <small class="time position-absolute" style="color: #cce6ff;">
               <?php echo time_ago(date($complaint_row['date_sent'])); ?>
             </small>
            </td>
          </tr>


          <?php if ($complaint_row['responded'] == 1): ?>                    
          <tr class="response mb-1 wow fadeInLeft" data-wow-delay="1.8s">
            <td class="mr-0">Admin Response</td>
          </tr>
          <tr class="response wow fadeInLeft" data-wow-delay="1.8s">
            <td class="response-content mr-3  p-3 position-relative">
              <?php echo $complaint_row['admin_response']; ?>                  
              <small class="time position-absolute " >
                <?php echo time_ago(date($complaint_row['response_date'])); ?>
              </small> 
            </td>           
          </tr>
          <?php else: ?>
            <tr class="d-flex justify-content-start my-3" >
              <td class="">
                No Response Yet
              </td>
            </tr>
          <?php endif ?>
          <tr class="d-flex justify-content-center mt-5 wow fadeInRight" data-wow-delay="1s">
            <td>
              <a href="complaint_details.php?delete=<?php echo $complaint_row['complaint_id']; ?> "  title="Delete" class="btn btn-danger bi bi-trash"> &nbsp;Delete Complaint</a>
            </td>
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