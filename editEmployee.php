<?php
session_start();
require_once "includes/header.php";
require_once "includes/sideNavBar.php";
require_once "controllers/employeeController.php";
require_once "models/employee.php";

$emp = new EmployeeController();
if (isset($_GET['updateError'])) {
    $employee = new Employee($_SESSION['updateFormData']);
} else {
    $employee = $emp->getEmployeeById($_GET['id']);
}
$errors = $_SESSION['updateErrors'];
?>

<div class="container" id="editEmployeeFormDiv">
    <h2>Add Employee</h2>
    <div class="container">
        <?php if (count($errors)) : ?>
            <?php for ($i = 0; $i < count($errors); $i++) : ?>
                <p class='error'><?php echo  $errors[$i] ?></p>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <form name="editEmployeeForm" action="index.php" method="post" enctype="multipart/form-data">
        <input type="number" name="empId" value="<?php echo $employee->getEmpId() ?>" hidden>
        <input type="text" id="empName" name="empName" placeholder="Enter Employee Name" value="<?php echo htmlspecialchars(@$employee->getEmpName()) ?>" required>
        <br>
        <input type="text" id="empEmail" name="empEmail" placeholder="Enter Employee Email" value="<?php echo htmlspecialchars(@$employee->getempEmail()) ?>" required>
        <br>
        <input type="number" id="empSalary" name="empSalary" placeholder="Enter Employee Salary" min="1" onkeypress="return checkPositiveInteger(event)" value="<?php echo htmlspecialchars(@$employee->getEmpSalary()) ?>" required>
        <br>
        <label for="dept">Choose Department:</label>
        <select name="empDept" id="empDept">
            <?php echo $emp->getDepartments($employee->getDeptId()); ?>
        </select>
        <br><br>
        <label for="designation">Choose Designation:</label>
        <select name="empDesignation" id="empDesignation">
            <option value="developer" <?php if ($employee->getEmpDesignation() == "developer") echo 'selected'; ?>>Developer</option>
            <option value="manager" <?php if ($employee->getEmpDesignation() == "manager") echo 'selected'; ?>>Manager</option>
            <option value="hr_manager" <?php if ($employee->getEmpDesignation() == "hr_manager") echo 'selected'; ?>>HR Manager</option>
            <option value="ceo" <?php if ($employee->getEmpDesignation() == "ceo") echo 'selected'; ?>>CEO</option>
        </select>
        <br><br>
        <label for="boss">Choose Boss:</label>
        <select name="empBoss" id="empBoss">
            <option value="none">N/A</option>
            <?php $emp->getManagers($employee->getEmpBoss()); ?>
        </select>
        <br>
        <label class="file">Upload Profile Picture:</label>
        <br>
        <input class="file" type="file" id="profilePicture" name="profilePicture">
        <br>
        <img width="50px" height="50px" src="profilePics/<?php echo $employee->getEmpProfilePic() ?>">
        <br><br>
        <input class="button" type="submit" id="submit" name="updateEmployeeSubmit" value="Update">
        <br>
    </form>
</div>
</body>

</html>