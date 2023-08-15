<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from thememinister.com/crm/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 11:56:47 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>CRM Admin panel</title>
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
         <!-- Pe-icon-7-stroke -->
        <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <!-- style css -->
        <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="login-wrapper">
            <div class="back-link">
                <a href="index-2.html" class="btn btn-add">Back to Dashboard</a>
            </div>
            <div class="container-center lg">
             <div class="login-area">
                <div class="panel panel-bd panel-custom">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Register</h3>
                                <small><strong>Please enter your data to register.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="http://thememinister.com/crm/index.html" id="loginForm" novalidate  method="POST" action="{{ route('register2') }}">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Username</label>
                                    <input type="text" value="" id="username" class="form-control" name="name">
                                    <span class="help-block small">Your unique username to app</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email Address</label>
                                    <input type="text" value="" id="email" class="form-control" name="email">
                                    <span class="help-block small">Your address email to contact</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Password</label>
                                    <input type="password" value="" id="password" class="form-control" name="password">
                                    <span class="help-block small">Your hard to guess password</span>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Repeat Password</label>
                                    <input type="password" value="" id="repeatpassword" class="form-control" name="password_confirmation">
                                    <span class="help-block small">Please repeat your pasword</span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Doctor Or Insurance Agency ? </label>
                                    <select class="form-control" name="role" id="roleSelect" >
                                        <option value="Doctor">Doctor</option>
                                        <option value="Insurance Agency">Insurance Agency</option> 
                                    </select>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-warning">Register</button>
                               
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>

<!-- Mirrored from thememinister.com/crm/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 11:56:47 GMT -->
</html>