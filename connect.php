<?php

$con=mysqli_connect('localhost','root','');

   if(!$con)
   {
       echo 'Not connected to server';
   }
if(!mysqli_select_db($con,'uems'))
{
    echo 'database not selected';
}
// Check if the 'admin' table exists, and if not, create it
$createTableSQL = "CREATE TABLE IF NOT EXISTS admin (
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    employeeid VARCHAR(255) NOT NULL PRIMARY KEY,
    emailid VARCHAR(255) NOT NULL,
    securityquestion1 VARCHAR(255) NOT NULL,
    securityquestion2 VARCHAR(255) NOT NULL,
    securityquestion3 VARCHAR(255) NOT NULL,
    pass1 VARCHAR(255) NOT NULL,
    pass2 VARCHAR(255) NOT NULL
)";

if ($con->query($createTableSQL) === TRUE) {
    echo "Table 'admin' created successfully or already exists.";
} else {
    echo "Error creating table: " . $con->error;
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$employeeid = $_POST['employeeid'];
$emailid = $_POST['emailid'];
$secques1 = $_POST['securityquestion1'];
$secques2 = $_POST['securityquestion2'];
$secques3 = $_POST['securityquestion3'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
 

$sql = "INSERT INTO admin (firstname, lastname, employeeid, emailid, securityquestion1, securityquestion2, securityquestion3, pass1, pass2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssssss", $firstname, $lastname, $employeeid, $emailid, $secques1, $secques2, $secques3, $pass1, $pass2);

if ($stmt->execute()) {
    // Registration successful, redirect to signup.html with a success message
    header("Location: login.html?success=Registration%20is%20successful");
} else {
    // Registration failed, redirect to signup.html with an error message
    header("Location: signup.html?error=Registration%20failed");
}

?>
    
    