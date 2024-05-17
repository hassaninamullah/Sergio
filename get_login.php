<?php
	include("connection.php");
	header('Content-type: application/json');
	if( !empty($_POST['jms_email_id']) && !empty($_POST['jms_password']))
	{
		if(filter_var($_POST['jms_email_id'], FILTER_VALIDATE_EMAIL) !== false)
		{
			$jms_email_id = mysqli_real_escape_string($conn, $_POST['jms_email_id']);
			$jms_password = mysqli_real_escape_string($conn, md5($_POST['jms_password']));

			$sql_select = "SELECT * FROM tbl_employee_master WHERE email_id='$jms_email_id' and password='$jms_password'";
			$result_select = mysqli_query($conn, $sql_select);

			if(mysqli_num_rows($result_select) == 1)
			{
				$users_data = mysqli_fetch_array($result_select);

	            $_SESSION['jms_emp_id'] = $users_data["id"];	            

	            $response_array['status'] = 'success';
				$response_array['message'] = 'Login successfully done. Redirecting...';
				echo json_encode($response_array); 
			}
			else
			{
				$response_array['status'] = 'error';
				$response_array['message'] = 'Invalid email id or password';
				echo json_encode($response_array);
			}
		}
		else
		{
			$response_array['status'] = 'error';
			$response_array['message'] = 'Invalid email id';
			echo json_encode($response_array);
		}
	}
	else
	{
		$response_array['status'] = 'error';
		$response_array['message'] = 'All form fields required';
		echo json_encode($response_array);
	}
?>