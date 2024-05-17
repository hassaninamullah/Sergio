<?php
    include("connection.php");
    header('Content-type: application/json');
    
    if(!isset($_SESSION['jms_emp_id']))
    {
        header("location:index.php");
    }

    $jms_emp_location       = $_POST['jms_emp_location'];
    $jms_manager            = $_POST['jms_manager'];
    $jms_question_id        = $_POST['jms_question_id'];
    $jms_count_description  = $_POST['jms_count_description'];
    $answer_in_detail_array = [];
    $array                  = [];
    $target_dir             = "img/";
    $allowedImageType       = array('jpg','png','jpeg','gif');
    $allowedVideoType       = array('mp4','mov','avi');
    $file_data              = [];

    for ($i=0; $i < $jms_count_description; $i++) 
    { 
        array_push($answer_in_detail_array, $_POST['jms_answer_in_detail_'.$i+1]);
        array_push($array, $_POST['jms_radio_yes_no_'.$i+1]);

        $tmpFile = $_FILES['jms_custom_file']['tmp_name'][$i]; 
        $file_name = $_FILES["jms_custom_file"]["name"][$i];

        $target_dir     = "img/";
        $file_extension = strtolower(pathinfo(($target_dir . basename($file_name)), PATHINFO_EXTENSION));

        $allowedImageType = array('jpg','png','jpeg','gif');
        $allowedVideoType = array('mp4','mov','avi');

        if (in_array($file_extension, $allowedImageType)) 
        {
            $new_file_name = uniqid("image_").".".$file_extension;
            if(move_uploaded_file($tmpFile,($target_dir .$new_file_name)))
            {
                array_push($file_data,$new_file_name);
            }
        }
        elseif(in_array($file_extension, $allowedVideoType))
        {
            $new_file_name = uniqid("video_").".".$file_extension;
            if(move_uploaded_file($tmpFile,($target_dir.$new_file_name)))
            {
                array_push($file_data,$new_file_name);
            }
        } 
        else
        {
            $new_file_name = $file_extension;
            array_push($file_data,$new_file_name);
        } 
    }
    $jms_radio_yes_no = implode(',',$array);
    $jms_answer_in_detail = json_encode($answer_in_detail_array);
    $jms_file_data = json_encode($file_data);
    $jms_emp_id = $_SESSION['jms_emp_id'];


    $sql = "INSERT INTO tbl_individual_emp_answer_set_master (users_id,question_id,answer,answer_in_detail,file_data,emp_location,manager) VALUES ('$jms_emp_id','$jms_question_id','$jms_radio_yes_no','$jms_answer_in_detail','$jms_file_data','$jms_emp_location','$jms_manager')";

    if(mysqli_query($conn, $sql))
    {
        $response_array['status'] = 'success';
        $response_array['message'] = "Record added successfully";
        echo json_encode($response_array);
    }
    else
    {
        $response_array['status'] = 'error';
        $response_array['message'] = 'Something wrong, data not inserted into database';
        echo json_encode($response_array);  
    }
?>
