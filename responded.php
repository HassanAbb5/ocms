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

    //mysqli_free_result($result);
    //mysqli_close($db_conn);

?>
<?php 
  $user_id = $_SESSION['id'];
  $results_per_page= 5;

  $sql_page= "SELECT * FROM complaints WHERE sender_id = $user_id AND responded='1' ";
  $sql_result= mysqli_query($db_conn, $sql_page );
  $number_of_results= mysqli_num_rows($sql_result);

  $number_of_pages = ceil($number_of_results/$results_per_page);


  if (!isset($_GET['page'])) {
    $page = 1;
  }else{
    $page = $_GET['page'];
  }

  $previous = $page-1;
  $next = $page+1;

  $the_page_first_result = ($page-1) * $results_per_page;
 ?>
<?php //$user_id = $_SESSION['id']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_styles.css">
    <style type="text/css">
      body{background-color: white;}
      @font-face{ font-family: thefont; src: url(fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: thefont-g; src: url(fonts/gotham-font/GothamMedium.ttf);}
      .font-poppins{font-family: thefont;}
      .font-gotham{font-family: thefont-g;}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      i.bi.complaints,.bi.pending{font-size: 5rem;}
      i.bi.responded{font-size: 5.3rem;}
      td.message{max-width: 15rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;}
      td.message::first-letter,.subject::first-letter{text-transform: capitalize;}
   
     
    </style>
    <title>Pending Complaints</title>
</head>
<body>
 <?php include 'side_nav.php'; ?>
 <?php 
  $page= "responded";
  ?>
  <div class="main-content" >
    
    <div class="bg-white rounded py-4 ">
    <h2 class="p-2 mb-3 text-center wow fadeInDown">Responded Complaints</h2>


    
      <?php 
        $complaints_query="SELECT * FROM complaints WHERE sender_id = $user_id AND responded='1' ORDER BY complaint_id DESC  LIMIT ". $the_page_first_result . ',' . $results_per_page;
         $complaints_results=mysqli_query($db_conn, $complaints_query);
      ?>
        <?php if (mysqli_num_rows($complaints_results) > 0): ?> 
            

          <table class="table table-hover wow fadeInRight ">
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
        
        <?php foreach ($complaints_results as $complaint ): ?>
          <tr>
            <th scope="row">
              <?php echo $complaint['complaint_id']; ?>
            </th>
            <td style="text-transform: capitalize;">
              <?php 
                echo $complaint['sender_firstname'] .' '. $complaint['sender_lastname'] ;
              ?>
                
            </td>
            <td>
              <?php echo $complaint['sender_username']; ?>
                
            </td>
            <td class="subject">
              <?php echo $complaint['complaint_subject']; ?>
            </td>
            <td class="message">
              <?php echo $complaint['complaint_message']; ?>
                
            </td>
            <td>
              <?php if($complaint['responded'] == 0): ?>
                <span class="text-warning ">Pending</span>
              <?php else: ?>
                <span class="text-success">Responded</span>
              <?php endif ?>
              </td>
            <td><a href="complaint_details.php?complaint_id=<?php echo $complaint['complaint_id']; ?>" class="btn btn-primary">View</a></td>
          </tr>
        <?php endforeach ?>
          
        </tbody>
      </table>



      <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">

    <li class="page-item <?php if($_GET['page'] <= 1){echo 'disabled';}else{echo '';} ?>">
    <a class="page-link " href="responded.php?page=<?php echo $previous; ?> "><?php //if($page <= 1){echo "";}else{echo "previous";} ?>Previous</a>
    </li>

    <?php for ($page=1; $page <= $number_of_pages ; $page++) { ?>
        
        <li class="page-item <?php if($_GET['page']==$page){echo 'active';}else{echo '';} ?> ">
        <a class="page-link " href="responded.php?page=<?php echo $page; ?> "><?php echo $page; ?></a>
        </li>
        
    <?php } ?>
    <?php 
    if (!isset($_GET['page'])) {
        $page = 1;
      }else{
        $page = $_GET['page'];
      }
     ?>

    <li class="page-item <?php if($page >= $number_of_pages){echo 'disabled';}else{echo '';} ?>">
    <a class="page-link" href="responded.php?page=<?php echo $next; ?> "> <?php //if ($page >= $number_of_pages){ echo ''; }else{echo "Next";} ?>Next</a>
    </li>

    </ul>
    </nav>



      <?php else: ?> 
        <h5 class="text-center">Your complaints have not been responded to yet</h5>
      <?php endif ?>

      <!-- ?> -->
      
      

    </div>



  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>