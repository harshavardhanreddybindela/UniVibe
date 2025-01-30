<?php
// Database class for database connection and interaction
class Database
{
    private $connection;
 
    public function __construct($hostname, $username, $password, $databaseName)
    {
        $this->connection = mysqli_connect($hostname, $username, $password, $databaseName);
        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }
 
    public function executeQuery($query)
    {
        return mysqli_query($this->connection, $query);
    }
 
    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}
 
// Event class for managing events
class EventManager
{
    private $db;
 
    public function __construct(Database $database)
    {
        $this->db = $database;
    }
 
    public function updateEvent($eventid, $eventname, $noofparticipants, $eventdescription, $event_date, $event_time, $venue)
    {
        $query = "UPDATE event SET eventname='$eventname', noofparticipants='$noofparticipants', eventdescription='$eventdescription', event_date='$event_date', event_time='$event_time', venue='$venue' WHERE eventid='$eventid'";
        $result = $this->db->executeQuery($query);
 
        if ($result) {
            echo "Record updated successfully";
            exit(header("refresh:1;url=admin.html"));
        } else {
            die("Error updating record: " . mysqli_error($this->db->connection));
        }
    }
}
 
// Instantiate the Database class
$db = new Database('localhost', 'root', '', 'uems');
 
// Instantiate the EventManager class
$eventManager = new EventManager($db);
 
// User input data
$eventid = $_POST['eventid'];
$eventname = $_POST['eventname'];
$noofparticipants = $_POST['noofparticipants'];
$eventdescription = $_POST['eventdescription'];
$event_date = $_POST['event_date'];
$event_time = $_POST['event_time'];
$venue = $_POST['venue'];
 
// Update the event
$eventManager->updateEvent($eventid, $eventname, $noofparticipants, $eventdescription, $event_date, $event_time, $venue);
 
// Close the database connection
$db->closeConnection();
?>