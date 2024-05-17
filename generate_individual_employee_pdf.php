<?Php
include("connection.php");
header('Content-type: application/json');
include('admin/vendor/autoload.php');

$jms_id = $_POST['jms_answer_id'];
$jms_uid = $_POST['jms_user_id'];
$primary_id = $_POST['primary_id'];
// $jms_chart_id = $_POST['jms_chart_id']; 

$sql = "SELECT emp_date.first_name AS first_name,emp_date.last_name AS last_name,emp_date.email_id AS email_id,question_id,emp_question_set_name,emp_question_description,emp_location,manager,emp_logo_file,answer,company_name,answer_in_detail,file_data,emp_date.id as user_id,answer.id as answer_id,answer.visit_no as visit_no,start_time,end_time FROM tbl_individual_emp_answer_set_master answer 
    LEFT JOIN tbl_individual_emp_question_set_master question on question.id = answer.question_id 
    RIGHT JOIN tbl_employee_master emp_date on answer.users_id = emp_date.id
    WHERE answer.id =  $primary_id and answer.users_id = $jms_uid";


$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

$jms_fName = $data['first_name'];
$jms_lname = $data['last_name'];
$jms_email_id = $data['email_id'];
$jms_question_set_name = $data['emp_question_set_name'];
$jms_description = json_decode($data['emp_question_description'], true);
$jms_emp_location = $data['emp_location'];
$jms_manager = $data['manager'];
$jms_logo_file = $data['emp_logo_file'];
$visits = $data['visit_no'];
$company_name = $data['company_name'];
$description = json_decode($data['answer_in_detail'], true);
$jms_file_data = json_decode($data['file_data'], true);
$jms_file_data_array = implode(',', $jms_file_data);
$formatted_start_date = date('M d g:i:s a', strtotime($data['start_time']));
$formatted_end_date = date('M d g:i:s a', strtotime($data['end_time']));
$jms_answer = json_decode($data['answer'], true);
$yesCount = 0;
$noCount = 0;

foreach ($jms_answer as $qualifyingQuestion) {
    $answerValue = strtolower($qualifyingQuestion['answer']??'');

    if ($answerValue === 'yes') {
        $yesCount++;
    } elseif ($answerValue === 'no') {
        $noCount++;
    }
}

$totalQuestions = $yesCount + $noCount;

$yesPercentage = ($totalQuestions > 0) ? ($yesCount / $totalQuestions) * 100 : 0;
function getBaseUrl()
{
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    $url = str_replace("/admin", "", ($protocol . '://' . $hostName . $pathInfo['dirname'] . "/img/"));
    return $url;
    //return $protocol.'://'.$hostName.$pathInfo['dirname']."/img/";
}

$path = 'img/' . $jms_logo_file;
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


$path2 = 'img/admin/logo.png';
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data2 = file_get_contents($path2);
$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

$html = '<html>
            <head>
                        <style>
                            table
                            {
                                width:100%;
                                margin:px;
                            }
                            th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                            }
                            th, td {
                                padding:10px;
                            }
                            th{
                                text-align: left;
                            }
                            .jms-image-box{
                                text-align: center;
                                margin-top:0px;
                                margin-bottom:5px;
                            }
                            .jms-box 
                            {
                              width: 300px ;
                              height: 150px;  
                              padding: 10px;
                              box-sizing: border-box;
                              font-weight:normal;
                              font-size: 20px;
                            }
                            .jms-chartBox {
                                width: 300px !important;
                                height: 150px !important; 
                            }

                            .box {
                            background-color: #D6B158;
                            width: auto;
                            padding: 10px;
                            color: white;
                            height: auto;
                        }
                        .font-weight-bold{
                            font-weight: bold;
                        }
                        .poppins {
                            font-family: "Poppins", sans-serif;
                        }

                        body {
                            font-family: "Poppins", sans-serif;
                        }

                        .pass {
                            font-size: 72.17px;
                            text-transform: capitalize;
                            color: #d6b158;
                            font-weight: bolder;
                            /* text-align: end; */
                        }

                        p {
                            margin-top: 0;
                            margin-bottom: 0rem !important;
                        }

                        .div2 {
                            /* width: 300px; */
                            height: 100px;
                            padding: 39px;
                            border: 1px solid #CFCFCF;
                            text-align: center;
                            background: #E9E9E9;
                            color: #B1B1B1;
                        }

                        .green{
                        color: #72DE05;
                        font-weight: 400;
                        font-size: 16px;
                        }

                        .service1 {
                            font-size: 18px;
                            line-height: 15px;
                            color: #000;
                            text-align: center;
                            font-weight: bold;
                        }

                        .box2 {
                            background-color: #F1E5AC;
                            width: auto;
                            padding: 10px;
                            color: white;
                            height: auto;
                        }



                        .service {
                            font-size: 18px;
                            line-height: 15px;
                            color: #fff;
                            text-align: center;
                            font-weight: bold;
                        }

                        /* .pos-fixed{
                            position: fixed;
                            width: 20%;
                        } */

                        .ml-10 {
                            /* margin-left: -10%; */
                            padding: 9px 0px 9px 1px;
                        }

                        /* ul{
                            overflow:hidden;
                            } */
                        .mr-28 {
                            display: inline-block;
                            margin-right: 24%;
                        }

                        table {
                            /* font-family: arial, sans-serif; */
                            border-collapse: collapse;
                            width: 100%;
                            background: white;
                        }

                        td,
                        th {
                            border: 1px solid #c8c8c8;
                            text-align: left;
                            padding: 8px;
                        }

                        /* tr:nth-child(even) {
                                background-color: #dddddd;
                            } */

                        .ptb-10 {
                            padding-top: 10px;
                            padding-bottom: 10px;
                        }


                        .pass1 {

                            font-size: 20px;
                            color: #d6b158;

                        }

                        .h-100{
                            height: 100%;
                        }

                        .department {

                            font-size: 26px;
                            text-transform: capitalize;
                            color: #000;
                            font-weight: bold;
                        }

                        .form-control1 {
                            display: block;
                            width: 100%;
                            height: calc(2.25rem + 2px);
                            padding: 0.375rem 0.75rem;
                            font-size: 1rem;
                            font-weight: 400;
                            line-height: 1.5;
                            color: #495057;
                            outline: none;
                            background-color: transparent;
                            background-clip: padding-box;
                            border-top: 1px solid transparent;
                            border-left: 1px solid transparent;
                            border-right: 1px solid transparent;
                            border-bottom: 1px solid #ced4da;
                            border-radius: 0.25rem;
                            box-shadow: inset 0 0 0 transparent;
                            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
                        }

                        .btn-7 {
                            border-radius: 3.48px !important;
                            background-color: #fff !important;
                            width: auto;
                            color: #000 !important;
                            border-radius: 3.48px !important;
                            width: auto;
                            border: 1px solid #ABB1B7 !important;
                        }

                        .pt-8{
                            padding-top: 8rem;
                        }
                        .jms_question_set_name {
                            font-size: 25px;
                            font-weight: 600;
                            /* padding-top: 8rem; */
                        }

                        /* .btn-light1 {
                            width: 100%;
                            
                            border-radius: 3.48px;
                            background-color: #fff;
                            border: 1.2px solid #abb1b7;
                            box-sizing: border-box;
                            font-size: 18.54px;
                            line-height: 24.47px;
                            font-weight: 600;
                            color: #000;
                        
                            } */

                            .card-body1 {
                                -webkit-flex: 1 1 auto;
                                -ms-flex: 1 1 auto;
                                flex: 1 1 auto;
                                min-height: 1px;
                                padding: 1.25rem;
                                background: #f3f3f3;
                            }

                            .ptb-15{
                                padding-top: 10px;
                                padding-bottom: 15px;
                            }

                            .mtb-15{
                                margin-top: 10px;
                                margin-bottom: 15px;
                            }

                            .btn-3 {
                                border-radius: 3.48px !important;
                                background-color: #343a40 !important;
                                width: auto;
                                color: white !important;
                                border-radius: 3.48px !important;
                                width: auto;
                            }

                            .btn-4 {
                                border-radius: 3.48px !important;
                                background-color: #133386 !important;
                                width: auto;
                                color: white !important;
                                border-radius: 3.48px !important;
                                width: auto;
                            }

                            .h-26{
                                height: 26rem !important;
                            }


                        .btn-5 {
                            border-radius: 3.48px !important;
                            /* background-color: #343a40 !important; */
                            width: auto;
                            color: black !important;
                            /* border-radius: 3.48px !important; */
                            width: auto;
                            border-radius: 4.57px !important;
                            background-color: #e0e0e0 !important;
                            padding: 10px 30px !important;
                        }

                        

                            .btn-2 {
                                background-color: #f8f9fa !important;
                                border-radius: 3.48px;
                                background-color: #fff !important;
                                border: 1.2px solid #abb1b7 !important;
                                width: 20%;
                                font-size: 18.54px !important;
                                line-height: 24.47px !important;
                                font-weight: 600 !important;
                            }

                            .btn-secondary {
                                
                                /* background-color: #6c757d; */
                                /* border-color: #6c757d; */
                                box-shadow: none;
                                background-color: #dadada !important;
                                border: 1.2px solid #ced4da !important;
                                width: 20%;
                                border-radius: 3.48px;
                                color: black !important;
                                font-size: 18.54px !important;
                                line-height: 24.47px !important;
                                font-weight: 600 !important;
                            }
                            
                        /* .ds-tab td,
                        th {
                            border: none;
                        }

                        .ds-tab .tr-3 {
                            border: solid 2px #C8C8C8;
                            margin-top: 20px;
                            position: absolute;
                            width: calc(99% - 4px);
                            left: 8px;
                            right: 0px;
                            background: #ffffff;
                        } */


                        .fs-20{
                            font-size: 20px;
                            font-weight: bold;
                        }

                        .box {
                            background-color: #D6B158;
                            width: auto;
                            padding: 10px;
                            color: white;
                            height: auto;
                        }

                        .box1 {
                            background-color: #f3f3f3;
                            width: auto;
                            padding: 15px;
                            color: black;
                            height: auto;
                            border: 1px solid #D6D7D8;
                        }

                        .oppoortunity1 {
                            color: #958080;
                            font-size: 17px;
                            font-weight: 400;
                            width: 33%;
                        }

                        .risk-levels {

                            font-size: 20px;
                            line-height: 38px;
                            color: #000;
                        }

                        .w-10 {
                            width: 7%;
                            border-radius: 50%;
                        }

                        .w-60 {
                            width: 60%;
                        }

                        .card-header{
                            background-color: #133386;
                        }

                        .boxes-container {
                        display: flex;
                        justify-content: space-between;
                        width: 100%;
                    }
                    .mt-1{
                        margin-top: 2rem !important;
                    }
                    .mb-1{
                        margin-bottom: 1rem !important;
                    }
                    .box {
                        width: 20%;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        padding: 10px;
                    }

                    .service1 {
                        font-size: 16px;
                        margin-bottom: 5px;
                    }

                    .service {
                        font-size: 14px;
                        margin: 0;
                    }

                    .row {
                        display: flex;
                        flex-wrap: wrap;
                        margin-bottom: 20px;
                    }
                    .col-custom {
                        flex: 1;
                        padding: 0 10px;
                        box-sizing: border-box;
                    }

                    .image-custom {
                        width: 20%;
                        height: auto;
                    }

                        </style>
                        
                    </head>
                    <body>
                        <div>
                            <section style="display: flex;flex-direction: column;">
                                <div class="row mb-4" style="display: flex; flex-direction: column; align-items: center;">
                                    <div class="col-custom">
                                        <img class="image-custom" src="' . $base642 . '" alt="">
                                    </div>
                                    <div class="col-custom" style=" margin-top: -6rem; text-align: center;">
                                        <p class="kfc-inspection poppins" style="font-size: 36px; color: #000; font-weight: bold; padding-top: 15px; word-wrap: break-word;">
                                            ' . $jms_question_set_name . '
                                        </p>
                                    </div>
                                    <div class="col-custom" style="position: absolute; margin-left: 37rem; top: 0rem; width: 100%;">
                                        <img class="image-custom" src="' . $base64 . '" alt="">
                                    </div>
                                </div>
                                
                                <div class="box">
                                    <div class="row">
        
                                        <div class="col-md-12" style="margin-top: 5%;">
                                            <p class="service2" style="text-align: center;height: 0%;font-size: 15px;font-weight: bold;color: #000;padding-bottom: 10px;" >Score : '.  round($yesPercentage, 2) . '% </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row"  style="display: flex;">
                                    <div class="col-md-12 ">
                                       
                                      
                                        <div class="">
                                            <div class="jms-box ">
                                                <div class="" >
                                                    <div style="font-weight: bold;margin-top: 0%;">This Evaluation Info </div><br>
                                                </div>
                
                                                <div class="boxes-container " style="display: flex;margin-top: 6%;">
                                                    <div class="abc" style="margin-top: -1.5%;">
                                                    <div class="col-md-2 align-items-center" style="width: 67%;">
                                                        <div class="box2">
                                                        <div class="col-md-12">
                                                                    <p class="service1">Company Name</p>
                                                                </div>
                                                        </div>
                                                                
                
                                                        <div class="box" style="width: 90%;height: 1rem;">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $company_name . ' </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="width: 30%;
                                                    position: absolute;
                                                    left: 14rem;
                                                    top: 14%;margin-top: 10%;">
                                                        <div class="box2" >
                                                            <div class="col-md-12">
                                                                <p class="service1">Start</p>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="box" style="width: 90%;height: 1rem;">
                
                                                            <div class="row">
                                                               
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $formatted_start_date . '</p>
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="width: 33%;
                                                    position: absolute;
                                                    left: 29rem;
                                                    top: 14%;
                                                    margin-top: 10%;">
                                                        <div class="box2">
                                                        <div class="col-md-12">
                                                            <p class="service1">End</p>
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="box"  style="width: 90%;height: 1rem;">
                
                                                            <div class="row">
                                                                
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $formatted_end_date . '</p>
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 8%;">
                                                    <div class="col-md-2 align-items-center" style="width: 67%;">
                                                        <div class="box2">
                                                    <div class="col-md-12">
                                                                    <p class="service1">Location</p>
                                                                </div>
                                                                </div>
                                                                
                
                                                        <div class="box" style="width: 90%;height: 1rem;">
                                                            <div class="row">
                                                               
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $jms_emp_location . ' </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="width: 30%;
                                                    position: absolute;
                                                    left: 14rem;
                                                    top: 24.5%;margin-top: 10%;">
                                                        <div class="box2" >
                                                            <div class="col-md-12">
                                                                <p class="service1">Manager</p>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="box" style="width: 91%;height: 1rem;">
                
                                                            <div class="row">
                                                               
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $jms_manager . '</p>
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="width: 33%;
                                                    position: absolute;
                                                    left: 29rem;
                                                    top: 24.5%;
                                                    margin-top: 10%;">
                                                        <div class="box2">
                                                        <div class="col-md-12">
                                                            <p class="service1">Round</p>
                                                        </div>
                                                    </div>
                                                        <div class="box"  style="width: 91%;height: 1rem;">
                
                                                            <div class="row">
                                                                
                                                                <div class="col-md-12">
                                                                    <p class="service">' . $visits . '</p>
                                                                </div>
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br>';
                                    $html .= '<div style="display: flex; justify-content: center;margin-top: 0%;">
                                        <div style="max-width: 800px; width: 100%;">
                                            <div class="card-header">
                                                <h3 style="padding: 10px;color: white;">View Answers</h3>
                                            </div>';
                                    if ($description !== null && json_last_error() === JSON_ERROR_NONE) {
                                        $counting = 1;
                                        foreach ($description as $questionSet) {
                                            $html .= '<div class="dynamicData">
                                                <!-- <div class="border-bottom"></div> -->
                                                <div class="">
                                                    <div class="box1">
                                                    <p class="fs-30 titleField " style="">' . $questionSet['title'] . '</p>
                                                    <div style="border-bottom: 1px solid #D6D7D8;margin-top: 2%;"></div>
                                                        <div class="question ">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="qualify">
                                                                        <h4>Qualifying Question</h4>
                                                                        <input style="width: 95%; padding: 5px; box-sizing: border-box; margin-bottom: 10px;height: 25px;" class="form-control field_value qualifyingQuestion" name="qualifyingQuestion" type="text" placeholder="Text" disabled value="' . ($questionSet['qualifyingQuestion'] ?? '') . '">
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <p class="bold"><span class="font-weight-bold">Answer: </span>' . ($questionSet['qualifyingAnswer'] ?? 'Not Available') . '</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                            
                                                            <div id="dynamicFieldContainer" class="dynamicFieldContainer">';
                                            $count = 1;
                                            foreach ($questionSet['questions'] as $question) {
                                                
                                                $uploadPic = '';
                                                if (isset($question['fileName'])) {
                                                    $path3 = 'img/answers/' . $question['fileName'];
                                                    if (file_exists($path3)) {
                                                        $type3 = pathinfo($path3, PATHINFO_EXTENSION);
                                                        $data3 = file_get_contents($path3);
                                                        $uploadPic = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);
                                                    }
                                                }
                                                $html .= '<div class="dynamicField my-1">
                                                <div class="col-md-12">
                                                    <label for="jms_question" class=" font-weight-bold"style="margin-bottom: 1rem;">Question - ' . $count . '</label>
                                                 <div class="bbc" style="margin-top: 2%;"></div>
                                                    <input style="width: 95%; padding: 5px; box-sizing: border-box; margin-bottom: 15px;height: 25px;" type="text" class="form-control questionField" id="" name="dynamicField[]" placeholder="Type Question" value="' . ($question['question'] ?? '') . '" disabled>
                                                </div>';
                                                if ($question['responseType'] === 'mcqs') {
                                                    $html .= '<div class="form-check">
                                                    <p class="bold"><span class="font-weight-bold" style="margin-bottom: 1rem;">Answer: </span>' . ($question['answer'] ?? 'Answer Not Available') . '</p>
                                                </div>';
                                                }
                                                if ($question['responseType'] === 'checkBox' && isset($question['answers'])) {
                                                    $optionsCount = 1;
                                                    $html .= '<div class="form-check">
                                                            <p class="bold"><span class="font-weight-bold">Answers: </span></p>
                                                        </div>';
                                                    foreach ($question['answers'] as $option) {
                                                        $html .= '<div class="form-check">
                                                            <label class="form-check-label" for="responseTypeFields">' . $optionsCount . '. ' . ($option ?? '') . '</label>
                                                        </div>';
                                                        $optionsCount++;
                                                    }
                                                }
                                                if ($question['responseType'] === 'textInput') {
                                                    $html .= '<div class="form-check">
                                                            <p class="bold"><span class="font-weight-bold">Answer: </span>' . ($question['answer'] ?? 'Not Available') . '</p>
                                                        </div>';
                                                }
                                                if ($question['responseType'] === 'uploadFile') {
                                                    $file_extension = pathinfo($question['fileName'], PATHINFO_EXTENSION);
                                                    if (in_array($file_extension, ['png', 'jpeg', 'jpg', 'gif','webp'])) {
                                                        $html .= ' <div class="col-custom">
                                                                        <img class="image-custom" src="' . $uploadPic . '" alt="">
                                                                    </div>';
                                                    } elseif (in_array($file_extension, ['mov', 'webm', 'mp4','webM','AVI'])) {
                                                        $html .= '<div class="form-check">
                                                                    <p class="bold"><span class="font-weight-bold">Answer: "' . $file_extension . '"</span></p>
                                                                 </div>';
                                                    }
                                                }
                                                

                                                $html .= '</div>';
                                                $count++;
                                                $counting++;
                                            }
                                $html .= '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
}
                            }
                            $html .= '</div>
                </div>
            </body>
        </html>';


$jms_pdf_name = str_replace(' ', '_', "$jms_fName") . "_" . str_replace(' ', '_', "$jms_question_set_name") . "_" . uniqid() . "." . "pdf";

$jms_pdf_file_name = "admin/pdf_save/" . $jms_pdf_name;

$pdf = new Dompdf\Dompdf();
$pdf->load_html($html);
$pdf->render();
$output = $pdf->output();
file_put_contents($jms_pdf_file_name, $output);

$response_array['jms_pdf_name'] =  $jms_pdf_name;
$response_array['jms_pdf_file_name'] =  $jms_pdf_file_name;


$response_array['status'] = "success";

echo json_encode($response_array);
