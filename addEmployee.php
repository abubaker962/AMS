<?php
session_start();
require_once "includes/header.php";
require_once "includes/sideNavBar.php";
require_once "controllers/employeeController.php";

$emp = new EmployeeController();
$errors = $_SESSION['errors'];
$formData = $_SESSION['formData'];

?>

<div class="container" id="addEmployeeForm">
    <h2>Add Employee</h2>
    <div class="container">
        <?php if (count($errors)) : ?>
            <?php for ($i = 0; $i < count($errors); $i++) : ?>
                <p class='error'><?php echo  $errors[$i] ?></p>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    <form name="addEmployeeForm" action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" id="empName" name="empName" placeholder="Enter Employee Name" value="<?php echo htmlspecialchars(@$formData['empName']) ?>" required>
        <br>
        <input type="text" id="empEmail" name="empEmail" placeholder="Enter Employee Email" value="<?php echo htmlspecialchars(@$formData['empEmail']) ?>" required>
        <br>
        <input type="number" id="empSalary" name="empSalary" placeholder="Enter Employee Salary" min="1" onkeypress="return checkPositiveInteger(event)" value="<?php echo htmlspecialchars(@$formData['empSalary']) ?>" required>
        <br>
        <input type="password" id="empPassword" name="empPassword" placeholder="Enter Employee Salary" value="<?php echo htmlspecialchars(@$formData['empPassword']) ?>" required>
        <br>
        <label for="dept">Choose Department:</label>
        <select name="empDept" id="empDept">
            <?php $emp->getDepartments(); ?>
        </select>
        <br><br>
        <label for="designation">Choose Designation:</label>
        <select name="empDesignation" id="empDesignation">
            <option value="developer">Developer</option>
            <option value="manager">Manager</option>
            <option value="hr_manager">HR Manager</option>
            <option value="ceo">CEO</option>
        </select>
        <br><br>
        <label for="boss">Choose Boss:</label>
        <select name="empBoss" id="empBoss">
            <option value="none">N/A</option>
            <?php $emp->getManagers(); ?>
        </select>
        <br>
        <label class="file">Upload Profile Picture:</label>
        <br>
        <input class="file" type="file" id="profilePicture" name="profilePicture">
        <br><br>
        <input class="button" type="submit" id="submit" name="addEmployeeSubmit">
        <br>
    </form>
</div>
</body>

</html>