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
$createTableSQL = "CREATE TABLE IF NOT EXISTS event (
    eventid INT AUTO_INCREMENT PRIMARY KEY,
    eventname VARCHAR(255) NOT NULL,
    noofparticipants VARCHAR(255) NOT NULL,
    event_time TIME,
    event_date DATE,
    venue VARCHAR(255) NOT NULL,
    eventdescription TEXT NOT NULL,
    imagepath TEXT NOT NULL,
    filename TEXT NOT NULL
)";

if ($con->query($createTableSQL) === TRUE) {
    echo "Table 'event' created successfully or already exists.";
} else {
    echo "Error creating table: " . $con->error;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded successfully
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      // Get file information
      $fileName = $_FILES['image']['name'];
      $fileType = $_FILES['image']['type'];
      $fileTempName = $_FILES['image']['tmp_name'];
      $fileSize = $_FILES['image']['size'];
  
      // Check file type and size
      if ($fileSize > 0 && in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
        // Generate a unique file name
        $newFileName = md5(uniqid()) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
  
        // Move the uploaded file to the desired location
        $targetPath = 'uploads/' . $newFileName;
        if (move_uploaded_file($fileTempName, $targetPath)) {  
          // Success message
          echo 'Image uploaded successfully!';
        } else {
          echo 'Error moving uploaded file.';
        }
      } else {
        echo 'Invalid file type or size.';
      }
    } else {
      echo 'Error uploading file.';
    }
}

$eventname = $_POST['eventname'];
$eventdescription = $_POST['eventdescription'];
$noofparticipants = $_POST['noofparticipants'];
$event_time = $_POST['event_time'];
$event_date = $_POST['event_date'];
$venue = $_POST['venue'];
 
$stmt = $con->prepare('INSERT INTO event (eventname, noofparticipants, event_time, event_date, venue, eventdescription, imagepath, filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssssssss', $eventname, $noofparticipants, $event_time, $event_date, $venue, $eventdescription, $targetPath, $newFileName);

if ($stmt->execute()) {
  // Registration successful, redirect to signup.html with a success message
  header("Location: admin.html?success=Registration%20is%20successful");
} else {
  // Registration failed, redirect to signup.html with an error message
  header("Location: create.html?error=Registration%20failed");
}

?>
    
    