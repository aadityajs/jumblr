<?php
require("config.inc.php");
ob_start();
session_start();

unset($_SESSION["muser_id"]);
header("location:".SITE_URL);
?>