<?php
    require_once("include/common_includes.php");
    
    $id = $_GET["id"];

    $sites = $conn->query("SELECT * FROM sites");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $zone_description = $_POST["zone_description"];
        $site_id = $_POST["site_id"];
        
        $conn->query("UPDATE zones SET name = '". $zone_description ."', site_id = '". $site_id ."' WHERE id = '". $id ."'");
        
        header("location: zones.php");
    } else {
        $zone = $conn->query("SELECT * FROM zones WHERE id = '". $id ."'")->fetch_assoc();
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
                                        <li><a href="zones.php">Zones</a></li>
                                        <li class="active">Create zone</li>
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Create zone</h1>
                                </div>

                                <a href="zones.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back to zones</a>
                                <br>
                                <br>
                                
                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-sitemap"></i> Create zone</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($sites->num_rows <= 0) {
        echo "<td>No sites created yet. Create your first site by clicking <a href='site_create.php'>here</a></td>";
    } else {
?>
                                                    <form role="form" method="post" action="zone_edit.php?id=<?php echo $id; ?>">
                                                        <div class="form-group">
                                                            <label for="zone_description">Zone description</label>
                                                            <input type="text" class="form-control" name="zone_description" id="zone_description" value="<?php echo $zone["name"]; ?>" placeholder="Zone description">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="site_id">Zone belongs to site</label>
                                                            <select class="form-control" name="site_id" id="site_id">
<?php
        foreach($sites as $site) {
            if ($site["id"] == $zone["customer_id"]) {
                echo "<option value='". $site["id"] ."' selected>". $site["name"] ."</option>";
            } else {
                echo "<option value='". $site["id"] ."'>". $site["name"] ."</option>";
            }
        }
?>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-inverse"></i> Save changes now</button>
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
        <script type="text/javascript" src="js/easyad.js"></script>
    </body>
</html>