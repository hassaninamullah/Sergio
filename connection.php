<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "employee_ques_ans_app_db";
	$conn = mysqli_connect($servername, $username, $password, $db_name);
	if(!$conn)
	{
	   die("Connection failed: " . mysqli_connect_error());
	}
?>