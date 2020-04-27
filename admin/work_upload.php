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
		$group=$_POST['group'];
		$student_id=$_POST['student'];
	   $query = "SELECT * FROM `assigned_student` WHERE student_id='$student_id'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$num_row = mysql_num_rows($result);
			if( $num_row > 0 ) { 
		$msg="student already assigned to a group try another student?";
		}
		 else{ 
		 $query2="INSERT INTO `assigned_student` (`student_id`,`group_id`) VALUES ('$student_id','$group')";
		 $result2=mysql_query($query2);
		 if($result2)
		 {
				$msg="Student Assign Successfully";
		 }
		 else{
			 $msg="Student not Assign";
		 }
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin|Course work Upload</title>
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
  <div class="form-group col-sm-10">
    <label class="control-label col-sm-3" for="name">Group Name:</label>
    <div class="col-sm-8">
      <select class="form-control"  id="name" name="group"required>
	  <?php 
		  $q="SELECT * FROM `groups`";
		  $row_group=mysql_query($q);
		  while($fetch_group=mysql_fetch_array($row_group))
		  {
			  ?>
			  <option value="<?php echo $fetch_group['id'];?>"><?php echo $fetch_group['name'];?></option>
		 <?php }
	  ?>
	  </select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-10">
      <button type="submit" class="btn btn-default" name="fetch">Fetch</button>
    </div>
  </div>
</form>
</div>
</div>
<div class="col-sm-10">
<div class='row'>
<?php
if(isset($_POST['fetch']))
{
  $gid=$_POST['group'];
  $query_report = "SELECT * FROM uploads INNER JOIN student ON uploads.student_id=student.id WHERE group_id='$gid'";
		$result_report = mysql_query($query_report)or die(mysql_error());
		while($row_report = mysql_fetch_array($result_report))
		{
			echo "
			<p></p>
  <div class='col-md-4'>
    <a href='../".$row_report['image']."' class='thumbnail'>
      <p>Uploaded By:".$row_report['name']."/".$row_report['date']."</p> 
      <img src='../".$row_report['image']."' alt='FILES' style='width:150px;height:150px'>
    </a>
  </div>
";
		}
}?>
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
