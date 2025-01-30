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

// Authentication interface for different authentication strategies
interface AuthenticationStrategy
{
    public function authenticate($emailid, $pass1);
}

// AdminAuthentication class implements the AuthenticationStrategy interface
class AdminAuthentication implements AuthenticationStrategy
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function authenticate($emailid, $pass1)
    {
        $query = "SELECT emailid, pass1 FROM admin WHERE emailid='$emailid' and pass1='$pass1'";
        $result = $this->db->executeQuery($query);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            echo "Admin login successful";
            exit(header("refresh:1;url=admin.html"));
        } else {
            echo "Invalid admin login";
            exit(header("refresh:1;url=login.html"));
        }
    }
}

// Iterator Pattern: Basic implementation of Iterator pattern for result set traversal
class ResultSetIterator implements Iterator
{
    private $resultSet;

    public function __construct($resultSet)
    {
        $this->resultSet = $resultSet;
    }

    public function rewind()
    {
        reset($this->resultSet);
    }

    public function current()
    {
        return current($this->resultSet);
    }

    public function key()
    {
        return key($this->resultSet);
    }

    public function next()
    {
        return next($this->resultSet);
    }

    public function valid()
    {
        $key = key($this->resultSet);
        return ($key !== null && $key !== false);
    }
}

// Decorator Pattern: Basic implementation of Decorator pattern for result set manipulation
class ResultSetDecorator implements Countable
{
    private $resultSet;

    public function __construct($resultSet)
    {
        $this->resultSet = $resultSet;
    }

    public function count()
    {
        return count($this->resultSet);
    }

    // Additional decorator methods can be added for result set manipulation
}

// Instantiate the Database class
$db = new Database('localhost', 'root', '', 'uems');

// Instantiate the AdminAuthentication class
$adminAuthentication = new AdminAuthentication($db);

// User input data
$emailid = $_POST['emailid'];
$pass1 = $_POST['pass1'];

// Authenticate using the AdminAuthentication strategy
$resultSet = $adminAuthentication->authenticate($emailid, $pass1);

// Use Iterator to traverse the result set
$iterator = new ResultSetIterator($resultSet);
foreach ($iterator as $row) {
    // Process each row
}

// Use Decorator to get the count of the result set
$decoratedResultSet = new ResultSetDecorator($resultSet);
$resultCount = count($decoratedResultSet);

// Close the database connection
$db->closeConnection();
?>
