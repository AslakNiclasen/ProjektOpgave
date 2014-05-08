<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    $ads = $conn->query("SELECT ads.*, customers.name AS customer_name, groups.name AS group_name FROM ads JOIN customers ON customers.id = ads.customer_id JOIN groups ON groups.id = ads.group_id ORDER BY ads.ad_name ASC");
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
                                        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                                        <li class="active">Ads</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h2>Ads</h2>
                                    <em>a collection of all your ads</em>
                                </div>

                                <a href="ad_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add Ad</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-group"></i> Ads</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($customers->num_rows <= 0) {
        echo "You haven't created a customer yet. Create your first customer by clicking <a href='customer_add.php'>here</a>";
    } else {
        if ($groups->num_rows <= 0) {
            echo "No group created yet. Create your first group by clicking <a href='group_add.php'>here</a>";
        } else {
            if ($ads->num_rows <= 0) {
                echo "No ad created yet. Create your first ad by clicking <a href='ad_add.php'>here</a>";
            } else {
?>
                                                    <table class="table">
                                                        <tr>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Customer
                                                            </th>
                                                            <th>
                                                                Group
                                                            </th>
                                                            <th>
                                                                Impressions
                                                            </th>
                                                            <th>
                                                                Deadline
                                                            </th>
                                                        </tr>                                           
<?php
                foreach($ads as $ad){
                    echo "<tr>";
                    echo "<td>". $ad['ad_name'] ."</td>";
                    echo "<td>". $ad['customer_name'] . "</td>";
                    echo "<td>". $ad['group_name'] . "</td>";
                    if ($ad["max_impressions"] == 0) {
                        echo "<td>". $ad["number_of_impressions"] ."</td>";
                    } else {
                        echo "<td>". $ad['max_impressions'] ." / ". $ad['number_of_impressions'] . "</td>";
                    }
                    
                    if ($ad["ad_deadline"] == "0000-00-00 00:00:00") {
                        echo "<td>no deadline</td>";
                    } else {
                        echo "<td>". date("d-m-Y", strtotime($ad['ad_deadline'])) . "</td>";
                    }
                    echo "</tr>";
                }
?>              
                                                    </table>
<?php
            }
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