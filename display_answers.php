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

        <title>View Answer</title>
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
                                <h3 class="card-title">View Answer</h3>
                            </div>
                                <?php                                
                                    $sql_select = "SELECT answer_id,question_set_name,question_description,answer FROM tbl_answer_set_master answer LEFT JOIN tbl_question_set_master question on question.id = answer.id";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    /*$data = mysqli_fetch_array($result_select);
                                    $description = explode(',', $data['question_description']);
                                    $answer = explode(',', $data['answer']);*/
                                   /* print_r($description);
                                    print_r($answer);*/
                                ?>           
                                <div class="card-body">
                                    <table id="jms_view_answer" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Question Set</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($data=mysqli_fetch_array($result_select))
                                            {
                                        ?>
                                        <tr>
                                            <td><?php echo $data["answer_id"]; ?></td>
                                            <td><?php echo $data["question_set_name"]; ?></td>
                                            <td><?php echo $data["question_description"]; ?></td>
                                            <td><?php echo $data["answer"]; ?></td>
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
            $("#jms_view_answer").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": [] //["excel", "pdf"] 
            }).buttons().container().appendTo('.col-md-6:eq(0)');
        });
    </script>
    </body>

</html>