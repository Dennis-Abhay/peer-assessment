<?php
ob_start();
session_start();
if(strlen($_SESSION['recovered_id'])==0)
    {   
header('location:forget_password.php?msg=login');
	}
	include("include/connection.php");
if(isset($_POST['change']))
{
	//student query
	$password=mysql_escape_string($_POST['password']);
	$cpassword=mysql_escape_string($_POST['cpassword']);
	$std_id=$_SESSION['recovered_id'];
	if($password==$cpassword)
	{
		$md5p=mysql_escape_string(md5($_POST['password']));
		$query = "UPDATE student SET password='$md5p' WHERE id='$std_id'";
			$result = mysql_query($query)or die(mysql_error());
			if($result)
		 {
                   session_unset();
				   header("location:index.php?cmsg=1");
				   
		 }
		 else{
			 $msg="Password not Changed";
		 }
	}
	else{
		$msg="Password Not Match";
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Change password</title>
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
		?>

<div class="row" style="background:#00FFFF;">
<div class="col-sm-12">
<h4>WEB APPLICATION TO ACCESS PEER ASSESMENT IN GROUP PROJECT</h4>
</div>
</div>
<div class="row" style="margin-top:10%;margin-bottom:10%;">
<div class="col-sm-8">
<?php
$std_ids=$_SESSION['recovered_id'];
$query2 = "SELECT * FROM student WHERE id='$std_ids' ";
			$result2 = mysql_query($query2)or die(mysql_error());
			$row2 = mysql_fetch_array($result2);
		echo "<p class='text-center text-danger'>Your Username is ".$row2['username']."</p>";
?>
<form class="form-horizontal col-sm-offset-4" role="form" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">New Password:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="username" name="password" placeholder="Enter New Password" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Confirm Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" name="cpassword" id="pwd" placeholder="Confirm password" required>
    </div>
  </div>
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" name="change">Verify</button>
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
