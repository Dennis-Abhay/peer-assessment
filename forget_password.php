<?php
session_start();
include("include/connection.php");
if(isset($_POST['verify']))
{
	//student query
	$matric=mysql_escape_string($_POST['matric']);
	$email=mysql_escape_string($_POST['email']);
	$query = "SELECT * FROM student WHERE matric_no='$matric' AND email='$email'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
	//check user
			if( $num_row > 0 ) { 
		$_SESSION['recovered_id']=$row['id'];
		header('location:change_password.php');
		}
		 else{ 
				$msg="invalid email or matric number";
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Forgot password</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head>
<body>
<div class="container">
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
  <strong>Incorrect Credential</strong>
</div>
";}
	?>

<div class="row" style="background:#00FFFF;">
<div class="col-sm-12">
<h4>WEB APPLICATION TO ACCESS PEER ASSESMENT IN GROUP PROJECT</h4>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:10%;">
<div class="col-sm-8">
<form class="form-horizontal col-sm-offset-4" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Matric Number:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="matric" placeholder="Enter Matric Number" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" class="form-control" name="email" id="pwd" placeholder="Enter Email" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" name="verify">Verify</button>
    </div>
  </div>
</form>
<div class="col-sm-offset-8 col-sm-10">
<p><a href="index.php">Back</a></p>
</div>
</div>
</div>
<div class="row" style="background:#00FFFF;">
<div class="col-sm-2">
<a href="">Contact Admin</a>
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
