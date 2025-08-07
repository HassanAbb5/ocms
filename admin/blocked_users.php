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
<?php 
 
  $results_per_page= 1;

  $sql_page= "SELECT * FROM users WHERE blocked = '1' ";
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
<?php $admin_id = $_SESSION['admin_id']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main_styles.css">
    <style type="text/css">
      body{background-color: white;}
      @font-face{ font-family: thefont; src: url(../fonts/poppins-font/Poppins-Medium.ttf);}
       @font-face{ font-family: thefont-g; src: url(../fonts/gotham-font/GothamMedium.ttf);}
      .font-poppins{font-family: thefont;}
      .font-gotham{font-family: thefont-g;}
      *{box-sizing: border-box; font-size: ; font-family: thefont;}
      .fadeInRight, .fadeInLeft, .fadeInDown{animation-duration: ;}
      i.bi.complaints,.bi.pending{font-size: 5rem;}
      i.bi.responded{font-size: 5.3rem;}
      td.firstname::first-letter,.lastname::first-letter{text-transform: capitalize;}
   
     
    </style>
    <title>Online Complaint Management System</title>
</head>
<body>
 <?php include 'side_nav.php'; ?>
 <?php 
  $page= "blocked_users";
  ?>
  <div class="main-content" >
    
    <div class="bg-white rounded py-4">
      <div>
        <a href="admin_dashboard.php" class="btn btn-primary ml-4"><i class="fa fa-angle-double-left"></i> Back</a>

      <h2 class="mb-4 p-2 text-center wow fadeInDown">Blocked Users</h2>
      </div>


    
      <?php 
        $user_query="SELECT * FROM users WHERE blocked = '1'  ORDER BY id  LIMIT ". $the_page_first_result . ',' . $results_per_page;
         $user_results=mysqli_query($db_conn, $user_query);
     /* ?>
  <?php */ if ( mysqli_num_rows($user_results) > 0): ?>

           

          <table class="table table-hover wow fadeIn ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Block Status</th>
            <th scope="col">View Details</th>
          </tr>
        </thead>
        <tbody>
        
        <?php  while ($user = mysqli_fetch_assoc($user_results)){ ?>
          <tr>
            <th scope="row">
              <?php 
                echo $user['id'];
                //$_SESSION['users_id'] = $user['id'];
              ?>
            </th>
            <td class="firstname">
              <?php 
                echo $user['firstname'] ;
              ?>                
            </td>
            <td class="lastname">
              <?php echo $user['lastname']; ?>  
            </td>
            <td class="">
              <?php echo $user['username']; ?>  
            </td>
            <td class="">
              <?php echo $user['email']; ?>
            </td>
            <td class="">
              <?php
                 if ($user['blocked'] == 0) {
                    echo "<span class='text-success'>Not Blocked</span>";
                  }else{
                    echo "<span class='text-danger'>Blocked</span>";
                  } 
              ?>
            </td>
            <td>
              <a href="view_user.php?user_id=<?php echo $user['id']; ?>" class="btn btn-primary">View</a>
            </td>
          </tr>
        <?php } ?>
          
        </tbody>
      </table>



      <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">

    <li class="page-item <?php if($_GET['page'] <= 1){echo 'disabled';}else{echo '';} ?>">
    <a class="page-link " href="blocked_users.php?page=<?php echo $previous; ?> "><?php //if($page <= 1){echo "";}else{echo "previous";} ?>Previous</a>
    </li>

    <?php for ($page=1; $page <= $number_of_pages ; $page++) { ?>
        
        <li class="page-item <?php if($_GET['page']==$page){echo 'active';}else{echo '';} ?> ">
        <a class="page-link " href="blocked_users.php?page=<?php echo $page; ?> "><?php echo $page; ?></a>
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
    <a class="page-link" href="blocked_users.php?page=<?php echo $next; ?> "> <?php //if ($page >= $number_of_pages){ echo ''; }else{echo "Next";} ?>Next</a>
    </li>

    </ul>
    </nav>

      

      <?php else: ?>
          <h5 class="text-center">There are no blocked Users!</h5>
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