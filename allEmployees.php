<?php
session_start();
require_once "includes/header.php";
require_once "includes/sideNavBar.php";
require_once "controllers/employeeController.php";

$emp = new EmployeeController();
$employees = $emp->getAllEmployees();
?>

<div class="content">
    <p id="currDateTime"></p>
    <div class="container">
        <h2>Employees</h2>
        <table id="employeesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Department</th>
                    <th>Boss</th>
                    <th>Designation</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td><?php echo $employee->getEmpId(); ?></td>
                        <td><?php echo $employee->getEmpName(); ?></td>
                        <td><?php echo $employee->getEmpEmail(); ?></td>
                        <td><?php echo $employee->getEmpSalary(); ?></td>
                        <td><?php echo $employee->getDeptId(); ?></td>
                        <td><?php echo $employee->getEmpBoss(); ?></td>
                        <td><?php echo $employee->getEmpDesignation(); ?></td>
                        <td>
                            <a href="index.php?action=editEmployee&id=<?php echo $employee->getEmpId(); ?>"><button id="updateButton">Edit</button></a>
                            <a onclick="deleteConfirmation(<?php echo $employee->getEmpId(); ?> )"><button id="deleteButton">Delete</button></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($_GET['status'] == "success") : ?>
        <h2 class="success" id="success">Employee Added Successfully!</h2>
    <?php elseif ($_GET['status'] == "updated") : ?>
        <h2 class="success" id="success">Employee Updated Successfully!</h2>
    <?php elseif ($_GET['status'] == "deleted") : ?>
        <h2 class="success" id="success">Employee Deleted Successfully!</h2>
    <?php elseif ($_GET['status'] == "failed") : ?>
        <p class="error">*An Error has occurred*</p>
    <?php endif; ?>
</div>

</body>

</html>