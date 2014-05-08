<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");
    
    $customers = $conn->query("SELECT * FROM customers ORDER BY name ASC");
    
    $groupname = @$_POST["groupname"];
    $customer_id = @$_POST["customer_id"];
    
    if ($groupname && $customer_id) {
        $conn->query("INSERT INTO groups (customer_id, name) VALUES('". $customer_id ."', '". $groupname ."')");
       header("location: groups.php");
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
                                        <li><a href="groups.php">Groups</a></li>
                                        <li class="active">Add group</li>
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Groups</h1>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-tags"></i> Groups</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($customers->num_rows <= 0) {
        echo "<td>No customer created yet. Create your first customer by clicking <a href='customer_add.php'>here</a></td>";
    } else {
?>
                                                    <form role="form" method="post" action="group_add.php">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Group description</label>
                                                            <input type="text" class="form-control" name="groupname" id="groupname" placeholder="Group name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Group belongs to customer</label>
                                                            <select class="form-control" name="customer_id">
<?php
        foreach($customers as $customer) {
            echo "<option value='". $customer["id"] ."'>". $customer["name"] ."</option>";
        }
?>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Create group now</button>
                                                    </form>
<?php
    }
?>
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