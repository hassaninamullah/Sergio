<?php
include("connection.php");

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}

$jms_users_id = $_SESSION['jms_emp_id'];
if (isset($_GET['id'])) {
    $jms_id = $_GET['id'];
    $primary_id = $_GET['primary_id'];

    $sql = "SELECT * FROM tbl_answer_set_master where id = $primary_id and users_id=$jms_users_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
        header("location:view_emp_answers.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>


    <title>Answers</title>
</head>


<style>
    .form-check {
        position: relative;
        display: block;
        padding-left: 1.25rem;
        padding-top: 10px;
    }

    .hidden-section {
        display: none;
    }

    .w-6 {
        width: 6%;
    }

    .w-20 {
        width: 20%;
    }

    .tr-3 {
        cursor: pointer;
    }

    .oppoortunity1 {
        color: #958080;
        font-size: 16px;
        font-weight: 400;
        width: 25%;
        background: #CED4DA;
    }

    .selected {
        background-color: #cce5ff;
        /* Change this to your desired background color */
    }

    .ml-20 {
        margin-left: 20px;
    }

    .display-none {
        display: none;
    }

    .pl-20 {
        padding-left: 20px;
    }

    .dynamicFieldPadding {
        padding: 0.25rem 1rem;
    }

    .card-body1.question {
        background-color: #E9E9E9;
        margin: 0px 18px 3px;
        border: 1px solid #CFCFCF;

    }

    .bg-custom {
        background-color: #F3F3F3;
    }

    .form-custom-padding {
        padding: 20px 18px 4px;
    }

    .q-padding {
        margin: 10px;

    }

    .card.bg-custom {
        box-shadow: none;
    }

    .br-50 {
        border-radius: 50%;
    }

    .card-primary:not(.card-outline)>.card-header {
        background-color: #133386;
    }

    .active {
        background-color: #133386 !important;
        color: #fff !important;
        transition: .2s linear;
    }

    .mr-16 {
        margin-right: 16px;
    }

    .w-30 {
        width: 30%;
    }

    .deleteDynamicSection {
        display: flex;
        justify-content: end;
    }

    .deleteDynamicSection i {
        color: red;
    }

    .qualify h4 {
        font-size: 18px;
        font-weight: bold;
        padding: 12px 0px;
    }

    .fs-30 {
        font-size: 30px;
        font-weight: bold;
    }

    .jms-box {
        width: auto;
        height: auto;
        padding: 15px;
        /* border: 1px solid lightgray; */
        /* box-sizing: border-box; */
        /* font-weight: normal; */
        /* font-size: 20px; */
        background-color: #fff;
        box-shadow: 0px 4px 34px rgba(0, 0, 0, 0.05);
        border: 1px solid #c8c8c8;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #D6B158;
        color: white;
    }

    .jms-chartBox {
        width: 495px !important;
        height: 250px !important;
        border: 1px solid lightgray;
        box-sizing: none;
        font-weight: normal;
    }
</style>


<body class="hold-transition sidebar-mini layout-fixed">

    <?php include("menu.php"); ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <?php
                $jms_id = $_GET['id'];
                $jms_emp_id = $_SESSION['jms_emp_id'];
                $primary_id = $_GET['primary_id'];

                $sql_select = "SELECT emp_date.id as user_id,emp_date.first_name as first_name,emp_date.last_name as last_name,email_id,question_set_name,logo_file,question_description,answer,answer_in_detail,file_data,emp_location,manager,company_name,answer.visit_no as visit_no,start_time,end_time,answer.question_id as answer_id,answer.id as primary_id FROM tbl_answer_set_master answer LEFT JOIN tbl_question_set_master question on question.id = answer.question_id RIGHT JOIN tbl_employee_master emp_date on answer.users_id = emp_date.id WHERE answer.id = $primary_id and users_id = $jms_emp_id";

                $result_select = mysqli_query($conn, $sql_select);
                $data = mysqli_fetch_array($result_select);
                // $company_name = $data['company_name']
                // $description = json_decode($data['question_description'],true);
                $description = json_decode($data['answer_in_detail'], true);
                $file_data = json_decode($data['file_data']);
                
                $formatted_start_date = date('M d g:i:s a', strtotime($data['start_time']));
                $formatted_end_date = date('M d g:i:s a', strtotime($data['end_time']));
                $answer = json_decode($data['answer'], true);


                $yesCount = 0;
                $noCount = 0;

                foreach ($answer as $qualifyingQuestion) {
                    $answerValue = strtolower($qualifyingQuestion['answer']??'');

                    if ($answerValue === 'yes') {
                        $yesCount++;
                    } elseif ($answerValue === 'no') {
                        $noCount++;
                    }
                }

                $totalQuestions = $yesCount + $noCount;

                $yesPercentage = ($totalQuestions > 0) ? ($yesCount / $totalQuestions) * 100 : 0;
                // $noPercentage = ($totalQuestions > 0) ? ($noCount / $totalQuestions) * 100 : 0;
                ?>
                <div class="row mb-4">
                    <div class="col-md-2 ">
                        <img class="w-100" src="img/admin/logo.png" alt="">
                    </div>
                    <div class="col-md-8">
                        <p class="kfc-inspection poppins text-center"><?php echo $data['question_set_name'] ?></p>
                    </div>
                    <div class="col-md-2">
                        <img class="w-100" src="img/<?php echo $data['logo_file'] ?>" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 align-items-center">
                        <div class="box">
                            <div class="row">

                                <div class="col-md-12">
                                    <p class="service2">Score : <?php echo round($yesPercentage, 2) ?>% </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="pos-fixed">
                            <div class="jms-box mb-2">
                                <div class="ptb-10">
                                    <span>This Evaluation Info </span><br>
                                </div>

                                <div class="row ">
                                    <div class="col-md-2 align-items-center">
                                        <div class="box2">
                                            <div class="col-md-12">
                                                <p class="service1">Company Name</p>
                                            </div>
                                        </div>

                                        <div class="box">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <p class="service"><?php echo $data['company_name'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="box2">
                                            <div class="col-md-12">
                                                <p class="service1">Start</p>
                                            </div>
                                        </div>

                                        <div class="box">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <p class="service"><?php echo $formatted_start_date ?> </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="box2">
                                            <div class="col-md-12">
                                                <p class="service1">End</p>
                                            </div>
                                        </div>

                                        <div class="box">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <p class="service"><?php echo $formatted_end_date; ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="box2">
                                            <div class="col-md-12">
                                                <p class="service1">Location</p>
                                            </div>
                                        </div>

                                        <div class="box">

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <p class="service"> <?php echo $data['emp_location'] ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="box2">
                                            <div class="col-md-12">
                                                <p class="service1">Manager</p>
                                            </div>
                                        </div>
                                        <div class="box">

                                            <div class="row">


                                                <div class="col-md-12">
                                                    <p class="service"> <?php echo $data['manager'] ?> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="">
                                            <div class="box2">
                                                <div class="col-md-12">
                                                    <p class="service1">Round</p>
                                                </div>
                                            </div>
                                            <div class="box">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <p class="service"> <?php echo $data['visit_no'] ?> </p>
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
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card card-primary mt-5">
                            <div class="card-header">
                                <h3 class="card-title">View Answers</h3>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="card card-primary mt-5">
                                        <!-- form start -->
                                        <form method="POST" name="jms_generate_pdf" id="jms_generate_pdf" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <?php
                                                if ($description !== null && json_last_error() === JSON_ERROR_NONE) {
                                                    $counting = 1;
                                                    foreach ($description as $questionSet) {
                                                ?>
                                                        <div class="dynamicData">
                                                            <p class="fs-30 titleField"> <?php echo $questionSet['title'] ?></p>
                                                            <div class="border-bottom"></div>
                                                            <div class="ptb-15">
                                                                <div class="box1">
                                                                    <div class="question ptb-15">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="qualify">
                                                                                    <h4>Qualifying Question</h4>
                                                                                    <input class="form-control field_value qualifyingQuestion" name="qualifyingQuestion" type="text" placeholder="Text" disabled value="<?php echo $questionSet['qualifyingQuestion'] ?? '' ?>">
                                                                                </div>
                                                                                <div class="form-check">
                                                                                    <p class="bold"><span class="font-weight-bold">Answer: </span><?php echo $questionSet['qualifyingAnswer'] ?? 'Not Available' ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div id="dynamicFieldContainer" class="dynamicFieldContainer">
                                                                            <?php
                                                                            $count = 1;

                                                                            foreach ($questionSet['questions'] as $question) {
                                                                            ?>
                                                                                <div class="dynamicField my-1">
                                                                                    <div class="col-md-12">
                                                                                        <label for="jms_question" class="mb-2">Question - <?php echo $count ?></label>
                                                                                        <input type="text" class="form-control questionField" id="" name="dynamicField[]" placeholder="Type Question" value="<?php echo $question['question'] ?>" disabled>

                                                                                    </div>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'mcqs') {
                                                                                    ?>
                                                                                        <div class="form-check">
                                                                                            <p class="bold"><span class="font-weight-bold">Answer: </span><?php echo $question['answer'] ?? 'Answer Not Available' ?></p>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'checkBox' && isset($question['answers'])) {
                                                                                        $optionsCount = 1;
                                                                                    ?>
                                                                                        <div class="form-check">
                                                                                            <p class="bold"><span class="font-weight-bold">Answers: </span></p>
                                                                                        </div>
                                                                                        <?php
                                                                                        foreach ($question['answers'] as $option) {
                                                                                        ?>
                                                                                            <div class="form-check">
                                                                                                <label class="form-check-label" for="responseTypeFields">
                                                                                                    <?php echo $optionsCount ?>. <?php echo $option ?? '' ?>
                                                                                                </label>
                                                                                            </div>
                                                                                    <?php
                                                                                            $optionsCount++;
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'textInput') {
                                                                                    ?>
                                                                                        <div class="form-check">
                                                                                            <p class="bold"><span class="font-weight-bold">Answer: </span><?php echo $question['answer'] ?? 'Not Available' ?></p>
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'uploadFile') {
                                                                                    ?>
                                                                                        <div class="form-check">
                                                                                            <p class="bold"><span class="font-weight-bold">Answer: </span></p>
                                                                                        </div>
                                                                                    <?php
                                                                                        $file_extension = pathinfo($question['fileName'], PATHINFO_EXTENSION);

                                                                                        if (in_array($file_extension, ['png', 'jpeg', 'jpg', 'gif','webp'])) {
                                                                                            echo '<a href="img/answers/' . $question['fileName'] . '" download><img class="w-20" src="img/answers/' . $question['fileName'] . '" alt="Uploaded Image" ></a>';
                                                                                        } elseif (in_array($file_extension, ['mov', 'webm', 'mp4','webM','AVI'])) {
                                                                                            echo '<video class="w-30" controls>';
                                                                                            echo '<source src="img/answers/' . $question['fileName'] . '" type="video/' . $file_extension . '">';
                                                                                            echo 'Your browser does not support the video tag.';
                                                                                            echo '</video>';
                                                                                        } else {
                                                                                            echo 'Unsupported file type.';
                                                                                        }
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            <?php
                                                                                $count++;
                                                                                $counting++;
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <div class="message"></div>
                                                <div class="card-footer">
                                                    <a href="view_answer_list.php" class="btn btn-primary">Back</a>
                                                    <button type="submit" class="btn btn-primary">Generate PDF</button>
                                                    <input type="hidden" value="<?php echo $data['answer_id']; ?>" id="jms_answer_id" name="jms_answer_id">
                                                    <input type="hidden" value="<?php echo $data['primary_id']; ?>" id="primary_id" name="primary_id">
                                                    <input type="hidden" value="<?php echo $data['user_id']; ?>" id="jms_user_id" name="jms_user_id">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include("footer.php"); ?>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#jms_generate_pdf").on('submit', function(e) {
                // console.log("PDF CLICKED");
                // $("#jms_chart_id").val(marginyChart.toBase64Image());

                e.preventDefault();
                $.ajax({
                    url: "generate_pdf.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {},
                    success: function(data) {
                        if (data.status == 'error') {
                            $('.message').css('display', 'block');
                            $('.message').html("<div class='alert alert-danger text-center' role='alert'>" + data.message + "</div>");
                        } else if (data.status == 'success') {
                            var url = data.jms_pdf_file_name;
                            var xhr = new XMLHttpRequest();
                            xhr.responseType = 'blob';
                            xhr.onload = function() {
                                if (xhr.status === 200) {
                                    var urlObj = URL.createObjectURL(xhr.response);
                                    var link = document.createElement('a');
                                    link.href = urlObj;
                                    link.download = 'employee-ques-ans-app.pdf';
                                    document.body.appendChild(link);
                                    link.click();
                                    document.body.removeChild(link);
                                    URL.revokeObjectURL(urlObj);

                                    var jms_pdf_remove = data.jms_pdf_name;
                                    console.log(jms_pdf_remove);

                                    var jms_data_remove = new FormData();
                                    jms_data_remove.append('jms_pdf_remove', jms_pdf_remove);

                                    if (jms_pdf_remove != "") {
                                        $.ajax({
                                            url: "delete_pdf.php",
                                            type: "POST",
                                            data: jms_data_remove,
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            beforeSend: function() {},
                                            success: function(data) {
                                                if (data.status == 'error') {} else if (data.status == 'success') {

                                                }
                                            }
                                        });
                                    }
                                }
                            };
                            xhr.open('GET', url);
                            xhr.send();
                        }
                    },
                    error: function(e) {}
                });
            });

            $(document).ready(function() {
                $('#jms_generate_excel').click(function() {
                    var page = "generate_excel.php?id=<?php echo $data['answer_id'] . '&uid=' . $data['user_id']; ?>";
                    window.location = page;
                });
            });
        });
    </script>
</body>

</html>