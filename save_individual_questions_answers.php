<?php
include("connection.php");
header('Content-type: application/json');

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}
$updated_on = date('Y-m-d H:i:s');

$jms_emp_location       = $_POST['jms_emp_location'];
$jms_manager            = $_POST['jms_manager'];
$jms_question_id        = $_POST['jms_question_id'];
$jms_count_description  = $_POST['jms_count_description'];
$answer_in_detail_array = [];
$array                  = [];
$target_dir             = "img/answers/";
$allowedImageType = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
$allowedVideoType = ['mp4', 'mov', 'avi', 'webm', 'AVI', 'webM'];
$jms_file_data = $_POST['fileNames'];
$qualify_answers = $_POST['qualifyAnswers'];

$fileNames = json_decode($_POST['fileNames'], true);

// Check if files were uploaded
if (!empty($_FILES['file']['tmp_name'])) {
    foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) {
        if (isset($fileNames[$key])) {
            $destination = $target_dir . $fileNames[$key];
            move_uploaded_file($tmp_name, $destination);
        }
    }
}

if (isset($_POST['company_name'])) {
    $company_name = $_POST['company_name'];

    $sql = "UPDATE companies SET end_time = '$updated_on' where company_name = '$company_name'";
    mysqli_query($conn, $sql);
}

$jms_answer_in_detail = $_POST['answerData'];
$visit_no = $_POST['visits'];
$company_name = $_POST['visits'];
$jms_emp_id = $_SESSION['jms_emp_id'];
$start_time = $_POST['start_time'];

$sql = "INSERT INTO tbl_individual_emp_answer_set_master (users_id,question_id,answer,answer_in_detail,file_data,emp_location,manager,visit_no,start_time,end_time) VALUES ('$jms_emp_id','$jms_question_id','$qualify_answers','$jms_answer_in_detail','$jms_file_data','$jms_emp_location','$jms_manager','$visit_no','$start_time','$updated_on')";

if (mysqli_query($conn, $sql)) {
    $response_array['status'] = 'success';
    $response_array['message'] = "Record added successfully";
    echo json_encode($response_array);
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Something wrong, data not inserted into database';
    echo json_encode($response_array);
}
