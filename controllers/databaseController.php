<?php
class DatabaseController
{
    private $servername  = "localhost";
    private $username  = "abu";
    private $password = "AbuBaker@123";
    private $dbName = "ams";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
    }

    function connectDatabase()
    {
        return $this->conn;
    }
}
