<?php
require_once("controllers/databaseController.php");

$db = new DatabaseController();
$dbHandle = $db->connectDatabase();

$today = getdate();
$todayDate =  $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];

$getDetailsQuery = "SELECT e2.emp_id, e2.emp_name, e2.emp_email, e1.emp_email as boss_email, a.time_in from employees as e1 
inner join (SELECT * FROM employees) as e2 on e1.emp_id = e2.emp_boss inner join
attendance as a on a.emp_id = e2.emp_id WHERE a.attendance_date = '$todayDate' and a.time_in IS NULL";

$result = $dbHandle->query($getDetailsQuery);

while ($row = $result->fetch_assoc()) {
    $markLeaveQuery = "update attendance set status = 'Absent' where emp_id = {$row['emp_id']}
    and attendance_date = '$todayDate'";
    if ($dbHandle->query($markLeaveQuery) === TRUE) {
        echo "Leaves Marked Successfully";
    } else {
        echo "Job Failed!";
    }
    $body = $row['emp_name'] . " is on leave today";
    mail($row['boss_email'], "Leave Notification", $body);
}
