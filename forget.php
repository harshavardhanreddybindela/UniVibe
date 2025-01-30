<?php
$employeeid=$_POST['employeeid'];
$securityquestion1=$_POST['securityquestion1'];
$securityquestion2=$_POST['securityquestion2'];
$securityquestion3=$_POST['securityquestion3'];

$connection = mysqli_connect('localhost','root','','uems');
if($connection->connect_error)
{
	die("database connection failed: " . $connection->connect_error);
}
$select_db=mysqli_select_db($connection,'uems');
if(!$select_db)
{
	die("database selection failed".mysqli_error($connection));
}

$query="SELECT  employeeid,securityquestion1,securityquestion2,securityquestion3 FROM admin WHERE employeeid='$employeeid' and securityquestion1='$securityquestion1' and securityquestion2='$securityquestion2' and securityquestion3='$securityquestion3'";
	$result=mysqli_query($connection,$query) or die(mysqli_error($connection));
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		echo "Authenticated";
        exit(header("refresh:1;url=change.html"));
	}
	else
		echo "Invalid Details";
        exit(header("refresh:1;url=forgot.html"));
?>
