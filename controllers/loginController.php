<?php
require_once "controllers/databaseController.php";
require_once "models/employee.php";

class LoginController
{
    private $dbHandle;

    function __construct()
    {
        $db = new DatabaseController();
        $this->dbHandle = $db->connectDatabase();
    }
    
    public function showLoginPage()
    {
        require_once "loginPage.php";
    }

    public function authenticateUser($email, $password)
    {
        $getIdQuery = "SELECT emp_id FROM employees where emp_email = '$email' and emp_password = md5('$password')";
        $result = $this->dbHandle->query($getIdQuery);
        $id = $result->fetch_assoc();
        return $id['emp_id'];
    }

    function __destruct()
    {
        $this->dbHandle->close();
    }
}
