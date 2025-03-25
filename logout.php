<?php
session_start();

// Destroy session for both admin and student
session_unset();
session_destroy();

header("Location: login.php");
exit();
?>
