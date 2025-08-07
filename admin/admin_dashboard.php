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

    
    //mysqli_free_result($result);
    //mysqli_close($db_conn);



   

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
      .font-poppins{font-family: thefont;}
      .font-gotham{font-family: thefont-g;}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      i.bi.complaints,.bi.pending,.bi.total-users,.bi.total-blocked,.bi.total-admin{font-size: 5rem;}
      i.bi.responded{font-size: 5.3rem;}
      .col-3 a.card-options{text-decoration: none;}
      .card:hover{transform: translateY(5px); transition: .2s;}
      .option div h1,h6{font-size: 3.5rem;}
      .brand-color-blue{color: #0000e6;}
      .text-black{color: black;}
      .text-brown{color: #b35900;}
      td.message{max-width: 15rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}
      td.message::first-letter,.subject::first-letter{text-transform: capitalize;}
   
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body>
 <?php include 'side_nav.php'; ?>
 <?php 
  $page= "admin_dashboard";
  ?>
  <div class="main-content">
  <?php 
  //complaint_id, sender_firstname, sender_lastname, sender_username, complaint_subject, complaint_message, responded
   $sql_complaints = 'SELECT * FROM complaints ORDER BY complaint_id DESC  LIMIT 4';
      $complaint_results = mysqli_query($db_conn, $sql_complaints);
      $row_complaints = mysqli_fetch_all($complaint_results, MYSQLI_ASSOC);
      //mysqli_free_result($complaint_results);
      //mysqli_close($db_conn);
      
   ?> 

    <h5 class="mb-1 p-2 border border-left-0 border-right-0 font-weight-bold">Admin Dashboard</h5>

    <div class="row d-flex flex-row justify-content-around mt-3 mb-5">
      
      <div class="col-3 ">
        <a href="all_complaints.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center">
          <div class="col py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                if ($total_complaint = mysqli_num_rows($complaint_results)) {
                  echo $total_complaint;
                }else{echo "0";}

               ?>
            </h1>    
          </div>
          <div class="col d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-envelope complaints text-center text-primary"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Complaints</h6>
        </div>
        </a>
      </div>

      <div class="col-3 ">
        <a href="all_pending.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center" data-wow-delay="0.2s">
          <div class="col py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                $pending_query="SELECT * FROM complaints WHERE responded='0' ";
                $pending_results=mysqli_query($db_conn, $pending_query);
                if ($total_pending = mysqli_num_rows($pending_results)) {
                  echo $total_pending;
                }else{echo "0";}

               ?>
            </h1>
          </div>
          <div class="col d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-clock pending text-warning text-center brand-color"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Pending Complaints</h6>
        </div>
        </a>
      </div>

      <div class="col-3 ">
        <a href="all_responded.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center" data-wow-delay="0.4s">
          <div class="col-7 py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                $responded_query="SELECT * FROM complaints WHERE responded='1' ";
                $responded_results=mysqli_query($db_conn, $responded_query);
                if ($total_responded = mysqli_num_rows($responded_results)) {
                  echo $total_responded;
                }else{echo "0";}

               ?>
            </h1>
            
          </div>
          <div class="col-5 d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-reply responded text-success text-center brand-color"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Responded</h6>
        </div>
        </a>
      </div>

    </div>



    <div class="row d-flex flex-row justify-content-around my-4">
      

      <div class="col-3 ">
        <a href="all_users.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center" data-wow-delay="0.6s">
          <div class="col py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                // $users_query="SELECT * FROM users ";
                // $users_results=mysqli_query($db_conn, $users_query);
                // if ($total_users = mysqli_num_rows($users_results)) {
                //   echo $total_users;
                // }else{echo "0";}

                $user_sql = " SELECT count(id) AS total_users FROM users";
                $users_results = mysqli_query($db_conn, $user_sql);
                $users_values= mysqli_fetch_assoc($users_results);
                $num_users_rows = $users_values['total_users'];
                echo $num_users_rows;
               ?>
            </h1>
          </div>
          <div class="col d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-people total-users text-brown text-center brand-color"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Registered Users</h6>
        </div>
        </a>
      </div>

      <div class="col-3 ">
        <a href="blocked_users.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center" data-wow-delay="0.8s">
          <div class="col py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                // $blocked_query="SELECT * FROM users WHERE blocked='1' ";
                // $blocked_results=mysqli_query($db_conn, $blocked_query);
                // if ($total_blocked = mysqli_num_rows($blocked_results)) {
                //   echo $total_blocked;
                // }else{echo "0";}
                $blocked_sql = " SELECT count(id) AS total_blocked FROM users WHERE blocked='1' ";
                $blocked_results = mysqli_query($db_conn, $blocked_sql);
                $blocked_values= mysqli_fetch_assoc($blocked_results);
                $num_blocked_rows = $blocked_values['total_blocked'];
                echo $num_blocked_rows;

               ?>
            </h1>
          </div>
          <div class="col d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-person-x total-blocked text-danger text-center brand-color"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Blocked Users</h6>
        </div>
        </a>
      </div>

      <div class="col-3 ">
        <a href="all_admins.php" class="card-options">
        <div class="shadow-sm card wow fadeInDown row bg-white d-flex flex-row option justify-content-center" data-wow-delay="1s">
          <div class="col-7 py-4 text-black text-center">
            <h1 class="font-gotham">
              <?php 
                $admin_query="SELECT * FROM admin ";
                $admin_results=mysqli_query($db_conn, $admin_query);
                if ($total_admin = mysqli_num_rows($admin_results)) {
                  echo $total_admin;
                }else{echo "0";}

               ?>
            </h1>            
          </div>
          <div class="col-5 d-flex justify-content-center align-items-center">
            <h1 class=""><i class="bi bi-people-fill total-admin text-info text-center brand-color"></i></h1>
          </div>
          <h6 class="text-muted text-center pb-2">Total Administrators</h6>
        </div>
        </a>
      </div>

    </div>


    <h5 class="mt-5 mb-3 p-2 border border-left-0 border-right-0 font-weight-bold">Recent Complaints</h5>

    <?php 
          
      $sql_complaints = "SELECT * FROM complaints ORDER BY complaint_id DESC  LIMIT 5 ";
      $complaint_results = mysqli_query($db_conn, $sql_complaints);
      //$row_complaints = mysqli_fetch_all($complaint_results, MYSQLI_ASSOC);
    ?>
    <?php if ($total_complaints = mysqli_num_rows($complaint_results)): ?>
    

    <div class="bg-white rounded pb-4">
      
      <table class="table table-hover wow fadeInRight">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Username</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Response Status</th>
            <th scope="col">View Details</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($complaint_results as $complaint ): ?>
          <tr>
            <th scope="row"><?php echo $complaint['complaint_id']; ?></th>
            <td style="text-transform: capitalize;"><?php echo $complaint['sender_firstname'] .' '. $complaint['sender_lastname'] ; ?></td>
            <td><?php echo $complaint['sender_username']; ?></td>
            <td class="subject"><?php echo $complaint['complaint_subject']; ?></td>
            <td class="message" style=" "><?php echo $complaint['complaint_message']; ?></td>
            <td>
              <?php if($complaint['responded'] == 0){echo '<span class="text-warning ">Pending</span>'; }else{ echo '<span class="text-success">Responded</span>'; } ?>
                
            </td>
            <td>
              <a href="view_complaint.php?complaint_id=<?php echo $complaint['complaint_id']; ?>" class="btn btn-primary">View</a>
            </td>
          </tr>
        <?php endforeach ?>
          
        </tbody>
      </table>


    </div>
  
  <?php else: ?>
      <h5 class="text-center">There are no Complaint records</h5>
    <?php endif ?>  

  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>