<?php
ob_start();
session_start();
if(strlen($_SESSION['student_id'])==0)
    {   
header('location:index.php?msg=login');
	}
	include("include/connection.php");
	
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
<p></p>
<p>For a while now, students compeer to form a group to carry out project work however it can be quite challenging because of
 the inability of some persons to contribute towards attainting their project goals, 
this web application would be created to assist individuals with such inabilities identify themselves.
</p>  
<p>A web application would be created for peer assessment in a group project basically to provide a platform for students within each 
group to reflect their work progress, Student in each group would also be able to upload files and retrieve files from the web page database.
 However, the page is strictly built for students within the groups and an administrator who supervises the course work item and also split 
 student into groups for their coursework.</p>
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
