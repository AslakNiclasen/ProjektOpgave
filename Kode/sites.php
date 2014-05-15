<?php
    require_once("include/common_includes.php");
    
    $sites = $conn->query("SELECT sites.*, (SELECT COUNT(id) FROM zones WHERE site_id = sites.id) AS zones_count, (SELECT COUNT(id) FROM ads WHERE site_id = sites.id) AS ads_count FROM sites ORDER BY name ASC");
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
                                        <li class="active">Sites</li>                             
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Sites</h1>
                                </div>

                                <a href="site_create.php" class="btn btn-primary"><i class="fa fa-plus"></i> Create site</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-asterisk"></i> Sites</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($sites->num_rows <= 0) {
        echo "No sites created yet. Create your first site by clicking <a href='site_create.php'>here</a>";
    } else {
?>
                                                    <table class="table">

                                                        <tr>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                URL
                                                            </th>
                                                            <th>
                                                                Access Token
                                                            </th>
                                                            <th>
                                                                Zones in site
                                                            </th>
                                                            <th>
                                                                Ads in site
                                                            </th>
                                                            <th>
                                                                &nbsp;
                                                            </th>
                                                        </tr>                              
<?php
        foreach($sites as $site){
            echo "<tr id='tr_". $site["id"] ."'>";
            echo "<td><a href='site_edit.php?id=". $site["id"] ."' title='Edit site'>" . $site["name"] . "</a></td>";
            echo "<td>" . $site["url"] . "</td>";
            echo "<td>" . $site["access_token"] . "</td>";
            echo "<td>" . $site["zones_count"] . "</td>";
            echo "<td>" . $site["ads_count"] . "</td>";
            echo "<td align='right'><a href='site_edit.php?id=". $site["id"] ."'><i class='fa fa-wrench' title='Edit site'></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-trash-o' id='site_delete_". $site["id"] ."' title='Delete site'></i></td>";
            echo "</tr>";
        }
?>              
                                                    </table>
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
        <script type="text/javascript" src="js/easyad.js"></script>
        <script>
            $(document).ready(function() {
                $("i, a").tooltip();
                
                $("i[id^='site_delete_']").click(function() {
                    if (confirm("Do you want to delete?\n\nNOTE!!All zones belonging to this site will be deleted\n\nNOTE!! All ads belonging to site will be deleted")) {
                        var id = $(this).attr("id").split("_")[2];
                        
                        $.post("ajax_site_delete.php", { id: id }, function(response) {
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