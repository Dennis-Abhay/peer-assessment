<?php
ob_start();
session_start();
if(strlen($_SESSION['admin_id'])==0)
    {   
header('location:../index.php?msg=login');
	}
	include("../include/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin|Dashboard</title>
<meta content="device-width" initial-scale="1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>
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
<li><a href="about.php">About</a></li>
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
<p><a href="individual_work.php">individual work</a></p>
</div>
<div class="col-sm-10">
<div class="row" style="border-bottom-color:#00FFFF;border-bottom-style:solid;border-width:2px;" >
<div class="col-sm-3">
Setup Coursework
</div>
<div class="col-sm-3">
Group Course
</div>
<div class="col-sm-6">
</div>
</div>
<div class="row">
<div class="col-sm-3">
Details of New Course Work
<?php
$query6="SELECT COUNT(*) AS num FROM `course_work`";
$result6 =mysql_query($query6);
$fetch_group6=mysql_fetch_array($result6);
echo "<p>All Works <span class='badge'>".$fetch_group6['num']."</span></p>";
?>
</div>
<div class="col-sm-3">
<?php
$query2="SELECT * FROM `groups`";
$result2 =mysql_query($query2);
while($fetch_group=mysql_fetch_array($result2))
{
	echo "<p><a href='?id=". $fetch_group['id']."'>GROUP ".$fetch_group['name']."</a></p>";
}
?>
</div>
<div class="col-sm-6">
<p>Names:</p>
<?php
if(isset($_GET['id']))
{
$group_student=$_GET['id'];
$query3="SELECT * FROM `assigned_student` WHERE group_id='$group_student'";
$result3 =mysql_query($query3);
while($fetch_group3=mysql_fetch_array($result3))
{
	$std_id=$fetch_group3['student_id'];
	$query4="SELECT * FROM `student` WHERE id='$std_id'";
$result4 =mysql_query($query4);
$fetch_group4=mysql_fetch_array($result4);
	echo "<p>".$fetch_group4['name']."</p>";
}
}
?>
<div style="border:1px solid #00FFFF;" class="col-sm-offset-8">
<p></p>
<p class="text-center"><a href="add_student.php">Add New Student</a></p>
<p class="text-center"><a href="assign_group.php">Assign Group</a></p>
</div>
</div>
</div>
</div>
</div>
<div class="row" style="background:#00FFFF;">
<div class="col-sm-2">
<a href="../contact_home.php">Contact Admin</a>
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
