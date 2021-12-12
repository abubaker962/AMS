<?php
session_start();
require_once "databaseController.php";
require_once "models/employee.php";
require_once "models/attendance.php";

class AttendanceController
{
    private $dbHandle;
    function __construct()
    {
        $db = new DatabaseController();
        $this->dbHandle = $db->connectDatabase();
    }

    function getTodaysAttendance()
    {
        $attendance = array();
        $todayDate = $this->getCurrDate();
        $getTodaysAttendanceQuery = "select e.emp_id, e.emp_name, e.emp_email, a.attendance_date, a.time_in, a.time_out, a.status from attendance as a 
        inner join employees as e on a.emp_id = e.emp_id where attendance_date = '$todayDate' and e.emp_id <> {$_SESSION['loggedInUserId']}";
        $result = $this->dbHandle->query($getTodaysAttendanceQuery);
        while ($row = $result->fetch_assoc()) {
            $attendance[] = new Attendance($row);
        }
        return $attendance;
    }

    function getCurrDate()
    {
        $today = getdate();
        return $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
    }

    function getAttendanceByMonth($date)
    {
        $month = explode('-', $date);
        $getAttendanceQuery = "select e.emp_id, e.emp_name, e.emp_email, a.attendance_date, a.time_in, a.time_out, a.status from attendance as a 
        inner join employees as e on a.emp_id = e.emp_id where MONTH(attendance_date) = '$month[1]' and YEAR(attendance_date) = '$month[0]' and e.emp_id <> {$_SESSION['loggedInUserId']}
        order by attendance_date";
        $result = $this->dbHandle->query($getAttendanceQuery);
        while ($row = $result->fetch_assoc()) {
            $attendance[] = new Attendance($row);
        }
        return $attendance;
    }

    function getAttendanceById()
    {
        $todayDate = $this->getCurrDate();
        $getEmpAttendanceQuery = "select * from attendance where emp_id = {$_SESSION['loggedInUserId']} and attendance_date = '$todayDate'";
        $result = $this->dbHandle->query($getEmpAttendanceQuery);
        while ($row = $result->fetch_assoc()) {
            $attendance = new Attendance($row);
        }
        return $attendance;
    }

    function markAttendance($data)
    {
        $todayDate = $this->getCurrDate();
        $timeIn = '';
        $timeOut = '';
        if ($data['timeIn'] != "") {
            $timeIn = "time_in = '{$data['timeIn']}',";
        }
        if ($data['timeOut'] != "") {
            $timeIn = "time_out = '{$data['timeOut']}',";
        }
        $updateEmpAttendanceQuery = "Update attendance set $timeIn $timeOut
        status = 'Present' where attendance_date = '$todayDate' and emp_id = {$_SESSION['loggedInUserId']}";
        if ($this->dbHandle->query($updateEmpAttendanceQuery) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function addEmployeesToAttendance()
    {
        $todayDate = $this->getCurrDate();
        $getAllEmpId = "Select emp_id from employees";
        $empIds = $this->dbHandle->query($getAllEmpId);
        while ($row = $empIds->fetch_assoc()) {
            $insertToAttendanceQuery = "insert into attendance (emp_id, attendance_date)
            VALUES ({$row['emp_id']},'$todayDate')";
            $this->dbHandle->query($insertToAttendanceQuery);
        }
    }

    function __destruct()
    {
        $this->dbHandle->close();
    }
}
