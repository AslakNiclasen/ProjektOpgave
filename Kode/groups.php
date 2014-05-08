<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");
    
    $customers = $conn->query("SELECT * FROM customers ORDER BY name ASC");
    $groups = $conn->query("SELECT groups.*, customers.name as customer_name FROM groups JOIN customers ON groups.customer_id = customers.id");
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
                                        <li class="active">Groups</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h2>Groups</h2>
                                    <em>a collection of all your groups</em>
                                </div>

                                <a href="group_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add group</a>
                                <br>
                                <br>

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
        echo "No customer created yet. Create your first customer by clicking <a href='customer_add.php'>here</a>";
    } else {
        if ($groups->num_rows <= 0) {
            echo "No group created yet. Create your first group by clicking <a href='group_add.php'>here</a>";
        } else {
?>
                                                    <table class="table">
                                                        <tr>
                                                            <th>
                                                                Group description
                                                            </th>
                                                            <th>
                                                                Belongs to customer
                                                            </th>
                                                        </tr>
<?php
            foreach($groups as $group) {
                echo "<tr>";
                echo "<td>". $group["name"] ."</td>";
                echo "<td>". $group["customer_name"] ."</td>";
                echo "</tr>";
            }
?>
                                                    </table>
<?php
        }
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