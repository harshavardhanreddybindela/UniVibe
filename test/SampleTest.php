<?php
class SampleTest extends \PHPUnit\Framework\TestCase{
    //Function to test admin credentials validation feature
    public function testcase1() {
        $cal=new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems";
        $con = mysqli_connect($host, $usern, $pass, $dbname);
        $user="SELECT * from admin where emailid='saigoutham.chedhella@slu.edu' and pass1='Sai@12345'";
        $result=$cal->validate($con,$user);
        $this->assertEquals(1, $result);
    }

    //Function to test add new admin features
    public function testcase2(){
        $cal=new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems";
        $con = mysqli_connect($host, $usern, $pass, $dbname);
        $result=$cal->addadmin($con);
        $this->assertEquals(1, $result);
    }

    //Function to test to update password
    public function testcase3(){
        $cal=new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems";
        $con = mysqli_connect($host, $usern, $pass, $dbname);
        $result=$cal->update($con);
        $this->assertEquals(1, $result);
    }
    
    //Function to test delete event details
    public function testcase4(){
        $cal=new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems";
        $con = mysqli_connect($host, $usern, $pass, $dbname);
        $result=$cal->emptycart($con);
        $this->assertEquals(1, $result);
    }

    public function testTableExists()
    {
        $cal = new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems";
        $con = mysqli_connect($host, $usern, $pass, $dbname);
        $tableName = 'event';
    
        $result = $cal->tableExists($con, $tableName);
    
        $this->assertTrue($result);
    }

    public function testDatabaseExists()
    {
        $cal = new App\Test_php;
        $host = "localhost";
        $usern = "root";
        $pass = "";
        $dbname = "uems"; // Replace with the name of the database you want to check
    
        $con = mysqli_connect($host, $usern, $pass);
    
        $result = $cal->databaseExists($con, $dbname);
    
        $this->assertEquals(true, $result);
    }
    
}