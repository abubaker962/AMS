<?php
session_start();
require_once "databaseController.php";
require_once "models/employee.php";

class EmployeeController
{
    private $dbHandle;
    function __construct()
    {
        $db = new DatabaseController();
        $this->dbHandle = $db->connectDatabase();
    }
    function getEmployeeById($id)
    {
        $getUserQuery = "SELECT * FROM employees where emp_id = $id";
        $result = $this->dbHandle->query($getUserQuery);
        $data = $result->fetch_assoc();
        $employee = new Employee($data);
        return $employee;
    }

    function getManagers($option = "")
    {
        $getManagersQuery = "SELECT emp_id, emp_name FROM employees where emp_designation = 'Manager'";
        $result = $this->dbHandle->query($getManagersQuery);
        while ($row = $result->fetch_assoc()) {
            if ($option == $row['emp_id']) {
                echo "<option selected id='" . $row['emp_id'] . "' value='" . $row['emp_id'] . "'>" . $row['emp_name'] . "</option>";
            } else {
                echo "<option id='" . $row['emp_id'] . "' value='" . $row['emp_id'] . "'>" . $row['emp_name'] . "</option>";
            }
        }
    }

    function getDepartments($option = "")
    {
        $getDepartmentsQuery = "SELECT dept_id, dept_name FROM departments";
        $result = $this->dbHandle->query($getDepartmentsQuery);
        while ($row = $result->fetch_assoc()) {
            if ($option == $row['dept_id']) {
                echo "<option selected id='" . $row['dept_id'] . "' value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
            } else {
                echo "<option id='" . $row['dept_id'] . "' value='" . $row['dept_id'] . "'>" . $row['dept_name'] . "</option>";
            }
        }
    }

    function validateFormData($data, $fileType, $fileChanged = 1)
    {
        $errors = array();
        if (!filter_var($data['empEmail'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "*Email Address is not valid*";
        }
        if (($fileType != 'image/jpeg' || $fileType == '') && $fileChanged == 1) {
            $errors[] = '*Please upload image in JGP/JPEG Format*';
        }
        return $errors;
    }

    function addEmployee($data, $profilePic)
    {
        $isAdmin = 0;
        $profilePicName = $this->saveProfilePicture($profilePic);
        if ($data['empDesignation'] == "hr_manager") {
            $isAdmin = 1;
        }
        $addEmployeeQuery = "INSERT INTO employees (emp_name, emp_email, emp_salary, dept_id, emp_boss, emp_designation, is_admin, emp_profile_pic, emp_password)
        VALUES ('{$data['empName']}','{$data['empEmail']}', '{$data['empSalary']}', {$data['empDept']}, {$data['empBoss']}, '{$data['empDesignation']}', $isAdmin, '$profilePicName', md5('{$data['empPassword']}'))";
        if ($this->dbHandle->query($addEmployeeQuery) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function getAllEmployees()
    {
        $employees = array();
        $getAllEmployeesQuery = "SELECT e2.emp_id, e2.emp_name, e2.emp_email, e2.emp_salary, d.dept_name as dept_id, e1.emp_name as emp_boss, 
        e2.emp_designation, e2.is_admin, e2.emp_profile_pic, e2.emp_password  from employees as e1 
        inner join (SELECT * FROM employees WHERE emp_id <> {$_SESSION['loggedInUserId']}) as e2 on e1.emp_id = e2.emp_boss 
        inner join departments as d on e2.dept_id = d.dept_id";
        $result = $this->dbHandle->query($getAllEmployeesQuery);
        while ($row = $result->fetch_assoc()) {
            $employee = new Employee($row);
            $employees[] = $employee;
        }
        return $employees;
    }

    function updateEmployee($data, $profilePic)
    {
        $isAdmin = 0;
        $addPic = '';
        if ($data['empDesignation'] == "hr_manager") {
            $isAdmin = 1;
        }
        if ($profilePic['profilePicture']['name'] != '') {
            $profilePicName = $this->saveProfilePicture($profilePic);
            $addPic = "emp_profile_pic = '$profilePicName',";
        }
        $updateEmployeeQuery = "update employees set 
        emp_name = '{$data['empName']}',
        emp_email = '{$data['empEmail']}',
        emp_salary = '{$data['empSalary']}',
        dept_id = '{$data['empDept']}',
        emp_designation = '{$data['empDesignation']}',
        is_admin = $isAdmin,
        $addPic
        emp_boss = '{$data['empBoss']}' where emp_id = {$data['empId']}";
        if ($this->dbHandle->query($updateEmployeeQuery) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function saveProfilePicture($profilePic)
    {
        $profilePicName = $profilePic['profilePicture']['name'];
        $profilePicTempName = $profilePic['profilePicture']['tmp_name'];
        $path = 'profilePics/' . $profilePicName;
        move_uploaded_file($profilePicTempName, $path);
        return $profilePicName;
    }

    function deleteEmployee($id)
    {
        $updateBossQuery = "update employees set emp_boss = 0 where emp_boss = $id";
        $deleteQuery = "delete from employees where emp_id = $id ";
        $this->dbHandle->query($updateBossQuery);
        if ($this->dbHandle->query($deleteQuery) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function __destruct()
    {
        $this->dbHandle->close();
    }
}
