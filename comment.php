<?php
ob_start();
session_start();
if(strlen($_SESSION['student_id'])==0)
    {   
header('location:index.php?msg=login');
	}
	include("include/connection.php");
	if(isset($_POST['submit']))
	{
		$comment=$_POST['comment'];
		$std_id=$_SESSION['student_id'];
		$report_id=$_GET['report'];
		$date=date("Y/m/d");
		 $query2="INSERT INTO comment(student_id,report_id,comments,date) VALUES('$std_id','$report_id','$comment','$date')";
		 $result2=mysql_query($query2);
		 if($result2)
		 {
				$msg="Done";
		 }
		 else{
			 $msg="Not comment";
		 }
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Student|Dashboard</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

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
<li><a href="dashboard.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="group.php">Group</a></li>
<li class="col-sm-offset-4"><a href="logout.php">Sign out</a></li>
</ul>
</div>
</div>
</div>
<div class="row">
<?php
$student_id=$_SESSION['student_id'];
$query = "SELECT * FROM student WHERE id='$student_id'";
		$result = mysql_query($query)or die(mysql_error());
		$row = mysql_fetch_array($result);
	
?>

<div class="col-sm-2" style="border-right-color:#00FFFF;border-right-style:solid;border-width:2px;">
<p></p>
<p>Details</p>
<p>Name: <?php echo $row['name'];?></p>
<p>Email: <?php echo $row['email'];?></p>
<?php
$query_group = "SELECT * FROM assigned_student INNER JOIN groups ON assigned_student.group_id=groups.id WHERE student_id='$student_id'";
		$result_group = mysql_query($query_group)or die(mysql_error());
		$row_group = mysql_fetch_array($result_group);?>
 <p>GROUP <?php echo $row_group['name'];?></p>
<p>Activity</p>
<p><a href="report_review.php">Report Review</a></p>
<p><a href="uploaded_image.php">Image Upload</a></p>
</div>
<div class="col-sm-10">
<?php					
  if(isset($msg))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$msg."</strong>
</div>
";}
?>
<div class="row">
<form role="form" method="post">
  <div class="form-group col-sm-6 col-sm-offset-2">
  <p></p>
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
</div>
<div class="form-group col-sm-3 col-sm-offset-4">
<button type="submit" class="btn btn-default form-control" name="submit">Comment</button>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="row" style="background:#00FFFF;">
<div class="col-sm-2">
<a href="contact.php">Contact Admin</a>
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
