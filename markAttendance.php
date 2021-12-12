<?php
session_start();
require_once "includes/header.php";
require_once "controllers/attendanceController.php";

$att = new AttendanceController();
$attendance = $att->getAttendanceById();
?>
<a href="index.php?action=logout"><button>Logout</button></a>
<div class="container">
    <h1>Welcome <?php echo $_SESSION['loggedInUserName']; ?>!</h1>
    <p id="currDateTime"></p>
    <form action="index.php" method="post">
        <input type="time" id="timeIn" name="timeIn" value="<?php echo $attendance->getTimeIn() ?>" readonly>
        <input type="button" id="timeInBtn" onclick="markTime('#timeIn')" value="Time In" <?php if ($attendance->getTimeIn() != '') echo "disabled" ?>>
        <input type="time" id="timeOut" name="timeOut" value="<?php echo $attendance->getTimeOut() ?>" readonly>
        <input type="button" id="timeOutBtn" onclick="markTime('#timeOut')" value="Time Out" <?php if ($attendance->getTimeOut() != '') echo "disabled" ?>>
        <br>
        <input class="button" type="submit" id="submit" name="attendanceSubmit" value="Save" <?php if ($attendance->getTimeOut() != '') echo "disabled" ?>>
    </form>
</div>
<?php if ($_GET['status'] == "success") : ?>
    <h2 class="success" id="success">Attendance Marked Successfully!</h2>
<?php elseif ($_GET['status'] == "failed") : ?>
    <p class="error">*An Error has occurred*</p>
<?php endif; ?>
</body>

</html>