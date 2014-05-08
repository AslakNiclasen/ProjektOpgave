<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#¤%&/()=?.,-_+';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
    
    $customer_name = @$_POST["customer_name"];
    $url = @$_POST["url"];
    $access_token = generateRandomString();
    
    if ($customer_name && $url) {
        $conn->query("INSERT INTO customers (name, url, access_token) VALUES('". $customer_name ."', '". $url ."', '". $access_token ."')");
        header("location: customers.php");
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
                                        <li><a href="customers.php">Customers</a></li>   
                                        <li class="active">Add customer</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Customers</h1>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-group"></i> Customers</h3>
                                                </div>
                                                <div class="widget-content">
                                              
                                                   <form role="form" method="post" action="customer_add.php">
                                                      <div class="form-group">
                                                        <label for="exampleInputEmail1">Name</label>
                                                        <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="exampleInputPassword1">URL (Customer's website)</label>
                                                        <input type="text" name="url" class="form-control" id="exampleInputPassword1" placeholder="URL">
                                                      </div>
                                                      <button type="submit" class="btn btn-primary">Create customer now</button>
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
    </body>
</html>