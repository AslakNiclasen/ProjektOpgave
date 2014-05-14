<?php
    require_once("include/common_includes.php");
    
    $site_name = @$_POST["site_name"];
    $site_url = @$_POST["site_url"];
    $access_token = generateRandomString();
    
    if ($site_name && $site_url) {
        if ($conn->query("INSERT INTO sites (name, url, access_token) VALUES('". $site_name ."', '". $site_url ."', '". $access_token ."')")) {
            $_SESSION["status"] = "OK";
            $_SESSION["msg"] = "Site created successfully";
        } else {
            $_SESSION["status"] = "NOT_OK";
            $_SESSION["msg"] = "Site was not created!";
        }
        
        header("location: sites.php");
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
                                        <li><a href="sites.php">Sites</a></li>   
                                        <li class="active">Create site</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Create site</h1>
                                </div>
                                
                                <a href="sites.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back to sites</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-asterisk"></i> Create site<h3>
                                                </div>
                                                <div class="widget-content">
                                              
                                                   <form role="form" method="post" action="site_create.php">
                                                      <div class="form-group">
                                                        <label for="site_name">Name</label>
                                                        <input type="text" name="site_name" class="form-control" id="site_name" placeholder="Enter Name">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="site_url">URL</label>
                                                        <input type="text" name="site_url" class="form-control" id="site_url" placeholder="URL">
                                                      </div>
                                                      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o fa-inverse"></i> Create site now</button>
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
        <script type="text/javascript" src="js/easyad.js"></script>
    </body>
</html>