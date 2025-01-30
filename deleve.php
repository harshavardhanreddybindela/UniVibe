<?php

// Iterator interface for iterating over query results
interface IteratorInterface
{
    public function hasNext();

    public function getNext();
}

// Concrete implementation of Iterator for mysqli results
class MysqliIterator implements IteratorInterface
{
    private $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function hasNext()
    {
        return $row = mysqli_fetch_assoc($this->result);
    }

    public function getNext()
    {
        return $row;
    }
}

// Decorator interface for adding additional functionality
interface EventManagerDecorator
{
    public function deleteEvent($eventid);
}

// Concrete implementation of EventManagerDecorator for logging
class LoggingDecorator implements EventManagerDecorator
{
    private $eventManager;

    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function deleteEvent($eventid)
    {
        echo "Deleting event with ID: $eventid\n";
        $this->eventManager->deleteEvent($eventid);
    }
}
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

    public function selectDatabase($databaseName)
    {
        return mysqli_select_db($this->connection, $databaseName);
    }

    public function executeQuery($query)
    {
        return mysqli_query($this->connection, $query);
    }

    public function getIterator($result)
    {
        return new MysqliIterator($result);
    }

    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}

// Event class for managing events
class EventManager implements EventManagerDecorator
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function deleteEvent($eventid)
    {
        $query = "DELETE FROM event WHERE eventid='$eventid'";
        $result = $this->db->executeQuery($query);

        if ($result) {
            echo "Event deleted successfully";
            exit(header("refresh:1;url=admin.html"));
        } else {
            die("Error deleting event: " . mysqli_error($this->db->connection));
        }
    }
}

// Instantiate the Database class
$db = new Database('localhost', 'root', '', 'uems');

// Instantiate the EventManager class with LoggingDecorator
$eventManager = new LoggingDecorator(new EventManager($db));

// User input data
$eventid = $_POST['eventid'];

// Delete the event
$eventManager->deleteEvent($eventid);

// Close the database connection
$db->closeConnection();
?>
