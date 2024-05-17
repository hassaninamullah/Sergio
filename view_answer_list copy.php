<?php
  include("connection.php");

  if(!isset($_SESSION['jms_emp_id']))
  {
    header("location:index.php");
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

        <title>Questions-Answers</title>
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
                                <h3 class="card-title">Questions-Answers</h3>
                            </div>
                                <?php 
                                    $jms_user_id = $_SESSION['jms_emp_id'];
                                    $sql_select = "SELECT * FROM tbl_question_set_master ORDER BY id DESC";
                                    $result_select = mysqli_query($conn, $sql_select);
                                ?>
                                <div class="card-body">
                                    <table id="jms_questions_detail" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Question Set</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while($data = mysqli_fetch_array($result_select))
                                            {
                                                $id = $data['id'];

                                                $sql = "SELECT question_set.id as question_set_id FROM tbl_question_set_master question_set 
                                                LEFT JOIN tbl_answer_set_master answer_set on question_set.id = answer_set.question_id 
                                                WHERE answer_set.question_id IS NOT NULL AND users_id = $jms_user_id AND answer_set.question_id = $id";

                                                $result = mysqli_query($conn, $sql);
                                                $data_result = mysqli_fetch_array($result);
                                        ?>
                                       <tr>
                                            <td><?php echo $data["id"]; ?></td>
                                            <td><?php echo $data["question_set_name"]; ?></td>
                                            <td>
                                                <?php
                                                if(isset($data_result['question_set_id']))
                                                {
                                                ?>
                                                    <a href="view_answers.php?id=<?php echo $id; ?>">
                                                        <button class="btn btn-primary">View Answer</button>
                                                    </a>
                                                   
                                                <?php
                                                }
                                                elseif(!isset($data_result['question_set_id']))
                                                {
                                                ?>
                                                    <a href="give_answers.php?id=<?php echo $data["id"]; ?>">
                                                        <button class="btn btn-success">Give Answer</button>
                                                    </a>
                                                    
                                                <?php 
                                                }
                                                 ?>
                                            </td>
                                        </tr>
                                        <?php
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

    <!-- Page specific script -->
    <script>
        $(function () {
            $("#jms_questions_detail").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons":[],
              "pageLength": 20,
              /*"bSort": true,*/
              "order": [[0, 'desc']]
            }).buttons().container().appendTo('#jms_questions_detail_wrapper .col-md-6:eq(0)');
        });
    </script>
    </body>

</html>
