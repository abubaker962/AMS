<?php
require_once("controllers/databaseController.php");

$db = new DatabaseController();
$dbHandle = $db->connectDatabase();

$today = getdate();
$todayDate =  $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];

$getDetailsQuery = "SELECT e.emp_id, e.emp_name, e.emp_email, a.time_in from employees as e 
inner join attendance as a on a.emp_id = e.emp_id WHERE a.attendance_date = '$todayDate' and a.time_in IS NULL";
$result = $dbHandle->query($getDetailsQuery);

while ($row = $result->fetch_assoc()) {
    $markLateQuery = "update attendance set status = 'Late' where emp_id = {$row['emp_id']}
    and attendance_date = '$todayDate'";
    if ($dbHandle->query($markLateQuery) === TRUE) {
        echo "Job Completed Successfully";
    } else {
        echo "Job Failed!";
    }
    $body = $row['emp_name'] . " please mark your attendance.";
    mail($row['emp_email'], "Reminder for Attendance", $body);
}

$dbHandle->close();