<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uems";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];
$bannerid=$_POST['bannerid'];


$sql = "UPDATE student SET pass1='$pass1', pass2='$pass2' WHERE bannerid='$bannerid'";


if (mysqli_query($conn, $sql)) {
    echo "Password changed successfully";
    exit(header("refresh:1;url=Student_login.html"));
} else {
    echo "Error updating record: " . mysqli_error($conn);
    exit(header("refresh:1;url=stu_change.html"));
}

mysqli_close($conn);
?>