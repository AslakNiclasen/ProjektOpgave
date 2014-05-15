<?php
    require_once("include/common_includes.php");

    $admin_name = $conn->real_escape_string(@$_POST["admin_name"]);
    $admin_email = $conn->real_escape_string(@$_POST["admin_email"]);
    $admin_password = $conn->real_escape_string(@$_POST["admin_password"]);
    
    if ($admin_name && $admin_email && $admin_password) {
        $conn->query("INSERT INTO admins (name, email, password) VALUES('". $admin_name ."', '". $admin_email ."', '". $admin_password ."')");
        header("location: admins.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EasyAd</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    </head>
    <body class="dashboard">
<?php
    include("include/alerts.php");
?>
        <div class="wrapper">
            <!-- TOP BAR -->
<?php
    include("sections/top.php");
?>
            <!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
            <div class="bottom">
                <div class="container">
                    <div class="row">
                        <!-- left sidebar -->
<?php
    include("sections/left_sidebar.php");
?>
                        <!-- content-wrapper -->
                        <div class="col-md-10 content-wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="breadcrumb">
                                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                                        <li><a href="admins.php">Admins</a></li>   
                                        <li class="active">Create admin</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Create admin</h1>
                                </div>

                                <a href="admins.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back to admins</a>
                                <br>
                                <br>
                                
                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-user"></i> Create admin</h3>
                                                </div>
                                                <div class="widget-content">
                                              
                                                   <form role="form" method="post" action="admin_add.php">
                                                      <div class="form-group">
                                                        <label for="admin_name">Name</label>
                                                        <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Admin Name">
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                        <label for="admin_email">Email</label>
                                                        <input type="text" name="admin_email" class="form-control" id="admin_email" placeholder="Admin email">
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                        <label for="admin_password">Password</label>
                                                        <input type="text" name="admin_password" class="form-control" id="admin_password" placeholder="Admin password">
                                                      </div>
                                                      
                                                      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-inverse"></i> Create admin now</button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                            <!-- END INPUT GROUPS -->
                                        </div>
                                    </div>
                                    <!-- /row -->


                                </div>
                                <!-- /main-content -->
                            </div>
                            <!-- /main -->
                        </div>
                        <!-- /content-wrapper -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- END BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->

            <!-- FOOTER -->
            <footer class="footer">
                &copy; 2013 The Develovers
            </footer>
            <!-- END FOOTER -->
        </div>
        <!-- /wrapper -->

        <script src="//code.jquery.com/jquery-latest.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/modernizr.js"></script>
        <script type="text/javascript" src="assets/js/king-common.js"></script>
        <script type="text/javascript" src="assets/js/king-chart-stat.js"></script>
        <script type="text/javascript" src="assets/js/king-table.js"></script>
        <script type="text/javascript" src="assets/js/king-components.js"></script>
        <script type="text/javascript" src="js/easyad.js"></script>
    </body>
</html>