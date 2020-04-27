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
		$report=$_POST['report'];
		$std_id=$_SESSION['student_id'];
		$query = "SELECT * FROM assigned_student WHERE student_id='$std_id'";
		$result = mysql_query($query)or die(mysql_error());
		$row = mysql_fetch_array($result);
         $group_id=$row['group_id'];
		 $date=date("Y/m/d");
		 $query2="INSERT INTO report(student_id,group_id,report,date) VALUES('$std_id','$group_id','$report','$date')";
		 $result2=mysql_query($query2);
		 if($result2)
		 {
				$msg="Report Submit Successfully";
		 }
		 else{
			 $msg="Report not Submit";
		 }
		 
	}
	if(isset($_POST['upload']))
{
	$imgFile = $_FILES['images']['name'];
		$tmp_dir = $_FILES['images']['tmp_name'];
		$imgSize = $_FILES['images']['size'];
		$upload_dir = 'uploads/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
			// rename uploading image
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions)){
			if($imgSize < 200000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else{
					$fmsg = "Sorry, your file is too large.";
				}
                     }
			else{
				$f2msg = "Sorry, only JPG, JPEG, PNG are allowed.";	     			
			}
			if(!isset($fmsg) && !isset($f2msg))
		{
			$std_id=$_SESSION['student_id'];
			$student_files="uploads/".$userpic;
			$query = "SELECT * FROM assigned_student WHERE student_id='$std_id'";
		$result = mysql_query($query)or die(mysql_error());
		$row = mysql_fetch_array($result);
         $group_id=$row['group_id'];
		 $date=date("Y/m/d");
			$query5="INSERT INTO uploads(student_id,group_id,image,date) VALUES('$std_id','$group_id','$student_files','$date')";
		    $result5=mysql_query($query5);
			if($result5)
	{
		$msg="image upload sucessfully";
		
	}
	else
	{
		
		$msg="image not uploaded";
	}
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
if(isset($fmsg))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$fmsg."</strong>
</div>
";}
if(isset($f2msg))
	{ echo "<div class='alert alert-danger text-center'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>".$f2msg."</strong>
</div>
";}
?>
<div class="row">
<form role="form" method="post">
  <div class="form-group col-sm-8 col-sm-offset-2">
  <p></p>
  <label for="comment">Group Report Submit Box:</label>
  <textarea class="form-control" rows="5" id="comment" name="report"></textarea>
</div>
<div class="form-group col-sm-5 col-sm-offset-2">
<button type="submit" class="btn btn-default form-control" name="submit">Submit</button>
</div>
</form>
</div>
<div class="row" style="margin-bottom:2%;">
<div class="col-sm-offset-2">
<label for="comment">Upload Image:</label>
<form role="form" class="form-inline" method="post" enctype="multipart/form-data">
  <input class="form-control" type="file" name="images" accept=".jpeg,.jpg,.png">
<button type="submit" class="btn btn-default form-control" name="upload">Submit</button>
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
