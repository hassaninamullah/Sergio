<!doctype html>
<html lang="en">
    <head>
        <?php include("header.php"); ?>

        <title>Forgot Password</title>
    </head> 
    <body>
        <div class="container">
            <div class="row justify-content-md-center mt-5">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Forgot Password</h3>
                        </div>                        
                        <form method="post" name="forgot_password_form" id="forgot_password_form">
                            <div class="card-body">
                                <div class="form-group">                                                       
                                    <label>Enter E-Mail ID</label>
                                    <input type="email" class="form-control" name="jms_email_id" id="jms_email_id">
                                </div>  
                                <div class="message"></div>
                             </div>               

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Send</button>
                                <a href="index.php" class="btn btn-primary">Login</a>                                
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript" src="js/forgot_password.js"></script>
    </body>
</html>