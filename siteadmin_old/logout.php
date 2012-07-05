<?php
ob_start();
session_start();
unset($_SESSION['admin_id']);
session_destroy();
header("location:index.php");
?>