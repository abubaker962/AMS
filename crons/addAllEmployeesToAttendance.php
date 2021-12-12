<?php
require_once "controllers/attendanceController.php";

$att = new AttendanceController();
$att->addEmployeesToAttendance();
