<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    $ads = $conn->query("SELECT * FROM ads WHERE customer_id = '7'");
    $customers = $conn->query("SELECT * FROM customers ORDER BY name DESC");
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
                var options = {
                    title: 'Ads impressions',
                    'height': 300,
                    'legend': {
                        'position': 'bottom'
                    }
                };

<?php
    foreach($customers as $customer) {
        $groups = $conn->query("SELECT * FROM groups WHERE customer_id = '". $customer["id"] ."'");
        
        foreach($groups as $group) {
            $ads = $conn->query("SELECT * FROM ads WHERE customer_id = '". $customer["id"] ."' AND group_id = '". $group["id"] ."'");
            
            if ($ads->num_rows > 0) {
                
                echo "var data = google.visualization.arrayToDataTable([\n";
                echo "['Ad name', 'Number of impressions', 'Remaining impressions'],\n";
                
                $i = 0;
                foreach ($ads as $ad) {
                    if ($i == count($ads)+1) {
                        echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ." , ". $ad["max_impressions"] ."] \n";
                    } else {
                        echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ." , ". $ad["max_impressions"] ."], \n";
                    }
                    
                    $i++;
                }
                echo "]);\n";
                
                echo "var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_". $group["id"] ."_". $customer["id"] ."'));\n";
                echo "chart.draw(data, options);\n\n";
            }
        }
    }
?>
            }
        </script>
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
                                        <li class="active">Statistics</li>                               
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Statistics</h1>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
<?php
    foreach ($customers as $customer) {
        $groups = $conn->query("SELECT * FROM groups WHERE customer_id = '". $customer["id"] ."'");
?>
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-bar-chart-o"></i> Statistics for <?php echo $customer["name"]; ?></h3>
                                                </div>
                                                <div class="widget-content">
<?php
        foreach($groups as $group) {
            $ads = $conn->query("SELECT * FROM ads WHERE customer_id = '". $customer["id"] ."' AND group_id = '". $group["id"] ."'");
            if ($ads->num_rows > 0) {
?>
                                                    <div class="widget">
                                                        <div class="widget-header">
                                                            <h3><i class="fa fa-tags"></i> <?php echo $group["name"]; ?></h3>
                                                        </div>
                                                        <div class="widget-content">
                                                            <div id="chart_div_<?php echo $group["id"]; ?>_<?php echo $customer["id"]; ?>"></div>
                                                        </div>
                                                    </div>
<?php
            }
        }
?>
                                                    <div id="chart_div_<?php echo $customer["id"]; ?>"></div>
                                                </div>
                                            </div>
<?php
    }
?>
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