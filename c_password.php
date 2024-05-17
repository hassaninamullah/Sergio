<?php
	include("connection.php");
	if(!isset($_SESSION['jms_emp_id']))
  	{
    	header("location:index.php");
  	}
	header('Content-type: application/json');
	if( !empty($_POST['c_pw']) && !empty($_POST['n_pw']) && !empty($_POST['cn_pw']))
	{
		if($_POST['n_pw']==$_POST['cn_pw'])
		{
			$jms_emp_id=$_SESSION['jms_emp_id'];
			$c_pw 	= mysqli_real_escape_string($conn, md5($_POST['c_pw']));

			$sql_select = "SELECT * FROM tbl_employee_master WHERE password='$c_pw' and id='$jms_emp_id'";
			$result_select = mysqli_query($conn, $sql_select);
			if(mysqli_num_rows($result_select) == 1)
			{
		        $n_pw 	= mysqli_real_escape_string($conn, md5($_POST['n_pw']));
		        	
		        $sql = "UPDATE tbl_employee_master SET password='$n_pw' WHERE id='$jms_emp_id'";
		        if(mysqli_query($conn, $sql))
		        {
		        	$response_array['status'] = 'success';
					$response_array['message'] = 'Password changed successfully';
					echo json_encode($response_array);
		        }
		        else
		        {
		        	$response_array['status'] = 'error';
					$response_array['message'] = 'Something wrong, data not updated into database';
					echo json_encode($response_array);	
		        }   
		    }
		    else
			{
			    $response_array['status'] = 'error';
				$response_array['message'] = 'Wrong current password';
				echo json_encode($response_array);
			}
		}
		else
		{
		   	$response_array['status'] = 'error';
			$response_array['message'] = 'New password and Confirm Password not matched';
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