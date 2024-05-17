<?php
include("connection.php");
header('Content-type: application/json');

require 'admin/vendor/PHPMailer/src/Exception.php';
require 'admin/vendor/PHPMailer/src/PHPMailer.php';
require 'admin/vendor/PHPMailer/src/SMTP.php';
require 'admin/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function randomPassword()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array();
	$alphaLength = strlen($alphabet) - 1;
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass);
}

if (!empty($_POST['jms_email_id'])) {
	if (filter_var($_POST['jms_email_id'], FILTER_VALIDATE_EMAIL) !== false) {
		$jms_email_id = mysqli_real_escape_string($conn, $_POST['jms_email_id']);
		$sql_select = "SELECT * FROM tbl_employee_master WHERE email_id='$jms_email_id'";
		$result_select = mysqli_query($conn, $sql_select);
		if (mysqli_num_rows($result_select) == 1) {
			$new_pass = randomPassword();
			$new_pass_md5 = md5($new_pass);

			$email = $jms_email_id;

			if (sendEmail($email, $new_pass)) {
				$sql_update = "UPDATE tbl_employee_master SET password='$new_pass_md5' WHERE email_id='$jms_email_id'";
				if (mysqli_query($conn, $sql_update)) {
					$response_array['status'] = 'success';
					$response_array['message'] = 'New password sent to your email id';
					echo json_encode($response_array);
				} else {
					$response_array['status'] = 'error';
					$response_array['message'] = 'Sorry something wrong';
					echo json_encode($response_array);
				}
			} else {
				$response_array['status'] = 'error';
				$response_array['message'] = 'Error. Email not sent';
				echo json_encode($response_array);
			}
		} else {
			$response_array['status'] = 'error';
			$response_array['message'] = 'There is no account associated with this email id';
			echo json_encode($response_array);
		}
	} else {
		$response_array['status'] = 'error';
		$response_array['message'] = 'Invalid email id';
		echo json_encode($response_array);
	}
} else {
	$response_array['status'] = 'error';
	$response_array['message'] = 'All form fields required';
	echo json_encode($response_array);
}

function sendEmail($to, $new_pass, $subject = 'Portal Temporary Password', $from = 'noreply@opexx.us')
{
	// Create auto-reply message
	$message = "<p>Portal temporary password: $new_pass</p>";

	// Send email
	$mail = new PHPMailer(true);
	try {
		$mail->isSMTP();
		$mail->Host = 'smtp.titan.email';
		$mail->SMTPAuth = true;
		$mail->Username = 'noreply@opexx.us';
		$mail->Password = 't,tN6p.]@|!%hN+';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port = 465;

		$mail->setFrom($from);
		$mail->addAddress($to);
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body = $message;

		$mail->send();
		return true;
	} catch (\Exception $e) {
		return false;
	}
}
