<?php
session_start();
if (!isset($_SESSION["User"])){
	header("Location: login.php");
	exit();
	}
?>