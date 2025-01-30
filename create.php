<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$con = mysqli_connect('uems.cohqeqscenv8.us-east-1.rds.amazonaws.com', 'admin', '12345678', 'uems');

// Check database connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'event' table exists, create if not
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

if (!mysqli_query($con, $createTableSQL)) {
    die("Error creating table: " . mysqli_error($con));
}

// Initialize variables
$targetPath = "";
$newFileName = "";

// Handle File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

            // Ensure 'uploads' directory exists
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }

            // Move uploaded file to 'uploads' directory
            $targetPath = 'uploads/' . $newFileName;
            if (!move_uploaded_file($fileTempName, $targetPath)) {
                die("Error moving uploaded file.");
            }
        } else {
            die("Invalid file type or size.");
        }
    } else {
        die("Error uploading file.");
    }
}

// Ensure required POST variables exist
if (!isset($_POST['eventname'], $_POST['eventdescription'], $_POST['noofparticipants'], $_POST['event_time'], $_POST['event_date'], $_POST['venue'])) {
    die("Error: Missing form data.");
}

// Store form data safely
$eventname = mysqli_real_escape_string($con, $_POST['eventname']);
$eventdescription = mysqli_real_escape_string($con, $_POST['eventdescription']);
$noofparticipants = mysqli_real_escape_string($con, $_POST['noofparticipants']);
$event_time = mysqli_real_escape_string($con, $_POST['event_time']);
$event_date = mysqli_real_escape_string($con, $_POST['event_date']);
$venue = mysqli_real_escape_string($con, $_POST['venue']);

// Insert into database
$stmt = $con->prepare('INSERT INTO event (eventname, noofparticipants, event_time, event_date, venue, eventdescription, imagepath, filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->bind_param('ssssssss', $eventname, $noofparticipants, $event_time, $event_date, $venue, $eventdescription, $targetPath, $newFileName);

if ($stmt->execute()) {
    // Registration successful, redirect with a success message
    header("Location: admin.html?success=Registration%20is%20successful");
    exit;
} else {
    // Registration failed, redirect with an error message
    die("Error inserting data: " . $stmt->error);
}

mysqli_close($con);
?>
