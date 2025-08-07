<?php

  include '../conns/css-links.php';
  include '../database/db_conn.php';


  if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
  }else{
  	$admin_id = $_SESSION['admin_id'];
  	$get_admin = mysqli_query($db_conn, " SELECT * FROM admin WHERE admin_id = '$admin_id' ");
  	$d_admin = mysqli_fetch_assoc($get_admin);
  	$admin_id = $d_admin['admin_id'];
  	$firstname = $d_admin['admin_firstname'];
  	$lastname = $d_admin['admin_lastname'];
  	$admin_email = $d_admin['admin_email'];

   


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style type="text/css">
    	body{margin: 0; padding: 0; background-color: rgba(0,0,0, 0.02); }
    	.side-nav{ width: 20%;	position: fixed; height: 100%; overflow: auto;
			background-color: #161f2b; opacity: ;
		}
		.side-nav a{ color: #fff; display: block;	border: 0;	margin: 0;	text-decoration: none; font-family: verdana; padding: 0.5rem 1.1rem;
			margin: 0.5rem 0; }
		.side-nav a i{ padding-right: 0.8rem;}
		.side-nav a:hover{ padding-left: 1.3rem;	color: orange;	background-color: #202936; }


		.main-content{	margin-left: 20%; padding: 2%;	}
		.profile{ display: flex;  flex-direction: column; margin-top: 10%; }
		.profile h1{/**text-transform: uppercase;  border-radius: 50%; display: block;  box-shadow: 0px 1px 3px  rgba(0,0,0, 0.1); padding: 0.1 1.1rem; background-color: #202936;*/  font-size: 3.7rem;  color: orange; text-shadow: 0px 1px 12px  rgba(0,0,0, 0.2);}
		.profile h5{text-transform: capitalize; color: white;}
		a.link-active{border-left: 4px solid orange; background-color: #202936; color: orange;}
		.bi{font-size: 1.2rem;}
		.bi-person, .bi-reply{font-size: 1.3rem;}

    </style>
    
</head>
<body>
    		
		<nav class="side-nav">

			<div class="profile">

				<h1 class="text-center mx-auto mb-0 hshadow-sm bi bi-person-circle"><?php //str_split($firstname); echo $firstname[0];  ?></h1>
				<h5 class=" text-center pt-2 full-name"><?php echo $firstname; ?></h5>
				
			</div>




			<a href="admin_dashboard.php" class="option-links <?php echo(basename($_SERVER['PHP_SELF'])=="admin_dashboard.php")?"link-active":""     //if($page='user_dashboard'){echo 'link-active';}else{echo '';} ?>" id="defaultopen"><i class="bi bi-speedometer2"></i><span>Dashboard</span></a>

			<a href="admin_profile.php" class="<?php echo(basename($_SERVER['PHP_SELF'])=="admin_profile.php")?"link-active":""  ?>" ><i class="bi bi-person-circle"></i><span>Admin Profile</span></a>

			<a href="admin_signup.php" class="<?php echo(basename($_SERVER['PHP_SELF'])=="admin_signup.php")?"link-active":""  ?>"><i class="bi bi-person-plus"></i><span>Add Administrator</span></a>

			<a href="all_complaints.php" class="<?php echo(basename($_SERVER['PHP_SELF'])=="all_complaints.php")?"link-active":""  ?>"><i class="bi bi-envelope"></i><span>View Complaints</span></a>

			<a href="all_pending.php" class="<?php echo(basename($_SERVER['PHP_SELF'])=="all_pending.php")?"link-active":""  ?>"><i class="bi bi-clock"></i><span>Pending</span></a>

			<a href="all_responded.php" class="<?php echo(basename($_SERVER['PHP_SELF'])=="all_responded.php")?"link-active":""  ?>"><i class="bi bi-reply"></i><span>Responded</span></a>
			
			<a href="logout.php" name="sign"><i class="bi bi-box-arrow-left "></i><span>Log Out</span></a>
			
		</nav>
		<?php //$_SESSION['admin_id'] = $id; ?>

	





<?php 
}
/*else: ?>
   <h2>No Such User Exists!</h2>
<?php endif */?>
	

</body>
</html>