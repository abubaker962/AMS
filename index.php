<?php
session_start();
require_once "includes/require.php";

$action = "";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if (isset($_POST['loginSubmit'])) {
    $login = new LoginController();
    $authenticated = $login->authenticateUser($_POST['empEmail'], $_POST['empPassword']);
    if ($authenticated) {
        $emp = new EmployeeController();
        $empData = $emp->getEmployeeById($authenticated);
        $isAdmin = $empData->getIsAdmin();
        $_SESSION['loggedInUserId'] = $empData->getEmpId();
        $_SESSION['loggedInUserName'] = $empData->getEmpName();
        if ($isAdmin == 1) {
            header("Location: adminDashboard.php");
        } else {
            header("Location: markAttendance.php?id={$empData->getEmpId()}");
        }
    } else {
        header("Location: loginPage.php?error=1");
    }
} else if (isset($_POST['addEmployeeSubmit'])) {
    $emp = new EmployeeController();
    $fileType = $_FILES['profilePicture']['type'];
    $errors = $emp->validateFormData($_POST, $fileType);
    if (count($errors) == 0) {
        $status = $emp->addEmployee($_POST, $_FILES);
        if ($status == true) {
            header("Location: allEmployees.php?status=success");
        } else {
            header("Location: allEmployees.php?status=failed");
        }
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        header("Location: addEmployee.php");
    }
} else if ($action == "editEmployee") {
    header("Location: editEmployee.php?id={$_GET['id']}");
} else if (isset($_POST['updateEmployeeSubmit'])) {
    $emp = new EmployeeController();
    $fileType = $_FILES['profilePicture']['type'];
    if ($fileType == '') {
        $errors = $emp->validateFormData($_POST, $fileType, 0);
    } else {
        $errors = $emp->validateFormData($_POST, $fileType);
    }
    if (count($errors) == 0) {
        $status = $emp->updateEmployee($_POST, $_FILES);
        if ($status == true) {
            header("Location: allEmployees.php?status=updated");
        } else {
            header("Location: allEmployees.php?status=failed");
        }
    } else {
        $_SESSION['updateErrors'] = $errors;
        $_SESSION['updateFormData'] = $_POST;
        header("Location: editEmployee.php?id={$_POST['id']}&updateError=1");
    }
} else if ($action == "deleteEmployee") {
    header("Location: deleteEmployee.php?id={$_GET['id']}");
} else if (isset($_POST['attendanceSubmit'])) {
    $att = new AttendanceController();
    $status = $att->markAttendance($_POST);
    if ($status == true) {
        header("Location: markAttendance.php?status=success");
    } else {
        header("Location: markAttendance.php?status=failed");
    }
} else if ($action == "logout") {
    session_unset();
    session_destroy();
    header("Location: loginPage.php");
} else {
    $login = new LoginController();
    $login->showLoginPage();
}
