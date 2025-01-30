<?php

namespace App;

class Test_php{
    //Function to validate admin credentials
    public function validate($con,$user) {
        $result=mysqli_query($con,$user);
        $num1=1;
        if(mysqli_num_rows($result)==1)
        {
        return $num1;
        }
    }
    
    //Function to add new user to the database
    public function addadmin($con) {
        $sql="INSERT INTO admin (firstname, lastname, employeeid, emailid, securityquestion1, securityquestion2, securityquestion3, pass1, pass2) VALUES ('sai', 'bireddy', 'SLU1111104', 'sai@gmail.com','sai','bangalore','green','Saireddy@123','Saireddy@123' )";
        $result=mysqli_query($con,$sql);
        $num1=1;
        if($result)
        {
        return $num1;
        }
    }

    //Function to update the password
    public function update($con) {
        $user="UPDATE admin SET pass1='Mounika@12x', pass2='Mounika@12x' where employeeid='SLU1111100'";
        $result=mysqli_query($con,$user);
        $num1=1;
        if($result)
        {
        return $num1;
        }
    }

    // Function to empty the products in the cart
    public function emptycart($con) {
        $user="DELETE from event where eventid='6'";
        $result=mysqli_query($con,$user);
        $num1=1;
        if($result)
        {
        return $num1;
        }
    }

    // Function to check if a table exists in the database
    public function tableExists($con, $tableName)
    {
        $sql = "SHOW TABLES LIKE 'event'";
        $result = mysqli_query($con, $sql);
        return mysqli_num_rows($result) == 1;
    }

    public function databaseExists($con, $dbname)
    {
        return mysqli_select_db($con, $dbname);
    }


}