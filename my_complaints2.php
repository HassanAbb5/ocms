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

  $sql_page= "SELECT * FROM complaints WHERE sender_id = $user_id  ";
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

  $sql_page_result = "SELECT * FROM complaints WHERE sender_id = $user_id  ORDER BY complaint_id DESC LIMIT ". $the_page_first_result . ',' . $results_per_page;
  $page_result= mysqli_query($db_conn, $sql_page_result);
 ?>
<?php $user_id = $_SESSION['id']; ?>
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
      .pa-link:active{text-decoration: underline; color: black;}
      .pa-link:visited{text-decoration: underline; }
   
     
    </style>
    <title>User Complaints</title>
</head>
<body>
 <?php include 'side_nav.php'; ?>
 <?php 
  $page= "my_complaints";
  ?>
  <div class="main-content">
    
    <div class="bg-white rounded mx-2 p-3">
    <h2 class="my-4 p-2 text-center wow fadeInDown">My Complaints</h2>


    <?php if (/*$total_complaints = mysqli_num_rows($page_result)*/ $number_of_results > 0): ?>
    
      
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

        <?php while ($complaint = mysqli_fetch_array($page_result)) { ?>
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
            <td>
              <a href="complaint_details.php?complaint_id=<?php echo $complaint['complaint_id']; ?>" class="btn btn-primary">View</a>
            </td>
          </tr>
        <?php } ?>
          
        </tbody>
      </table>



      <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">

    <li class="page-item <?php if($_GET['page'] <= 1){echo 'disabled';}else{echo '';} ?>">
    <a class="page-link " href="my_complaints2.php?page=<?php echo $previous; ?> "><?php //if($page <= 1){echo "";}else{echo "previous";} ?>Previous</a>
    </li>

    <?php for ($page=1; $page <= $number_of_pages ; $page++) { ?>
        
        <li class="page-item <?php if($_GET['page']==$page){echo 'active';}else{echo '';} ?> ">
        <a class="page-link " href="my_complaints2.php?page=<?php echo $page; ?> "><?php echo $page; ?></a>
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
    <a class="page-link" href="my_complaints2.php?page=<?php echo $next; ?> "> <?php //if ($page >= $number_of_pages){ echo ''; }else{echo "Next";} ?>Next</a>
    </li>

    </ul>
    </nav>



    <?php else: ?>
      <h5 class="text-center">You have not made any Complaints yet</h5> 
    <?php endif ?>  



    


    </div>



  </div>
    
</body>

<?php include 'conns/js-links.php'; ?>
<script type="text/javascript">
    new WOW().init();
</script>
</html>