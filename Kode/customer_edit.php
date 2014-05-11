<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    $id = $_GET["id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_name = $_POST["customer_name"];
        $customer_url = $_POST["customer_url"];
        
        $conn->query("UPDATE customers SET name = '". $customer_name ."', url = '". $customer_url ."' WHERE id = '". $id ."'");
        
        header("location: customers.php");
    } else {
        $customer = $conn->query("SELECT * FROM customers WHERE id = '". $id ."'")->fetch_assoc();
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
                                        <li class="active">Edit customer</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Edit customer</h1>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-group"></i> Edit customer</h3>
                                                </div>
                                                <div class="widget-content">
                                              
                                                   <form role="form" method="post" action="customer_edit.php?id=<?php echo $id; ?>">
                                                      <div class="form-group">
                                                        <label for="customer_name">Name</label>
                                                        <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Name" value="<?php echo $customer["name"]; ?>">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="customer_url">URL (Customer's website)</label>
                                                        <input type="text" name="customer_url" id="customer_url" class="form-control" placeholder="URL" value="<?php echo $customer["url"]; ?>">
                                                      </div>
                                                      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-inverse"></i> Save changes</button>
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