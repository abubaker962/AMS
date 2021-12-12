<?php
require_once "controllers/employeeController.php";

$emp = new EmployeeController();
$status = $emp->deleteEmployee($_GET['id']);
if ($status == true) {
    header("Location: allEmployees.php?status=deleted");
} else {
    header("Location: allEmployees.php?status=failed");
}
