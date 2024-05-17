<?php
include("connection.php");

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>

    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <title>View Answers</title>
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
                                <h3 class="card-title">View Answers</h3>
                            </div>
                            <?php
                            $user_id = $_SESSION['jms_emp_id'];
                            $sql_select = "SELECT emp_data.id as uid ,emp_data.first_name,emp_data.last_name,emp_data.email_id, question_set.id as question_set_id,question_set.emp_question_set_name,question_set.emp_question_description,answer_set.id,answer_set.question_id,answer_set.users_id,answer_set.answer,file_data,answer_set.emp_location as emp_location FROM  tbl_employee_master emp_data
                                    RIGHT JOIN tbl_individual_emp_answer_set_master answer_set on answer_set.users_id = emp_data.id 
                                    RIGHT JOIN tbl_individual_emp_question_set_master question_set on question_set.id = answer_set.question_id
                                    WHERE answer_set.users_id = $user_id ORDER BY answer_set.id DESC";
                            $result_select = mysqli_query($conn, $sql_select);
                            ?>
                            <div class="card-body">
                                <table id="jms_questions_detail" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Question Set</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1; 
                                        while ($data = mysqli_fetch_array($result_select)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $data["emp_question_set_name"]; ?></td>
                                                <td><?php echo $data["emp_location"]; ?></td>
                                                <td>
                                                    <a href="view_individual_answers.php?id=<?php echo $data["question_set_id"] . '&uid=' . $data['uid'] . '&primary_id=' . $data['id']; ?>">
                                                        <button class="btn btn-primary">View Answer</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("footer.php"); ?>
    <!-- DataTables  & Plugins -->
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

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#jms_questions_detail").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [],
                "pageLength": 20,
                "order": [
                    [0, 'desc']
                ]
            }).buttons().container().appendTo('#jms_questions_detail_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>