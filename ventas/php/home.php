<?php
error_reporting(0);
include 'connect.php';
session_start();
if (empty($_SESSION['email'])) {
header("location: login.php");
}
echo $_SESSION[nombre];
?>