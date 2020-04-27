<?php
ob_start();
session_start();
$_SESSION['admin_id']=="";
session_unset();
header("location:../index.php");
?>