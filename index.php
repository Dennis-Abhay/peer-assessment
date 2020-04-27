<?php
session_start();
include("include/connection.php");
if(isset($_POST['login']))
{
	//student query
	$username=mysql_escape_string($_POST['username']);
	$password=mysql_escape_string(md5($_POST['password']));
	$query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
			//admin query
			$query_admin = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
			$result_admin = mysql_query($query_admin)or die(mysql_error());
			$row_admin = mysql_fetch_array($result_admin);
			$num_row_admin = mysql_num_rows($result_admin);
	//check user
			if( $num_row > 0 ) { 
		$_SESSION['student_id']=$row['id'];
		header('location:dashboard.php');
		}
		elseif( $num_row_admin > 0 ) { 
		$_SESSION['admin_id']=$row_admin['id'];
		header('location:admin/index.php');
		}
		 else{ 
				$msg="invalid username or password";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style type="text/css">
body{
	background:url("index.jpg");
	background-size:cover;
	background-repeat:none;
}
</style>
</head>
<body>
<div class="container-fluid">
<?php
						
  if(isset($msg))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$msg."</strong>
</div>
";}
if(isset($_GET['msg']))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>You have to login</strong>
</div>
";}
if(isset($_GET['cmsg']))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Password Changed Successfully</strong>
</div>
";}
		?>

<div class="row" style="background:#00FFFF;">
<div class="col-sm-12">
<h4>WEB APPLICATION TO ACCESS PEER ASSESMENT IN GROUP PROJECT</h4>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:10%;">
<div class="col-sm-6">
<h4 style="color:black;">PURPOSE OF GROUP WORK</h4>
<ul>
<li style="color:white;">Better Work</li>
</ul>
</div>
<div class="col-sm-6">
<form class="form-horizontal col-sm-offset-2" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" name="login">Login</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-8 col-sm-10">
<p><a href="forget_password.php">Forgotten password?</a></p>
<p><a href="register.php">Dont have account</a></p>
</div>
</div>
</div>
<div class="row" style="background:#00FFFF;">
<div class="col-sm-2">
<a href="contact_home.php">Contact Admin</a>
</div>
<div class="col-sm-2">
<a href="">Privacy Policy</a>
</div>
<div class="col-sm-8 text-right">
<p>&copy;2020 All right Reserved</p>
</div>
</div>
</body>
</html>
