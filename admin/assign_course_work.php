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
		$work=$_POST['work'];
		$query = "SELECT * FROM `groups` WHERE id='$group'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			$group_name="Group ".$row['name'];
		
		 $query2="INSERT INTO `course_work` (`group_id`,`work`) VALUES ('$group','$work')";
		 $result2=mysql_query($query2);
		 if($result2)
		 {
				$msg="Course Work Assign to ".$group_name;
		 }
		 else{
			 $msg="Course Work not Assign";
		 }
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin|Assign course work</title>
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
<li>Group</li>
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
<p>Course Work Upload</p>
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
  <div class="form-group col-sm-10">
    <label class="control-label col-sm-3" for="work">Course Work:</label>
    <div class="col-sm-8">
      <textarea class="form-control"  id="work" name="work" required></textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-10">
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
