<?php
session_start();
include("include/connection.php");
if(isset($_POST['add']))
	{
		$sname=mysql_real_escape_string($_POST['sname']);
	   $matric=mysql_real_escape_string($_POST['matric']);
	   $email=mysql_real_escape_string($_POST['email']);
	   $username=mysql_real_escape_string($_POST['username']);
	   $password=mysql_real_escape_string(md5($_POST['password']));
	   $query = "SELECT * FROM student WHERE username='$username' OR email='$email' OR matric_no='$matric'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
			if( $num_row > 0 ) { 
		$msg="username or email or matric already added try to add another Username or Email or Matric Number?";
		}
		 else{ 
		 $query2="INSERT INTO student(name,username,password,email,matric_no) VALUES('$sname','$username','$password','$email','$matric')";
		 $result2=mysql_query($query2);
		 if($result2)
		 {
				$msg="Student Added Successfully";
		 }
		 else{
			 $msg="Student not Added";
		 }
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
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
    <label class="control-label col-sm-2" for="username">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="sname" placeholder="Enter Student Name" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" class="form-control" name="email" id="pwd" placeholder="Enter Email" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Matric No:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" name="matric" id="pwd" placeholder="Enter Matric no" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Username:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" name="username" id="pwd" placeholder="Enter Username" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="text" class="form-control" name="password" id="pwd" placeholder="Enter Password" required>
    </div>
  </div>
  
  <div class="form-group"> 
    
  </div>
  <div class="form-group col-sm-7"> 
    <div class="col-sm-offset-12 col-sm-10">
      <button type="submit" class="btn btn-default" name="add">Register</button>
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
