<?php
include("connection.php");

if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}
$jms_users_id = $_SESSION['jms_emp_id'];
if (isset($_GET['id'])) {
    $jms_id = $_GET['id'];
    $sql = "SELECT * FROM tbl_individual_emp_answer_set_master where question_id = $jms_id and users_id = $jms_users_id";
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
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <title>View Answer</title>
    <style type="text/css">
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

        .jms-chartBox {
            width: 495px !important;
            height: 250px !important;
            border: 1px solid lightgray;
            box-sizing: none;
            font-weight: normal;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php include("menu.php"); ?>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 ">
                        <img class="w-100" src="img/admin/logo.png" alt="">
                    </div>
                    <div class="col-md-3 offset-md-2">
                        <p class="kfc-inspection poppins">KFC INSPECTION</p>
                    </div>
                    <div class="col-md-2 offset-md-3">
                        <img class="w-100" src="img/admin/kfc.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="jms-box mb-2">
                            <span>Location : </span><br>
                            <span>Employee : Test User</span> <br>
                            <span>Manager : </span><br>
                            <span>E-mail ID : advertisingremote@gmail.com</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="jms-box mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <p>This Evaluation</p>
                                    <p class="pass poppins">PASS</p>
                                </div>
                                <div class="col-md-7 offset-md-2">
                                    <p class="risk-levels">Risk Levels</p>
                                    <p class="">
                                        <span class="oppoortunity1 ">Opportunity : </span> 5 Scored (3 repeats)
                                    </p>
                                    <span class="oppoortunity1 ">Zero Tolerance: </span> 0 Scored (0 repeats)</p>
                                    <span class="oppoortunity1 ">Critical : </span> 1 Scored (0 repeats)</p>
                                    <span class="oppoortunity1 ">Important : </span> 1 Scored (1 repeats)</p>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="jms-box mb-2">
                            <div class="ptb-10">
                                <span>This Evaluation Info </span><br>
                            </div>

                            <div class="box">
                                <ul class="ml-10">
                                    <li class="mr-28">
                                        <p class="service">Service</p>
                                    </li>
                                    <li class="mr-28">
                                        <p class="service"> Service </p>
                                    </li>
                                </ul>
                            </div>

                            <div class="ptb-10">
                                <div class="box">
                                    <ul class="ml-10">
                                        <li class="mr-28">
                                            <p class="service">Special</p>
                                        </li>
                                        <li class="mr-28">
                                            <p class="service"> Jim Riley </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ptb-10">
                                <div class="box">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="service">Start</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="service"> Jan 23 <br>
                                                4:15 pm EST </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="ptb-10">
                                <div class="box">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="service">End</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="service"> Jan 23 <br>
                                                6:05 pm EST </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="ptb-10">
                                <div class="box">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="service">Location</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="service"> 4167 17 Main Street
                                                Chipola CA 34854 </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="ptb-10">
                                <div class="border-bottom"></div>
                            </div>
                            <div class="ptb-10">
                                <div class="box">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="service">Manager</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="service"> 4167 </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="ptb-10">
                                <div class="box">

                                    <div class="row">
                                        <div class="col-md-5">
                                            <p class="service">Round</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="service"> 4167 </p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="ptb-10">
                            <div class="jms-box mb-2">
                                <span>Location : </span><br>
                                <span>Employee : Test User</span> <br>
                                <span>Manager : </span><br>
                                <span>E-mail ID : advertisingremote@gmail.com</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <p class="department poppins">Department Summary</p>
                        <div class="ptb-10">
                            <table class="">
                                <tr>
                                    <th class="oppoortunity1">Department</th>
                                    <th class="oppoortunity1">Rating</th>
                                    <th class="oppoortunity1">Score</th>
                                </tr>
                                <tr>
                                    <td>Food Safety</td>
                                    <td class="pass1">Pass</td>
                                    <td class="oppoortunity1">86.0%</td>
                                </tr>
                                <tr>
                                    <td>Brand Standards</td>
                                    <td class="pass1">Pass</td>
                                    <td class="oppoortunity1">92.0%</td>
                                </tr>

                                <tr class="tr-3">
                                    <td>Over Rating</td>
                                    <td class="pass1">Pass</td>
                                    <td class="oppoortunity1">92.0%</td>
                                </tr>

                            </table>
                        </div>
                        <div class="ptb-10">
                            <div class="jms-box" id='jms_chartbox'>
                                <canvas id='myChart'></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row ">
                    <div class="col-md-12">
                        <div class="card card-primary mt-5">
                            <!-- <div class="card-header">
                                <h3 class="card-title">View Answer</h3>
                            </div> -->
                            <?php
                            $jms_id = $_GET['id'];
                            $jms_emp_id = $_SESSION['jms_emp_id'];

                            $sql_select = "SELECT emp_date.id ,emp_date.first_name as first_name,emp_date.last_name as last_name,email_id,emp_question_set_name,emp_logo_file,emp_question_description,answer,answer_in_detail,file_data,emp_location,manager FROM tbl_individual_emp_answer_set_master answer LEFT JOIN tbl_individual_emp_question_set_master question on question.id = answer.question_id RIGHT JOIN tbl_employee_master emp_date on answer.users_id = emp_date.id WHERE answer.question_id = $jms_id and users_id = $jms_emp_id";

                            $result_select = mysqli_query($conn, $sql_select);
                            $data = mysqli_fetch_array($result_select);
                            $description = json_decode($data['emp_question_description']);
                            $answer = explode(',', $data['answer']);
                            $jms_answer_in_detail = json_decode($data['answer_in_detail']);
                            $file_data = json_decode($data['file_data']);
                            ?>
                            <div class="card-body">
                                <table id="jms_questions_detail" class="table table-bordered table-striped mb-3">
                                    <tbody>

                                        <tr>
                                            <th colspan="4"></th>
                                        </tr>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Image/Video</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($i = 0; $i < count($description); $i++) {
                                            ?>
                                                <td>
                                                    <?php echo $i + 1; ?> :
                                                    <?php echo $description[$i]; ?>
                                                    <input type="hidden" id="jms_answer_<?php echo $i + 1; ?>" value="<?php echo $answer[$i]; ?>">
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($answer[$i] === 'Yes') {
                                                        echo $answer[$i] = 'Yes' . "<br>" . $jms_answer_in_detail[$i];
                                                    } elseif ($answer[$i] === 'No') {
                                                        echo $answer[$i] = 'No' . "<br>" . $jms_answer_in_detail[$i];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ((substr($file_data[$i], 0, 5)) === 'image') {
                                                    ?>
                                                        <img src='img/<?php echo $file_data[$i]; ?>' height='100' width='150'>
                                                    <?php
                                                    } elseif ((substr($file_data[$i], 0, 5)) === 'video') {
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
                                <!-- <div>
                                    <div class="message"></div>
                                    <button type="back" class="btn btn-default bg-primary" id="jms_btn_back">Back</button>
                                    <input type="hidden" value="<?php echo count($description); ?>" id="jms_count" name="jms_count">
                                </div> -->
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
        $(function() {
            $("#jms_view_answer").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": []
            }).buttons().container().appendTo('.col-md-6:eq(0)');

            $("#jms_btn_back").on('click', function() {
                setTimeout(function() {
                    window.location = 'view_individual_questions_answers_list.php';
                }, 100);
            });

            // Set the percentages for each bar
            var percentage1 = 38;
            var percentage2 = 82;
            var percentage3 = 50;

            // Chart data
            var data = [percentage1, percentage2, percentage3];

            var jms_chart_canvas1 = document.getElementById("myChart").getContext("2d");
            const myChart = new Chart(jms_chart_canvas1, {
                type: 'bar',
                data: {
                    labels: ['Visit 1', 'Visit 2', 'Visit 3'],
                    datasets: [{
                        label: 'Score',
                        data: data,
                        barPercentage: 0.4, // Adjust the thickness of the bars
                        categoryPercentage: 0.6, // Adjust the spacing between bars
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: false,
                        title: {
                            display: true,
                            text: 'PERFORMANCE',
                            color: 'black',
                            align: 'right',
                            position: 'top',
                            font: {
                                weight: 'bold',
                                size: 20,
                            },
                        },
                        datalabels: {
                            anchor: 'end',
                            color: 'black',
                            align: 'top',
                            formatter: function(value) {
                                return (value * 100 / 100) + '%'; // Format value as percentage between 0 to 100
                            },
                            font: {
                                weight: 'bold',
                                size: 16,
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false,
                                drawBorder: true,
                            },
                            ticks: {
                                display: true
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false,
                                drawBorder: true,
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                display: true,
                            },
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    },
                    hover: {
                        mode: null // Disable hover effect
                    }
                },
                plugins: [ChartDataLabels]
            });

            // Change the background color of bars
            myChart.data.datasets[0].backgroundColor = ['#F0F0F0', '#F0F0F0', '#F0F0F0'];
            myChart.update();
        });
    </script>
</body>

</html>

