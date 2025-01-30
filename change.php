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

// PasswordChange class for changing user passwords
class PasswordChange
{
    private $db;

    public function __construct(Database $database)
    {
        $this->db = $database;
    }

    public function changePassword($employeeid, $pass1, $pass2)
    {
        $sql = "UPDATE admin SET pass1='$pass1', pass2='$pass2' WHERE employeeid='$employeeid'";
        
        if ($this->db->executeQuery($sql)) {
            echo "Password changed successfully";
            exit(header("refresh:1;url=login.html"));
        } else {
            echo "Error updating record: " . mysqli_error($this->db->connection);
            exit(header("refresh:1;url=change.html"));
        }
    }
}

// PasswordValidationDecorator for validating password changes (Decorator pattern)
class PasswordValidationDecorator
{
    private $passwordChange;

    public function __construct(PasswordChange $passwordChange)
    {
        $this->passwordChange = $passwordChange;
    }

    public function validatePasswordChange($employeeid, $pass1, $pass2)
    {
        if ($this->isValidPassword($pass1, $pass2)) {
            $this->passwordChange->changePassword($employeeid, $pass1, $pass2);
        } else {
            echo "Invalid password change request";
            exit(header("refresh:1;url=change.html"));
        }
    }

    private function isValidPassword($pass1, $pass2)
    {
        // Add your password validation logic here
        // For example, check if pass1 and pass2 meet certain criteria
        return true; // Return true for demonstration, add actual validation logic
    }
}

// Instantiate the Database class
$db = new Database('localhost', 'root', '', 'uems');

// Instantiate the PasswordChange class
$passwordChange = new PasswordChange($db);

// Instantiate the PasswordValidationDecorator
$passwordDecorator = new PasswordValidationDecorator($passwordChange);

// User input data
$employeeid = $_POST['employeeid'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

// Validate and perform password change
$passwordDecorator->validatePasswordChange($employeeid, $pass1, $pass2);

// Close the database connection
$db->closeConnection();
?>
