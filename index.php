<!doctype html>
<html lang="en">
    <head>
        <?php include("header.php"); ?>

        <title>Login</title>
    </head>
    <body>
          <div class="container">
            <div class="row justify-content-md-center mt-5">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Employee Login</h3>
                        </div>                        
                        <form method="post" name="login_form" id="login_form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="jms_email_id">Email address</label>
                                    <input type="email" class="form-control" id="jms_email_id" name="jms_email_id" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label for="jms_password">Password</label>
                                    <input type="password" class="form-control" id="jms_password" name="jms_password" placeholder="Password" required>
                                </div>   
                                <div class="message"></div>
                             </div>               

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Login</button>                                
                                <a href="forgot_password.php" class="btn btn-primary">Forgot Password</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>

         <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/adminlte.min.js"></script>   
             
        <script type="text/javascript" src="js/login.js"></script>
    </body>
</html>