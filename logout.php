<?php
@session_start();
ob_start();
session_destroy();
echo "string";
header("location: login.php");

ob_flush();
?>