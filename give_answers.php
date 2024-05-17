<?php
include("connection.php");

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}

if (isset($_GET['id'])) {
    $jms_id = $_GET['id'];
    $sql = "SELECT * FROM tbl_question_set_master where id = $jms_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
        header("location:view_answer_list.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>

    <!-- DataTables -->

    <title>Give Answers</title>
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

    .qualify input {
        margin-bottom: 10px;
    }

    .fs-30 {
        font-size: 30px;
        font-weight: bold;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php include("menu.php"); ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">

                    <div class="col-md-12">
                        <div class="card card-primary mt-5">
                            <div class="card-header">
                                <h3 class="card-title">Food Safety</h3>
                            </div>
                            <div class="row justify-content-md-center">
                                <div class="col-md-12">
                                    <div class="card card-primary mt-5">
                                        <?php
                                        $jms_id = $_GET['id'];
                                        $jms_emp_id = $_SESSION['jms_emp_id'];
                                        $sql_que = "SELECT id ,first_name,last_name as last_name FROM tbl_employee_master WHERE id = $jms_emp_id";
                                        $que_result_select = mysqli_query($conn, $sql_que);
                                        $que_data = mysqli_fetch_array($que_result_select);

                                        $sql_select = "SELECT id,question_set_name,question_description,logo_file,company_name,visit_no FROM  tbl_question_set_master WHERE id = $jms_id";
                                        $result_select = mysqli_query($conn, $sql_select);
                                        $data = mysqli_fetch_array($result_select);
                                        $description = json_decode($data['question_description'], true);
                                        /*print_r($description);*/
                                        ?>
                                        <!-- form start -->
                                        <form method="POST" name="jms_display_answer_form" id="jms_display_answer_form" enctype="multipart/form-data">
                                            <div class="card-body">
                                                <input type="hidden" name="visits" id="visits" value="<?php echo $data['visit_no'] ?>">
                                                <div class="row align-items-center ptb-15">
                                                    <div class="col-md-1 ">
                                                        <img class="w-100" src="img/<?php echo $data['logo_file'] ?>" alt="">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <p class="jms_companyName_set_name companyName">
                                                            <p class="fs-20"> <?php echo $data['company_name'] ?></p>
                                                            </p>
                                                        </div>
                                                        <input type="hidden" name="company_name" value="<?php echo $data['company_name'] ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo $data['id']; ?>" id="jms_question_id" name="jms_question_id">
                                                <div class="row">
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label for="jms_emp_location">Location</label>
                                                        <input type="text" class="form-control" id="jms_emp_location" name="jms_emp_location" placeholder="Enter Location" required>
                                                    </div>
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label for="jms_employee_name">Employee</label>
                                                        <input type="text" class="form-control" id="jms_employee_name" name="jms_employee_name" value="<?php echo $que_data['first_name'] . " " . $que_data['last_name']; ?>" disabled>
                                                    </div>
                                                    <div class="col-md-4 col-12 form-group">
                                                        <label for="jms_manager">Manager</label>
                                                        <input type="text" class="form-control" id="jms_manager" name="jms_manager" placeholder="Enter Manager Name" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="jms_question_set_name">Question Set Name</label>
                                                    <input type="text" class="form-control" id="jms_question_set_name" name="jms_question_set_name" placeholder="Enter Question Set Name" value="<?php echo $data['question_set_name']; ?>" disabled>
                                                </div>

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
                                                                            <div class="col-md-4 pb-2">
                                                                                <div class="qualify">
                                                                                    <h4>Qualifying Question</h4>
                                                                                    <input class="form-control field_value qualifyingQuestion" name="qualifyingQuestion" type="text" placeholder="Text" disabled value="<?php echo $questionSet['qualifyingQuestion'] ?>">
                                                                                </div>
                                                                                <div class="col-md-12 my-2">
                                                                                    <div class="form-check-inline">
                                                                                        <label class="form-check-label" for="jms_yes_<?php echo $counting + 1 ?>">
                                                                                            <input type="radio" class="form-check-input qualifyAnswer" id="jms_yes_<?php echo $counting + 1 ?>" name="jms_radio_yes_no_<?php echo $counting + 1 ?>" value="Yes" required>Yes
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="form-check-inline">
                                                                                        <label class="form-check-label" for="jms_no_<?php echo $counting + 1 ?>">
                                                                                            <input type="radio" class="form-check-input qualifyAnswer" id="jms_no_<?php echo $counting + 1 ?>" name="jms_radio_yes_no_<?php echo $counting + 1 ?>" value="No">No
                                                                                        </label>
                                                                                    </div>
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
                                                                                    if ($question['responseType'] === 'mcqs' && isset($question['options'])) {
                                                                                        $optionsCount = 1;
                                                                                        foreach ($question['options'] as $option) {
                                                                                    ?>
                                                                                            <div class="form-check ml-20">
                                                                                                <input class="form-check-input field_value responseType mcqs" data-value="mcqs" type="radio" name="responseTypeFields_<?php echo $counting ?>" id="responseTypeFields_<?php echo $count ?>_<?php echo $optionsCount ?>" value="<?php echo $option ?>" required> <!-- Added required attribute here -->
                                                                                                <label class="form-check-label" for="responseTypeFields_<?php echo $count ?>_<?php echo $optionsCount ?>">
                                                                                                    <?php echo $optionsCount ?>. <?php echo $option ?>
                                                                                                </label>
                                                                                            </div>
                                                                                    <?php
                                                                                            $optionsCount++;
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'checkBox' && isset($question['options'])) {
                                                                                        $optionsCount = 1;
                                                                                        foreach ($question['options'] as $option) {
                                                                                    ?>
                                                                                            <div class="form-check ml-20">
                                                                                                <input class="form-check-input field_value responseType" data-value="checkBox" type="checkbox" name="responseTypeFields" id="responseTypeFields_<?php echo $optionsCount ?>" value="<?php echo $option ?>">
                                                                                                <label class="form-check-label" for="responseTypeFields">
                                                                                                    <?php echo $optionsCount ?>. <?php echo $option ?>
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
                                                                                        <div class="col-md-12 my-3">
                                                                                            <input type="text" class="form-control responseType" data-value="textInput" name="textInputField" id="textInputField" placeholder="Text">
                                                                                        </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <?php
                                                                                    if ($question['responseType'] === 'uploadFile') {
                                                                                    ?>
                                                                                        <div class="col-md-12 my-3">
                                                                                            <div class="input-group mb-3">
                                                                                                <div class="input-group-prepend">
                                                                                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                                                                </div>
                                                                                                <div class="custom-file">
                                                                                                    <input type="file" name="file[]" class="custom-file-input responseType" data-value="uploadFile" id="file" multiple required>
                                                                                                    <label class="custom-file-label" for="file">Choose file</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php
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
                                                <input type="hidden" name="start_time" id="start_time">
                                                <input type="hidden" name="answerData" id="jsonDataInput">
                                                <input type="hidden" name="fileNames" id="fileNames">
                                                <input type="hidden" name="qualifyAnswers" id="qualifyAnswers">
                                                <input type="hidden" value="<?php echo count($description); ?>" id="jms_count_description" name="jms_count_description">
                                                <!-- <button type="button" id="checkDataButton">Update</button> -->

                                                <div class="card-footer">
                                                    <input type="submit" class="btn btn-primary text-center" value="Submit">
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
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            storeEndTime();
            function storeEndTime() {
                var now = new Date().toISOString();
                // var year = now.getFullYear();
                // var month = ('0' + (now.getMonth() + 1)).slice(-2);
                // var day = ('0' + now.getDate()).slice(-2);
                // var hours = ('0' + now.getHours()).slice(-2);
                // var minutes = ('0' + now.getMinutes()).slice(-2);
                // var seconds = ('0' + now.getSeconds()).slice(-2);

                // var endTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

                document.getElementById('start_time').value = now;
            }

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            function getQualifyingAnswer() {
                var data = [];

                $('.dynamicData').each(function() {
                    var sectionData = {};
                    sectionData.title = $(this).find('.titleField').text();
                    sectionData.qualifyingQuestion = $(this).find('.qualifyingQuestion').val();
                    sectionData.answer = $(this).find('.qualifyAnswer:checked').val();

                    data.push(sectionData);
                });

                var jsonData = JSON.stringify(data);

                return jsonData;

            }

            function getDataToStore() {
                var data = [];
                var fileNames = [];

                $('.dynamicData').each(function() {
                    var sectionData = {};
                    sectionData.title = $(this).find('.titleField').text();
                    sectionData.qualifyingQuestion = $(this).find('.qualifyingQuestion').val();
                    sectionData.qualifyingAnswer = $(this).find('.qualifyAnswer:checked').val();
                    sectionData.questions = [];

                    $(this).find('.dynamicField').each(function() {
                        var questionData = {};
                        questionData.question = $(this).find('.questionField').val();
                        questionData.responseType = $(this).find('.responseType').data('value');

                        switch (questionData.responseType) {
                            case 'mcqs':
                                questionData.answer = $(this).find('input[type="radio"].field_value:checked').val();
                                break;
                            case 'checkBox':
                                questionData.answers = [];
                                $(this).find('input[type="checkbox"].field_value:checked').each(function() {
                                    questionData.answers.push($(this).val());
                                });
                                break;
                            case 'textInput':
                                questionData.answer = $(this).find('input[name="textInputField"]').val();
                                break;
                            case 'uploadFile':
                                var files = $(this).find('input[name="file[]"]')[0].files;
                                if (files.length > 0) {
                                    var fileName = generateUniqueFileName(files[0].name);
                                    questionData.fileName = fileName;
                                    fileNames.push(fileName);
                                }
                                break;
                            default:
                                break;
                        }

                        sectionData.questions.push(questionData);
                    });

                    data.push(sectionData);
                });
                $('#fileNames').val(JSON.stringify(fileNames));


                return JSON.stringify(data);
            }

            // Function to generate unique file name
            function generateUniqueFileName(originalName) {
                var extension = originalName.split('.').pop();
                var uniqueId = Date.now() + '_' + Math.floor(Math.random() * 1000);
                return uniqueId + '.' + extension;
            }

            $("#jms_display_answer_form").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "save_answer.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == 'error') {
                            $('.message').css('display', 'block');
                            $('.message').html("<div class='alert alert-danger text-center' role='alert'>" + data.message + "</div>");
                        } else if (data.status == 'success') {
                            $('.message').css('display', 'block');
                            $('.message').html("<div class='alert alert-success text-center' role='alert'>" + data.message + "</div>");
                            setTimeout(function() {
                                window.location = 'view_answer_list.php';
                            }, 3000);
                        }
                    },
                    error: function(e) {

                    }
                });
            });

            $('#checkDataButton').click(function() {
                console.log(getQualifyingAnswer());
            });

            function updateQualifyAnswers() {
                $('#qualifyAnswers').val(getQualifyingAnswer());
            }

            function updateJsonDataInput() {
                $('#jsonDataInput').val(getDataToStore());
                updateQualifyAnswers();
            }

            $(document).on('input', '.dynamicData input, .dynamicData select', updateJsonDataInput);


            function SwalLoader() {
                Swal.fire({
                    title: "Please wait...",
                    html: "",
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
            }

        });
    </script>
</body>

</html>