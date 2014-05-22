<?php
    require_once("include/common_includes.php");

    $ads = $conn->query("SELECT * FROM ads WHERE site_id = '7'");
    $sites = $conn->query("SELECT * FROM sites ORDER BY name DESC");
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
                    'height': 400,
                    'width': 400,
                    'backgroundColor': '#f9f9f9',
                    'legend': {
                        'position': 'none'
                    },
                    'vAxis': {'title': 'Impressions',
                        'minValue': 0, 
                        'maxValue': 1000
                    }
                };

<?php
    foreach($sites as $site) {
        $zones = $conn->query("SELECT * FROM zones WHERE site_id = '". $site["id"] ."'");
        
        foreach($zones as $zone) {
            $ads = $conn->query("SELECT * FROM ads WHERE site_id = '". $site["id"] ."' AND zone_id = '". $zone["id"] ."'");
            
            if ($ads->num_rows > 0) {
                echo "var data = google.visualization.arrayToDataTable([\n";
                echo "['Ad name', 'Number of impressions'],\n";
                
                $i = 0;
                foreach ($ads as $ad) {
                    if ($i == count($ads)+1) {
                        echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ."] \n";
                    } else {
                        echo "['". $ad["ad_name"] ."', ". $ad["number_of_impressions"] ."], \n";
                    }
                    
                    $i++;
                }
                echo "]);\n";
                
                echo "var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_". $zone["id"] ."_". $site["id"] ."'));\n";
                echo "chart.draw(data, options);\n\n";
            }
        }
    }
?>
            }
        </script>
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
                                        <li class="active"><i class="fa fa-home"></i> Home</li>                                 
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
    foreach ($sites as $site) {
        $zones = $conn->query("SELECT * FROM zones WHERE site_id = '". $site["id"] ."'");
?>
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-asterisk"></i> <?php echo $site["name"]; ?></h3>
                                                </div>
                                                <div class="widget-content">
<?php
        foreach($zones as $zone) {
            $ads = $conn->query("SELECT * FROM ads WHERE site_id = '". $site["id"] ."' AND zone_id = '". $zone["id"] ."'");
            if ($ads->num_rows > 0) {
?>
                                                    <div class="widget">
                                                        <div class="widget-header">
                                                            <h3><i class="fa fa-sitemap"></i> <?php echo $zone["name"]; ?></h3>
                                                        </div>
                                                        <div class="widget-content">
                                                            <div id="chart_div_<?php echo $zone["id"]; ?>_<?php echo $site["id"]; ?>"></div>
                                                        </div>
                                                    </div>
<?php
            }
        }
?>
                                                    <div id="chart_div_<?php echo $site["id"]; ?>"></div>
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
        <script type="text/javascript" src="js/easyad.js"></script>
    </body>
</html>
<?php
    include("include/alerts_remove.php");
?>