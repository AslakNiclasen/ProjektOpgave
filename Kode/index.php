<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    $ads = $conn->query("SELECT * FROM ads");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EasyAd</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/main.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Ad name',     'Number of impressions',    'Remaining impressions'],
                    
<?php
    $i = 0;
    foreach ($ads as $ad) {
        if ($i == count($ads)+1) {
            echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ." , ". $ad["max_impressions"] ."] \n";
        } else {
            echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ." , ". $ad["max_impressions"] ."], \n";
        }
        $i++;
    }
?>
                    
                ]);

                var options = {
                    title: 'Ads impressions',
                    'height': 500,
                    'legend': {
                        'position': 'bottom'
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </head>
    <body class="dashboard">
        <div class="wrapper">
            <!-- TOP BAR -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <!-- logo -->
                        <div class="col-md-2 logo">
                            <a href="index.php">
                                Open Source banner
                            </a>
                            <h1 class="sr-only">Open Source admin</h1>
                        </div>
                        <!-- end logo -->

                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="top-bar-right">
                                        <!-- logged user and the menu -->
                                        <div class="logged-user">
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                                    <span class="name">Signar Nielsen</span>
                                                    <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-user"></i>
                                                            <span class="text">Profile</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-cog"></i>
                                                            <span class="text">Settings</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-power-off"></i>
                                                            <span class="text">Logout</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- end logged user and the menu -->
                                    </div>
                                    <!-- /top-bar-right -->
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /top -->


            <!-- BOTTOM: LEFT NAV AND RIGHT MAIN CONTENT -->
            <div class="bottom">
                <div class="container">
                    <div class="row">
                        <!-- left sidebar -->
                        <div class="col-md-2 left-sidebar">

                            <!-- main-nav -->
                            <nav class="main-nav">
<?php
     include("include/menu.php");
?>
                            </nav>
                            <!-- /main-nav -->

                            <div class="sidebar-minified js-toggle-minified">
                                <i class="fa fa-angle-left"></i>
                            </div>

                            <!-- sidebar content -->
                            <div class="sidebar-content">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5><i class="fa fa-lightbulb-o"></i> Tips</h5>
                                    </div>
                                    <div class="panel-body">
                                        <p>You can do live search to the widget at search box located at top bar. It's very useful if your dashboard is full of widget.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end sidebar content -->
                        </div>
                        <!-- end left sidebar -->

                        <!-- content-wrapper -->
                        <div class="col-md-10 content-wrapper">
                            <div class="row">
                                <div class="col-md-4">
                                    <ul class="breadcrumb">
                                        <li class="active"><i class="fa fa-home"></i> Home</li>                                 
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h2>Statistics</h2>
                                    <em>how are your ads performing?</em>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-bar-chart-o"></i> Statistics</h3>
                                                </div>
                                                <div class="widget-content">
                                                    <div id="chart_div"></div>
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