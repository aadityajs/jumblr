<?php

require("config.inc.php");
ob_start();
session_start();

session_destroy();
header("location:merchant.php");

?>