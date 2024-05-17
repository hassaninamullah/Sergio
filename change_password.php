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

    <title>Change Password</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<?php include("menu.php"); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <!-- left column -->
                <div class="col-md-12">
                     <!-- general form elements -->
                    <div class="card card-primary mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->                
                        <form method="post" name="change_password_form" id="change_password_form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="o_pw">Current Password</label>
                                    <input type="password" class="form-control" name="c_pw" id="c_pw" placeholder="Current Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="n_pw">New Password</label>
                                    <input type="password" class="form-control" name="n_pw" id="n_pw" placeholder="New Password" required>
                                </div>

                                <div class="form-group">
                                    <label for="cn_pw">Confirm New Password</label>
                                    <input type="password" class="form-control" name="cn_pw" id="cn_pw" placeholder="Confirm New Password" required>
                                </div>
                                <div class="message"></div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" value="Change Password">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include("footer.php"); ?>
<script type="text/javascript" src="js/change_password.js"></script>

</body>
</html>