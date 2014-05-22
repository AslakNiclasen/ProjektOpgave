<?php
    require_once("include/common_includes.php");

    $ads = $conn->query("SELECT ads.*, sites.name AS site_name, sites.id AS site_id, zones.name AS zone_name, zones.id AS zone_id FROM ads JOIN sites ON sites.id = ads.site_id JOIN zones ON zones.id = ads.zone_id ORDER BY ads.ad_name ASC");
    $sites = $conn->query("SELECT * FROM sites ORDER BY name ASC");
    $zones = $conn->query("SELECT zones.*, sites.name as site_name FROM zones JOIN sites ON zones.site_id = sites.id");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>EasyAd</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/main.css" rel="stylesheet" type="text/css">
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
                                        <li class="active">Ads</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Ads</h1>
                                </div>

                                <a href="ad_create.php" class="btn btn-primary"><i class="fa fa-plus"></i> Create Ad</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-picture-o"></i> Ads</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($sites->num_rows <= 0) {
        echo "You haven't created a site yet. Create your first site by clicking <a href='site_create.php'>here</a>";
    } else {
        if ($zones->num_rows <= 0) {
            echo "No zone created yet. Create your first zone by clicking <a href='zone_create.php'>here</a>";
        } else {
            if ($ads->num_rows <= 0) {
                echo "No ad created yet. Create your first ad by clicking <a href='ad_create.php'>here</a>";
            } else {
?>
                                                    <table class="table">
                                                        <tr>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Site
                                                            </th>
                                                            <th>
                                                                Zone
                                                            </th>
                                                            <th>
                                                                Impressions
                                                            </th>
                                                            <th>
                                                                Deadline
                                                            </th>
                                                            <th>
                                                                &nbsp;
                                                            </th>
                                                        </tr>                                           
<?php
                foreach($ads as $ad){
                    echo "<tr id='tr_". $ad["id"] ."'>";
                    echo "<td><a href='ad_edit.php?id=". $ad["id"] ."' title='Edit ad'>". $ad["ad_name"] ."</a></td>";
                    echo "<td><a href='site_edit.php?id=". $ad["site_id"] ."' title='Edit site'>". $ad["site_name"] . "</a></td>";
                    echo "<td><a href='zone_edit.php?id=". $ad["zone_id"] ."' title='Edit zone'>". $ad["zone_name"] . "</a></td>";
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
                    
                    echo "<td align='right'>";
                    if ($ad["ad_active"] == 1) {
                        echo "<input type='checkbox' class='switch-demo switch-mini' data-on='success' data-off='default' id='ad_active_". $ad["id"] ."' checked>";
                    } else {
                        echo "<input type='checkbox' class='switch-demo switch-mini' data-on='success' data-off='default' id='ad_active_". $ad["id"] ."'>";
                    }
                    echo " &nbsp;&nbsp;&nbsp;&nbsp; <a href='ad_edit.php?id=". $ad["id"] ."'><i class='fa fa-wrench' title='Edit ad'></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-trash-o' id='ad_delete_". $ad["id"] ."' title='Delete ad'></i>";
                    echo "</td>";
                    
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
        <script type="text/javascript" src="assets/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="js/easyad.js"></script>
        <script>
            $(document).ready(function() {
                $("i, a, .switch-demo").tooltip();

                $(".switch-demo").bootstrapSwitch();

                $(".switch-demo").on("switch-change", function(event, state) {
                    var on_or_off = state.value;
                    var ad_id = $(this).attr("id").split("_")[2];

                    if (on_or_off) {
                        on_or_off = 1;
                    } else {
                        on_or_off = 0;
                    }

                    $.post("ajax_ad_activate.php", { ad_id: ad_id, on_or_off: on_or_off }, function(response) {
                        showFeedback(response.status, response.msg);
                    }, "json");
                });
                
                $("i[id^='ad_delete_']").click(function() {
                    if (confirm("Do you want to delete?")) {
                        var id = $(this).attr("id").split("_")[2];
                        
                        $.post("ajax_ad_delete.php", { id: id }, function(response) {
                            if (response.status == "OK") {
                                $("#tr_"+ id).fadeOut(600, function(){
                                    $("#tr_"+ id).remove();
                                });
                                
                                showFeedback(response.status, response.msg);
                            } else {
                                showFeedback(response.status, response.msg);
                            }
                        }, "JSON");
                    }
                });
            });
        </script>
    </body>
</html>
<?php
    include("include/alerts_remove.php");
?>