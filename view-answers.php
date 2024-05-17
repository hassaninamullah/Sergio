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
                            <p class="department poppins">performance</p>
                            <div class="jms-box" id='jms_chartbox'>
                                <canvas id='myChart'></canvas>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                   
                                    <canvas id="myChart"></canvas>
                                    <!-- <p class="department poppins">Cleanliness</p> -->
                                    <div id="secondChartContainer"></div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <canvas id="myChart"></canvas>
                                    <!-- <p class="department poppins">customer service</p> -->
                                    <div id="thirdChartContainer"></div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="ptb-10">
                            <div class="jms-box" id='jms_chartbox'>
                                <canvas id='myChart'></canvas>
                            </div>
                            <canvas id="myChart"></canvas>

                            <div id="secondChartContainer"></div>
                        </div> -->
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

                                        <!-- <tr>
                                            <th colspan="4"></th>
                                        </tr> -->
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>YES / NO</th>
                                        </tr>
                                        <tr>

                                            <td>
                                                Jhon Doe
                                            </td>
                                            <td>
                                                Neque 123 porro quisquam est qu 56890 CA
                                            </td>
                                            <td class="green">
                                                Yes
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                          
                                            <td>
                                                Jhon Doe
                                            </td>
                                            <td>
                                                Neque 123 porro quisquam est qu 56890 CA 
                                            </td>
                                            <td class="green">
                                                Yes
                                            </td>
                                    </tr> -->


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
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!-- Page specific script -->
    <script>
        var jms_chart_x_value_arr = ["Visit 1", "Visit 2", "Visit 3", "Visit 4"];
        var jms_line_chart_obj_1 = {
            data: [90, 50, 60, 60],
            backgroundColor: ["#F0F0F0", "#F0F0F0", "#F0F0F0", "#F0F0F0"],
            borderColor: "black",
        };

        const config = {
            type: 'bar',
            data: {
                labels: jms_chart_x_value_arr,
                datasets: [jms_line_chart_obj_1]
            },
            options: {
                onClick: function (event, elements) {
                    if (elements.length > 0) {
                        var index = elements[0]._index;
                        var label = jms_chart_x_value_arr[index];
                        var value = jms_line_chart_obj_1.data[index];
                        console.log('Clicked on ' + label + ': ' + value);
                        displayAnotherChart(label, value);
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        };

        // Initialize the first chart
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        // Function to display another chart based on the clicked data
        function displayAnotherChart(label, value) {
    if (label === "Visit 1") {
        // Create a new canvas element for the second chart
        var canvas = document.createElement('canvas');
        canvas.width = 400;
        canvas.height = 400;
        var ctx = canvas.getContext('2d');
        document.getElementById('secondChartContainer').innerHTML = '';
        document.getElementById('secondChartContainer').appendChild(canvas);

        // Create the second chart (bar chart)
        var anotherChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['YES', 'NO'],
                datasets: [{
                    label: 'Data',
                    data: [value, value * 2],
                    backgroundColor: ['red', 'green'], // Set colors for bars
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Cleanliness', // Set the title text
                    weight: 'bold',
                    fontColor: 'black',
                    size: '60'
                }
            }
        });
    } else if (label === "Visit 2") {
        // Create a new canvas element for the third chart
        var canvas = document.createElement('canvas');
        canvas.width = 400;
        canvas.height = 400;
        var ctx = canvas.getContext('2d');
        document.getElementById('thirdChartContainer').innerHTML = '';
        document.getElementById('thirdChartContainer').appendChild(canvas);

        // Create the third chart (bar chart)
        var anotherChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['YES', 'NO'],
                datasets: [{
                    label: 'Data',
                    data: [value, value * 2],
                    backgroundColor: ['red', 'green'], // Set colors for bars
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Customer Service', // Set the title text
                    weight: 'bold',
                    fontColor: 'black',
                    size: '60'
                    
                }
            }
        });
    }
};

    </script>
</body>

</html>