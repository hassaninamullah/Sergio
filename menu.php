<?php
if (!isset($_SESSION['jms_emp_id'])) {
    header("location:index.php");
}
?>
<style type="text/css">
    .fname-lname {
        padding: 8px 8px;
        background-color: #cfcfcf;
        color: #000000;
        border-radius: 50%;
        font-size: 0.8rem;
        margin-right: 6px;
    }

    .user-panel .info {
        padding: 5px 5px 5px 5px !important;
    }

    .user-panel .image {
        padding-top: 4px !important;
    }

    .brand-link .brand-image {
        margin-left: 0.5rem !important;
    }
</style>
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link">
        </a>
        <?php
        $jms_emp_id = $_SESSION['jms_emp_id'];
        $sql_select = "SELECT * FROM tbl_employee_master WHERE id='$jms_emp_id'";
        $result_select = mysqli_query($conn, $sql_select);
        $users_data = mysqli_fetch_array($result_select);
        ?>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                    <a style="cursor:pointer;">
                        <span class="fname-lname img-circle elevation-2"><?php echo strtoupper(substr($users_data["first_name"], 0, 1)); ?> <?php echo strtoupper(substr($users_data["last_name"], 0, 1)); ?></span>
                    </a>
                </div>
                <div class="info">
                    <a style="cursor:pointer;" class="d-block">
                        <?php echo ucfirst($users_data["first_name"]); ?> <?php echo ucfirst($users_data["last_name"]); ?>
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Questions-Answers
                            </p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="view_answer_list.php" class="nav-link">
                                    <i class="far fa-sign-in nav-icon"></i>
                                    <p>Give Answers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="view_emp_answers.php" class="nav-link">
                                    <i class="far fa-sign-in nav-icon"></i>
                                    <p>View Answers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="view_answer_list.php" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Questions-Answers
                            </p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                            Individual Que.-Ans.
                            </p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="view_individual_questions_answers_list.php" class="nav-link">
                                    <i class="far fa-sign-in nav-icon"></i>
                                    <p>Give Answers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="view_individual_answers_list.php" class="nav-link">
                                    <i class="far fa-sign-in nav-icon"></i>
                                    <p>View Answers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                  
                    <li class="nav-item">
                        <a href="change_password.php" class="nav-link">
                            <i class="nav-icon fas fa-key"></i>
                            <p>
                                Change Password
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i><i class=""></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</div>