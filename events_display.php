<?php
$con = mysqli_connect('localhost', 'root', '');

if (!$con) {
    die('Not connected to server');
}

if (!mysqli_select_db($con, 'uems')) {
    die('Database not selected');
}

// Retrieve events from the 'event' table
$selectEventsSQL = "SELECT * FROM event";
$result = mysqli_query($con, $selectEventsSQL);

if (!$result) {
    die('Error fetching events: ' . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Events</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Add Bootstrap CSS link here -->
</head>
<body>
    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="uems navigation bar">
        <div class="container">
            <a class="navbar-brand" href="index.html">UniVibe<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsuems" aria-controls="navbarsuems" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsuems">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li><a class="nav-link" href="about.html">About us</a></li>
                    <li class="active"><a class="nav-link" href="login.html">Student Login</a></li>
                    <li><a class="nav-link" href="Student_login.html">Admin Login</a></li>
                    <li><a class="nav-link" href="contact.html">Contact us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <h1>Upcoming Events</h1>
    </header>
    <main>
        <?php
        // Loop through the retrieved events and display them in a table
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="event-card">
            <?php
                // Replace with your database connection and query
                $targetPath = 'uploads/' . $row['filename'];
            ?>
            <img src="<?php echo $targetPath; ?>" alt="Uploaded Image">
            <div class="event-details">
                <h2><?php echo $row['eventname'] ?></h2>
                <p><?php echo $row['eventdescription']?></p>
                <p>Number of Participants :<?php echo $row['noofparticipants'] ?></p>
                <p><?php echo $row['venue'] ?></p>
                <p><?php echo $row['event_date']?>, <?php echo $row['event_time'] ?></p>
                <a href="Student_login.html" class="button">Register</a>
            </div>
        </div>
        <?php
        }
        ?>
    </main>
</body>
</html>

<?php
mysqli_close($con);
?>