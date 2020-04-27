<?php
ob_start();
session_start();
if(strlen($_SESSION['admin_id'])==0)
    {   
header('location:../index.php?msg=login');
	}
	include("../include/connection.php");
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
<title>Admin|Add Student</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</head>
<body>
<div class="container-fluid">
<div class="row" style="background:#00FFFF;">
<div class="col-sm-8">
<h4>WEB APPLICATION TO ACCESS PEER ASSESMENT IN GROUP PROJECT</h4>
</div>
<div class="col-sm-4">
<div class="page-header">
<ul class="list-inline">
<li><a href="index.php">Home</a></li>
<li>About</li>
<li><a href="groups.php">Group</a></li>
<li class="col-sm-offset-4"><a href="logout.php">Sign out</a></li>
</ul>
</div>
</div>
</div>
<div class="row">
<?php
$admin_id=$_SESSION['admin_id'];
$query = "SELECT * FROM admin WHERE id='$admin_id'";
		$result = mysql_query($query)or die(mysql_error());
		$row = mysql_fetch_array($result);
	
?>

<div class="col-sm-2" style="border-right-color:#00FFFF;border-right-style:solid;border-width:2px;">
<p></p>
<p>Details</p>
<p>Name: <?php echo $row['name'];?><br><strong>Admin</strong></p>
<p>Email: <?php echo $row['email'];?></p>
<p>Activity</p>
<p><a href="work_upload.php">Course Work Upload</a></p>
<p><a href="assign_student_group.php">Assign New Student into Group</a></p>
<p><a href="assign_course_work.php">Assign Course Work</a></p>
</div>
<div class="col-sm-10">
<div class="row">
<p></p>
<?php
if(isset($msg))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$msg."</strong>
</div>
";}
?>
<form class="form-horizontal col-sm-offset-2" role="form" method="post">
  <div class="form-group col-sm-8">
    <label class="control-label col-sm-2" for="name">Name:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="name" name="sname" placeholder="Enter Student Name" required>
    </div>
  </div> <div class="form-group col-sm-8">
    <label class="control-label col-sm-2" for="matric">Matric No:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  id="matric" name="matric" placeholder="Enter Matric Number" required>
    </div>
  </div>
  <div class="form-group col-sm-8">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email"  name="email" placeholder="Enter email" required>
    </div>
  </div>
  <div class="form-group col-sm-8">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
    </div>
  </div>
  <div class="form-group col-sm-8">
    <label class="control-label col-sm-2" for="pwd">Password:</label>
    <div class="col-sm-10"> 
      <input type="password" class="form-control" id="pwd" name="password" placeholder="Enter password" required>
    </div>
  </div>
 
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="add">Submit</button>
    </div>
  </div>
</form>
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
