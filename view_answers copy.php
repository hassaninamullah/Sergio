<?php
  include("connection.php");

  if(!isset($_SESSION['jms_emp_id']))
  {
    header("location:index.php");
  }
  $jms_users_id = $_SESSION['jms_emp_id'];   
  if(isset($_GET['id']))
  {
    $jms_id = $_GET['id']; 
    $sql = "SELECT * FROM tbl_answer_set_master where question_id = $jms_id and users_id = $jms_users_id";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) == 0)
    {
        header("location:view_answer_list.php");
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

        <title>View Answer</title>
        <style type="text/css">
        .jms-box 
        {
          width: 300px ;
          height: 150px;  
          padding: 10px;
          border: 1px solid lightgray;
          box-sizing: border-box;
          font-weight:normal;
          font-size: 20px;
        }

        .jms-chartBox {
            width: 495px !important;
            height: 250px !important; 
            border: 1px solid lightgray;
            box-sizing: none;
            font-weight:normal;
        }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">

      <?php include("menu.php"); ?>

        <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-primary mt-5">
                            <div class="card-header">
                                <h3 class="card-title">View Answer</h3>
                            </div>
                                <?php 
                                    $jms_id = $_GET['id']; 
                                    $jms_emp_id = $_SESSION['jms_emp_id'];    
                                                             
                                    $sql_select = "SELECT emp_date.id ,emp_date.first_name as first_name,emp_date.last_name as last_name,email_id,question_set_name,logo_file,question_description,answer,answer_in_detail,file_data,emp_location,manager FROM tbl_answer_set_master answer LEFT JOIN tbl_question_set_master question on question.id = answer.question_id RIGHT JOIN tbl_employee_master emp_date on answer.users_id = emp_date.id WHERE answer.question_id = $jms_id and users_id = $jms_emp_id";

                                    $result_select = mysqli_query($conn, $sql_select);
                                    $data = mysqli_fetch_array($result_select);
                                    $description = json_decode($data['question_description']);
                                    $answer = explode(',', $data['answer']);
                                    $jms_answer_in_detail = json_decode($data['answer_in_detail']);
                                    $file_data = json_decode($data['file_data']);
                                ?>           
                                <div class="card-body">
                                    <table id="jms_questions_detail" class="table table-bordered table-striped mb-3">
                                        <tbody>
                                            <tr>
                                                <th colspan="3">
                                                    <div class="d-flex justify-content-center mb-2">
                                                            <img src='img/<?php echo $data['logo_file'];?>' height='100' width='200'>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="jms-box mb-2">
                                                        <span>Location : <?php echo $data['emp_location'];?></span><br>
                                                        <span>Employee : <?php echo $data['first_name']." ".$data['last_name'];?></span> <br>
                                                        <span>Manager : <?php echo $data['manager'];?></span><br>
                                                        <span>E-mail ID : <?php echo $data['email_id'];?></span>
                                                    </div>
                                                </th>
                                                <th colspan="2">
                                                    <div class='jms-chartBox' id='jms_chartbox'>
                                                         <canvas id='myChart'></canvas>
                                                    </div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="1">
                                                    Question Set Name
                                                </th>
                                                <td colspan="3"><?php echo $data['question_set_name'];?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3"></th>
                                            </tr>
                                            <tr>
                                                <th>Question</th>
                                                <th>Answer</th>
                                                <th>Image/Video</th>
                                            </tr>
                                            <tr>
                                            <?php 
                                             for ($i = 0; $i < count($description); $i++) 
                                             { 
                                            ?>
                                                <td>
                                                    <?php echo $i+1;?> : <?php echo $description[$i];?>
                                                    <input type="hidden" id="jms_answer_<?php echo $i+1;?>" value="<?php echo $answer[$i];?>">
                                                </td>
                                                <td>
                                                    <?php  
                                                        if($answer[$i] ==='Yes')
                                                        {
                                                            echo $answer[$i] ='Yes'."<br>".$jms_answer_in_detail[$i];
                                                        }
                                                        elseif($answer[$i] ==='No')
                                                        {
                                                            echo $answer[$i] ='No'."<br>".$jms_answer_in_detail[$i];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php 
                                                if((substr($file_data[$i],0,5)) === 'image')
                                                {
                                                ?>
                                                    <img src='img/<?php echo $file_data[$i]; ?>' height='100' width='150'>
                                                <?php
                                                }
                                                elseif((substr($file_data[$i],0,5)) === 'video')
                                                { 
                                                ?>
                                                    <video width="150" height="100" controls>
                                                        <source src='img/<?php echo $file_data[$i]; ?>'>
                                                    </video> 
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
                                    <div>
                                        <div class="message"></div>
                                        <button type="back" class="btn btn-default bg-primary" id="jms_btn_back">Back</button>
                                        <input type="hidden" value="<?php echo count($description);?>" id="jms_count" name="jms_count">
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#jms_view_answer").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": [] //["excel", "pdf"] 
            }).buttons().container().appendTo('.col-md-6:eq(0)');

            $("#jms_btn_back").on('click',function() 
            {
                setTimeout(function(){ window.location = 'view_answer_list.php'; },100);
            });

            var data_yes = 0;
            var data_no = 0;

            var jms_count = document.getElementById('jms_count').value;
            var jms_answer = "";

            for (var i = 0; i < jms_count; i++) 
            { 
                jms_answer = document.getElementById('jms_answer_'+(i+1)).value;
                /*console.log(jms_answer);*/
                if(jms_answer == 'Yes')
                {
                    data_yes = data_yes + 1; 
                }
                else if(jms_answer  == 'No')
                {
                    data_no = data_no + 1;
                }
            }

            var result_yes = parseFloat((data_yes/jms_count) * 100);
            var result_no = parseFloat((data_no/jms_count) * 100);

            var jms_chart_canvas1 = document.getElementById("myChart").getContext("2d");
            const myChart = new Chart(jms_chart_canvas1, 
            {
                type: 'bar',
                data: 
                {
                    labels: ['bar 1','bar 2'],
                    datasets: 
                    [{
                        label:'Score',
                        data: []
                    }],
                },
                options: 
                {
                    // indexAxis: 'x',
                    responsive: true,
                    plugins:
                    {
                       legend: false,
                       title: {
                              display: true,
                              text: 'Score : '+ parseFloat(result_yes).toFixed(0) + '%' ,
                              color: 'blue',
                              align: 'left',
                              position: 'top',
                              font: {
                                 weight: 'bold',
                                 size : 20,
                              },
                           },
                        datalabels:
                        {
                            anchor:'end',
                            color: 'black',
                            align:'top',
                            formatter: function (value) 
                            {
                                return ((parseFloat(value)).toFixed(0)) + '%';
                            },
                            font:
                            {
                                weight: 'bold',
                                size: 16,
                            }
                        }
                    },
                    scales: 
                    {
                        x: 
                        {
                            grid: 
                            {
                              display: false,drawBorder: true,
                            },
                            ticks: 
                            {
                               display: false
                            },
                            border: 
                            {
                              display: false
                            }
                        },
                        y: 
                        {
                            grid: 
                            {
                              display: false,drawBorder: true,
                            },
                            border: 
                            {
                              display: false
                            },
                            ticks: 
                            {
                                display: false,
                            },
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }
                }
                ,plugins:[ChartDataLabels]
            });

            var jms_chart_x_value_arr = [];
            var jms_bar_chart_arr = [];
            
            jms_bar_chart_arr.push((result_yes).toFixed(0));
            jms_bar_chart_arr.push((result_no).toFixed(0));

            var jms_bar_chart_obj = 
            {
                label: '' ,data: jms_bar_chart_arr
            }

            myChart.data.datasets[0] = jms_bar_chart_obj;
            myChart.data.datasets[0].backgroundColor = ['blue','blue'];
            myChart.update();

        });
    </script>
    </body>

</html>