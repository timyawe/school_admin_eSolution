<?php
session_start();
//connect to database
require "dbconn.inc";

//Check if user has submitted form
if ($_POST["login"] != "" ) {
	$CurrentUser = $_POST["username"];
	$UserPassword = md5($_POST["password"]);
	
	//Select user and password from database
	$sql = "SELECT Username, Password FROM Users_Information WHERE Username = '$CurrentUser' AND Password = '$UserPassword";
	$result = mysqli_query($conn, $sql);

	//Verifying login details
	if (mysqli_num_rows($result) == 0){
		$_SESSION['login_failure'] = "<span class='alert-response-error'>
		Sorry, Username and Password do not match any User, please try again!</span>";
		header ("Location: login.php");
		} else {
			$row = mysqli_fetch_assoc($result);
			$_SESSION["User"] = $row["Username"];
			$_SESSION["UserType"] = $row["UserType"];
			$userID = $row["ID"];
			if (mysqli_query($conn,"INSERT INTO Activitylog_Information (Activity,Date_Created,UserID)VALUES('logged in',NOW(),'$userID')")){
				header("Location: index.php");
			} else {
				$_SESSION['login_failure'] = "<span class='alert-response-error'>
				Sorry, An error occurred:<code>". mysqli_error($conn). "</code>, please try again!</span>";
				header("Location: login.php");
			}
		}
}

?>