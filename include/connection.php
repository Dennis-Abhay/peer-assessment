<?php
$dbserver="localhost";
$dbuser="root";
$dbpassword="";
$conn=mysql_connect($dbserver,$dbuser,$dbpassword);
if(!$conn)
{
	echo "cannot connect to database";
}
mysql_select_db("web");
?>