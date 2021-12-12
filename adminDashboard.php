<?php
session_start();
require_once "includes/header.php";
require_once "includes/sideNavBar.php";
require_once "controllers/employeeController.php";
require_once "controllers/attendanceController.php";

$attendanceController = new AttendanceController();
$reportMonth = $_POST['reportMonth'];
if (isset($reportMonth)) {
  $attendance = $attendanceController->getAttendanceByMonth($_POST['reportMonth']);
} else {
  $attendance = $attendanceController->getTodaysAttendance();
}

?>

<div class="content">
  <h1>Welcome <?php echo $_SESSION['loggedInUserName']; ?>!</h1>
  <p id="currDateTime"></p>
  <form action="adminDashboard.php" method="post">
    <label for="attedanceReportMonth">Attendance Report (Month and Year):</label>
    <input type="month" id="reportMonth" name="reportMonth">
    <input class="button" type="submit" id="submit" name="reportSubmit" value="Get Report">
  </form>
  <div class="container">
    <?php if (isset($reportMonth)) : ?>
      <h2>Attendance Report for : <?php echo $reportMonth ?></h2>
    <?php else : ?>
      <h2>Today's Attendance</h2>
    <?php endif; ?>

    <table id="attendanceTable">
      <thead>
        <tr>
          <?php if (isset($reportMonth)) : ?>
            <th>Date</th>
          <?php endif; ?>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Time In</th>
          <th>Time Out</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($attendance as $row) : ?>
          <tr>
            <?php if (isset($reportMonth)) : ?>
              <td><?php echo $row->getAttendanceDate(); ?></td>
            <?php endif; ?>
            <td><?php echo $row->getEmpId(); ?></td>
            <td><?php echo $row->getEmpName(); ?></td>
            <td><?php echo $row->getempEmail(); ?></td>
            <td><?php echo $row->getTimeIn(); ?></td>
            <td><?php echo $row->getTimeOut(); ?></td>
            <td><?php echo $row->getStatus(); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

</body>

</html>