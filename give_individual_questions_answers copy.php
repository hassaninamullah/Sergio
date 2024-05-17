<?php
include("connection.php");

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}

if (isset($_GET['id'])) {
    $jms_id = $_GET['id'];
    $sql = "SELECT * FROM tbl_individual_emp_question_set_master where id = $jms_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 0) {
        header("location:view_individual_questions_answers_list.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>

    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style type="text/css">
        .card-title {
            margin-bottom: 0px !important;
        }

        input.emoji_input[type="radio"] {
            display: none;
        }

        /* Style labels */
        label.emoji {
            cursor: pointer;
            display: inline-block;
            font-size: 20px;
            padding: 0.2em;
        }

        /* Style selected label */
        input.emoji_input[type="radio"]:checked+label {
            background-color: lightblue;
            /* Adjust color as needed */
        }
    </style>

    <title>Give Answer</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php include("menu.php"); ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card card-primary mt-5">
                            <div class="card-header">
                                <h3 class="card-title">Give Answer</h3>
                            </div>
                            <?php
                            $jms_id = $_GET['id'];
                            $jms_emp_id = $_SESSION['jms_emp_id'];
                            $sql_que = "SELECT id ,first_name,last_name as last_name FROM tbl_employee_master WHERE id = $jms_emp_id";
                            $que_result_select = mysqli_query($conn, $sql_que);
                            $que_data = mysqli_fetch_array($que_result_select);

                            $sql_select = "SELECT id,emp_id,emp_question_set_name,emp_question_description,emp_logo_file FROM  tbl_individual_emp_question_set_master WHERE id = $jms_id";
                            $result_select = mysqli_query($conn, $sql_select);
                            $data = mysqli_fetch_array($result_select);
                            $description = json_decode($data['emp_question_description']);
                            /*print_r($description);*/

                            ?>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" name="jms_display_answer_form" id="jms_display_answer_form" enctype="multipart/form-data">
                                <div class="card-body">
                                    <input type="hidden" value="<?php echo $data['id']; ?>" id="jms_question_id" name="jms_question_id">
                                    <div class="row">
                                        <div class="col-md-4 col-12 form-group">
                                            <label for="jms_emp_location">Location</label>
                                            <input type="text" class="form-control" id="jms_emp_location" name="jms_emp_location" placeholder="Enter Loaction">
                                        </div>
                                        <div class="col-md-4 col-12 form-group">
                                            <label for="jms_employee_name">Employee</label>
                                            <input type="text" class="form-control" id="jms_employee_name" name="jms_employee_name" value="<?php echo $que_data['first_name'] . " " . $que_data['last_name']; ?>" disabled>
                                        </div>
                                        <div class="col-md-4 col-12 form-group">
                                            <label for="jms_manager">Manager</label>
                                            <input type="text" class="form-control" id="jms_manager" name="jms_manager" placeholder="Enter Manager Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="jms_question_set_name">Question Set Name</label>
                                        <input type="text" class="form-control" id="jms_question_set_name" name="jms_question_set_name" placeholder="Enter Question Set Name" value="<?php echo $data['emp_question_set_name']; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        for ($i = 0; $i < count($description); $i++) {
                                        ?>
                                            <div class="row">
                                                <div class="col-md-12 mt-1">
                                                    <label for="jms_question">Question - <?php echo $i + 1; ?></label>
                                                    <input type="text" class="form-control" name="dynamicField[]" placeholder="Description" value="<?php echo $description[$i]; ?>" disabled>
                                                </div>
                                                <div class="col-md-12 my-2">
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label" for="jms_yes_<?php echo $i + 1 ?>">
                                                            <input type="radio" class="form-check-input" id="jms_yes_<?php echo $i + 1 ?>" name="jms_radio_yes_no_<?php echo $i + 1 ?>" value="Yes" required>Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label" for="jms_no_<?php echo $i + 1 ?>">
                                                            <input type="radio" class="form-check-input" id="jms_no_<?php echo $i + 1 ?>" name="jms_radio_yes_no_<?php echo $i + 1 ?>" value="No">No
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-12 my-2">
                                                    <div class="form-check-inline">
                                                        <div class="emoji-container">
                                                            <input type="radio" class="emoji_input" id="emoji_happy_<?php echo $i + 1 ?>" name="emoji_<?php echo $i + 1 ?>" value="😊">
                                                            <label class="emoji" for="emoji_happy_<?php echo $i + 1 ?>">😊</label>

                                                            <input type="radio" class="emoji_input" id="emoji_sad_<?php echo $i + 1 ?>" name="emoji_<?php echo $i + 1 ?>" value="😢">
                                                            <label class="emoji" for="emoji_sad_<?php echo $i + 1 ?>">😢</label>

                                                            <input type="radio" class="emoji_input" id="emoji_angry_<?php echo $i + 1 ?>" name="emoji_<?php echo $i + 1 ?>" value="😡">
                                                            <label class="emoji" for="emoji_angry_<?php echo $i + 1 ?>">😡</label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-12 mb-3">
                                                    <input type="text" class="form-control" name="jms_answer_in_detail_<?php echo $i + 1 ?>" id="jms_answer_in_detail_<?php echo $i + 1 ?>">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="jms_custom_file[]" class="custom-file-input" id="jms_custom_file" multiple>
                                                            <label class="custom-file-label" for="jms_custom_file">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="message"></div>
                                    <input type="hidden" value="<?php echo count($description); ?>" id="jms_count_description" name="jms_count_description">
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-primary text-center" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include("footer.php"); ?>
    <!-- DataTables  & Plugins -->
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
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });


            $("#jms_display_answer_form").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "save_individual_questions_answers.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {},
                    success: function(data) {
                        console.log(data);

                        if (data.status == 'error') {
                            $('.message').css('display', 'block');
                            $('.message').html("<div class='alert alert-danger text-center' role='alert'>" + data.message + "</div>");
                        } else if (data.status == 'success') {
                            $('.message').css('display', 'block');
                            $('.message').html("<div class='alert alert-success text-center' role='alert'>" + data.message + "</div>");
                            setTimeout(function() {
                                window.location = 'view_individual_questions_answers_list.php';
                            }, 3000);
                        }
                    },
                    error: function(e) {

                    }
                });
            });
        });
    </script>
</body>

</html>