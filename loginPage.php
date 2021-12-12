<?php
session_start();
require_once ('includes/header.php');

?>
<div class="container" id="loginFormDiv">
    <h2>Login</h2>
    <?php if (isset($_GET['error'])): ?>
    <p class="error">*Email or Password is incorrect*</p>
    <?php endif; ?>
    <form name="loginForm" action="index.php" method="post">
        <input type="text" id="empEmail" name="empEmail" placeholder="Enter email" required>
        <br>
        <input type="password" id="empPassword" name="empPassword" placeholder="Enter password" required>
        <br>
        <input class="button" type="submit" id="submit" name="loginSubmit" value="Login">
        <br>
    </form>
</div>
</body>

</html>

