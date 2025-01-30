<?php
$emailid=$_POST['emailid'];
$pass1=$_POST['pass1'];
	

$connection = mysqli_connect('localhost','root','','uems');
if(!$connection)
{
	die("database connection failed".mysqli_error($connection));
}
$select_db=mysqli_select_db($connection,'uems');
if(!$select_db)
{
	die("database selection failed".mysqli_error($connection));
}

$query="SELECT  emailid,pass1 FROM student WHERE emailid='$emailid' and pass1='$pass1'";
	$result=mysqli_query($connection,$query) or die(mysqli_error($connection));
	$count=mysqli_num_rows($result);
	if($count>0)
	{
		echo "Login successful";
		exit(header("refresh:1;url=events_display.php"));
	}
	else
		echo "Invalid login";
		exit(header("refresh:1;url=Student_login.html"));
?>
