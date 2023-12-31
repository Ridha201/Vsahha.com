<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/crm/add-customer.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 11:55:35 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRM Admin Panel</title>
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <!-- Start Global Mandatory Style
         =====================================================================-->
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/javascript"></script>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.jqueryui.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <!-- jquery-ui css -->
    {{-- <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/> --}}
    <!-- Bootstrap -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap rtl -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Lobipanel css -->
    <link href="/assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css" />
    <!-- Pace css -->
    <link href="/assets/plugins/pace/flash.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Pe-icon -->
    <link href="/assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />
    <!-- Themify icons -->
    <link href="/assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" />
    <!-- End Global Mandatory Style
         =====================================================================-->
    <!-- Start Theme Layout Style
         =====================================================================-->
    <!-- Theme style -->
    <link href="/assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
    <!-- End Theme Layout Style
         =====================================================================-->
</head>

<body class="hold-transition sidebar-mini">
    <!--preloader-->
    {{-- <div id="preloader">
         <div id="status"></div>
      </div> --}}
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <a href="index-2.html" class="logo">
                <!-- Logo -->
                <span class="logo-mini">
                    <img src="/assets/dist/img/mini-logo.png" alt="">
                </span>
                <span class="logo-lg">
                    <img src="/assets/dist/img/logo.png" alt="">
                </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <!-- Sidebar toggle button-->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="pe-7s-angle-left-circle"></span>
                </a>
                <!-- searchbar-->
                <a href="#search"><span class="pe-7s-search"></span></a>
                <div id="search">
                    <button type="button" class="close">×</button>
                    <form>
                        <input type="search" value="" placeholder="Search.." />
                        <button type="submit" class="btn btn-add">Search...</button>
                    </form>
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Orders -->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle admin-notification" data-toggle="dropdown">
                                <i class="pe-7s-cart"></i>
                                <span class="label label-primary">5</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <!-- start Orders -->
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                    <img src="/assets/dist/img/basketball-jersey.png"
                                                        class="img-thumbnail" alt="User Image">
                                                </div>
                                                <h4>polo shirt</h4>
                                                <p><strong>total item:</strong> 21
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                    <img src="/assets/dist/img/shirt.png" class="img-thumbnail"
                                                        alt="User Image">
                                                </div>
                                                <h4>Kits</h4>
                                                <p><strong>total item:</strong> 11
                                                </p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                    <img src="/assets/dist/img/football.png" class="img-thumbnail"
                                                        alt="User Image">
                                                </div>
                                                <h4>Football</h4>
                                                <p><strong>total item:</strong> 16
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-list">
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                    <img src="/assets/dist/img/shoe.png" class="img-thumbnail"
                                                        alt="User Image">
                                                </div>
                                                <h4>Sports sheos</h4>
                                                <p><strong>total item:</strong> 10
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Messages -->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-bell" id="bell-icon"></i>
                                <span class="label label-success clear_count">{{$count}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu">




                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Notifications -->

                        <!-- Tasks -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-note2"></i>
                                <span class="label label-danger">6</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-success pull-right">50%</span>
                                                <h3><i class="fa fa-check-circle"></i> Theme color should be change
                                                </h3>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-warning pull-right">90%</span>
                                                <h3><i class="fa fa-check-circle"></i> Fix Error and bugs</h3>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-danger pull-right">80%</span>
                                                <h3><i class="fa fa-check-circle"></i> Sidebar color change</h3>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-info pull-right">30%</span>
                                                <h3><i class="fa fa-check-circle"></i> font-family should be change
                                                </h3>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-success pull-right">60%</span>
                                                <h3><i class="fa fa-check-circle"></i> Fix the database Error</h3>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Task item -->
                                            <a href="#" class="border-gray">
                                                <span class="label label-info pull-right">20%</span>
                                                <h3><i class="fa fa-check-circle"></i> data table data missing</h3>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Help -->
                        <li class="dropdown dropdown-help hidden-xs">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-settings"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="profile.html">
                                        <i class="fa fa-line-chart"></i> Networking</a>
                                </li>
                                <li><a href="#"><i class="fa fa fa-bullhorn"></i> Lan settings</a></li>
                                <li><a href="#"><i class="fa fa-bar-chart"></i> Settings</a></li>
                                <li><a href="login.html">
                                        <i class="fa fa-wifi"></i> wifi</a>
                                </li>
                            </ul>
                        </li>
                        <!-- user -->
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/assets/dist/img/avatar5.png" class="img-circle" width="45"
                                    height="45" alt="user"></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="profile.html">
                                        <i class="fa fa-user"></i> User Profile</a>
                                </li>
                                <li><a href="#"><i class="fa fa-inbox"></i> Inbox</a></li>
                                <li><a href="login.html">
                                        <i class="fa fa-sign-out"></i> Signout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar -->
            <div class="sidebar">
                <!-- sidebar menu -->
                <ul class="sidebar-menu">
                    <li class="active">
                        <a href="index-2.html"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i><span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('addcustomer') }}">Add User</a></li>
                            <li><a href="{{ route('customerslist') }}">Users List</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-basket"></i><span>Transaction</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="deposit.html">New Deposit</a></li>
                            <li><a href="expense.html">New Expense</a></li>
                            <li><a href="transfer.html">Transfer</a></li>
                            <li><a href="view-tsaction.html">View transaction</a></li>
                            <li><a href="balance.html">Balance Sheet</a></li>
                            <li><a href="treport.html">Transfer Report</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i><span>Sales</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="invoice.html">Invoices</a></li>
                            <li><a href="ninvoices.html">New Invoices</a></li>
                            <li><a href="recurring.html">Recurring invoices</a></li>
                            <li><a href="nrecurring.html">New Recurring invoices</a></li>
                            <li><a href="quote.html">quotes</a></li>
                            <li><a href="nquote.html">New quote</a></li>
                            <li><a href="payment.html">Payments</a></li>
                            <li><a href="taxeport.html">Tax Rates</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i><span>Task</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="rtask.html">Running Task</a></li>
                            <li><a href="atask.html">Archive Task</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i><span>Accounting</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="cpayment.html">Client payment</a></li>
                            <li><a href="emanage.html">Expense management</a></li>
                            <li><a href="ecategory.html">Expense Category</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-text"></i><span>Report</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="preport.html">Project Report</a></li>
                            <li><a href="creport.html">Client Report</a></li>
                            <li><a href="ereport.html">Expense Report</a></li>
                            <li><a href="incomexp.html">Income expense comparesion</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bell"></i><span>Attendance</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="thistory.html">Time History</a></li>
                            <li><a href="timechange.html">Time Change Request</a></li>
                            <li><a href="atreport.html">Attendance Report</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i><span>Recruitment</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="jpost.html">Jobs Posted</a></li>
                            <li><a href="japp.html">Jobs Application</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-basket"></i><span>payroll</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="salary.html">Salary Template</a></li>
                            <li><a href="hourly.html">Hourly</a></li>
                            <li><a href="managesal.html">Manage salary</a></li>
                            <li><a href="empsallist.html">Employee salary list</a></li>
                            <li><a href="mpayment.html">Make payment</a></li>
                            <li><a href="generatepay.html">Generate payslip</a></li>
                            <li><a href="paysum.html">Payroll summary</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bitbucket-square"></i><span>Stock</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="stockcat.html">Stock category</a></li>
                            <li><a href="manstock.html">Manage Stock</a></li>
                            <li><a href="astock.html">Assign stock</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-ticket"></i><span>Tickets</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="ticanswer.html">Answered</a></li>
                            <li><a href="ticopen.html">Open</a></li>
                            <li><a href="iprocess.html">Inprocess</a></li>
                            <li><a href="close.html">CLosed</a></li>
                            <li><a href="allticket.html">All Tickets</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-list"></i>
                            <span>Utilities</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="ativitylog.html">Activity Log</a></li>
                            <li><a href="emailmes.html">Email message log</a></li>
                            <li><a href="systemsts.html">System status</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bar-chart"></i><span>Charts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class=""><a href="charts_flot.html">Flot Chart</a></li>
                            <li><a href="charts_Js.html">Chart js</a></li>
                            <li><a href="charts_morris.html">Morris Charts</a></li>
                            <li><a href="charts_sparkline.html">Sparkline Charts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-briefcase"></i>
                            <span>Icons</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="icons_bootstrap.html">Bootstrap Icons</a></li>
                            <li><a href="icons_fontawesome.html">Fontawesome Icon</a></li>
                            <li><a href="icons_flag.html">Flag Icons</a></li>
                            <li><a href="icons_material.html">Material Icons</a></li>
                            <li><a href="icons_weather.html">Weather Icons </a></li>
                            <li><a href="icons_line.html">Line Icons</a></li>
                            <li><a href="icons_pe.html">Pe Icons</a></li>
                            <li><a href="icon_socicon.html">Socicon Icons</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-list"></i> <span>Other page</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="forget_password.html">Forget password</a></li>
                            <li><a href="lockscreen.html">Lockscreen</a></li>
                            <li><a href="404.html">404 Error</a></li>
                            <li><a href="505.html">505 Error</a></li>
                            <li><a href="blank.html">Blank Page</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bitbucket"></i><span>UI Elements</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="tabs.html">Tabs</a></li>
                            <li><a href="notification.html">Notification</a></li>
                            <li><a href="tree-view.html">Tree View</a></li>
                            <li><a href="progressbars.html">Progressber</a></li>
                            <li><a href="list.html">List View</a></li>
                            <li><a href="typography.html">Typography</a></li>
                            <li><a href="panels.html">Panels</a></li>
                            <li><a href="modals.html">Modals</a></li>
                            <li><a href="icheck_toggle_pagination.html">iCheck, Toggle, Pagination</a></li>
                            <li><a href="labels-badges-alerts.html">Labels, Badges, Alerts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gear"></i>
                            <span>settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="gsetting.html">Genaral settings</a></li>
                            <li><a href="stfsetting.html">Staff settings</a></li>
                            <li><a href="emailsetting.html">Email settings</a></li>
                            <li><a href="paysetting.html">Payment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="company.html">
                            <i class="fa fa-home"></i> <span>Companies</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="holiday.html">
                            <i class="fa fa-stop-circle"></i> <span>Public Holiday</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="user.html">
                            <i class="fa fa-user-circle"></i><span>User</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="items.html">
                            <i class="fa fa-file-o"></i><span>Items</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="department.html">
                            <i class="fa fa-tree"></i><span>Departments</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="document.html">
                            <i class="fa fa-file-text"></i> <span>Documents</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="train.html">
                            <i class="fa fa-clock-o"></i><span>Training</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="calender.html">
                            <i class="fa fa-calendar"></i> <span>Calender</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="notice.html">
                            <i class="fa fa-file-text"></i> <span>Notice Board</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="message.html">
                            <i class="fa fa-envelope-o"></i> <span>Message</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="note.html">
                            <i class="fa fa-comment"></i> <span>Notes</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">thememinister</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- Start Core Plugins
         =====================================================================-->
    <!-- jQuery -->
    <!-- jquery-ui -->
    {{-- <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script> --}}
    <!-- Bootstrap -->
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- lobipanel -->
    <script src="/assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
    <!-- Pace js -->
    <script src="/assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    {{-- <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script> --}}
    <!-- FastClick -->
    <script src="/assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- CRMadmin frame -->
    <script src="/assets/dist/js/custom.js" type="text/javascript"></script>
    <!-- End Core Plugins
         =====================================================================-->
    <!-- Start Theme label Script
         =====================================================================-->
    <!-- Dashboard js -->
    <script src="/assets/dist/js/dashboard.js" type="text/javascript"></script>
    <!-- End Theme label Script
         =====================================================================-->
    <script>
        $(document).ready(function() {
            $('#exemple').DataTable();
        });
    </script>

</body>

<!-- Mirrored from thememinister.com/crm/add-customer.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Aug 2023 11:55:35 GMT -->

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $("#bell-icon").click(function() {
        $.ajax({
            type: "GET",
            url: "{{ route('change_show') }}",
            success: function(response) {
                // Clear the HTML content of the bell icon
                $(".clear_count").html('0');
                console.log("Request was successful!");
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    });

    function updateNotification() {
    $.ajax({
        type: "GET",
        url: "{{ route('show') }}",
        success: function(response) {
            // Clear the existing list
            

            // Iterate through the appointments and add them to the list
            response.appointments.forEach(function(appointment) {
                var htmlContent = '<li>' +
                    '<a href="#" class="border-gray">' +
                    '<div class="pull-left">' +
                    '<img src="/assets/dist/img/avatar.png" class="img-circle" alt="User Image">' +
                    '</div>' +
                    '<h4>' + appointment.patient_name.toUpperCase() + '</h4>' +
                    '<p>Booked a new Appointment</p>' +
                    '<span class="badge badge-success badge-massege"><small> on ' + appointment.appointment_time + '</small></span>' +
                    '</a>' +
                    '</li>';

                $(".menu").append(htmlContent);
            });

            $(".clear_count").html(response.count);
        },
        error: function(xhr, status, error) {
            console.error("An error occurred: " + error);
        }
    });
}

updateNotification();
setInterval(updateNotification, 10000); // Refresh every 10 seconds

    
});
</script>
