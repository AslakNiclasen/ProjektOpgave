<?php
    require_once("include/common_includes.php");

    //Fetching all sites and zones
    $sites = $conn->query("SELECT * FROM sites ORDER BY name ASC");
    $zones = $conn->query("SELECT * FROM zones ORDER BY name ASC");

    //Fetching all variables and escaping
    $ad_name = $conn->real_escape_string(@$_POST["ad_name"]);
    $site_id = $conn->real_escape_string(@$_POST["site_id"]);
    $zone_id = $conn->real_escape_string(@$_POST["zone_id"]);
    $max_impressions = $conn->real_escape_string(@$_POST["max_impressions"]);
    $ad_deadline = $conn->real_escape_string(@$_POST["ad_deadline"]);
    $file_name = $conn->real_escape_string(@$_FILES["ad_file"]["name"]);
    $file_name_tmp = $conn->real_escape_string(@$_FILES["ad_file"]["tmp_name"]);
    
    //Handling file-upload
    $file_name_extensions = @explode(".", $file_name);
    $length_of_array = count($file_name_extensions);
    $file_type = @$file_name_extensions[$length_of_array-1];
    $new_file_name = generateRandomString() .".". $file_type;  
    
    //Handling date
    if (strtotime(@$ad_deadline) > 10000) {
        $timestamp = @date("Y-m-d H:i:s", strtotime($ad_deadline));
    } else {
        $timestamp = NULL;
    }
    
    if ($ad_name && is_numeric($site_id) && is_numeric($zone_id)) {
        move_uploaded_file($file_name_tmp, "ads/" . $new_file_name);

        $conn->query("INSERT INTO ads (ad_name, file_name, max_impressions, ad_deadline, site_id, zone_id) VALUES('". $ad_name ."', '". $new_file_name ."', '". $max_impressions ."', '". $timestamp ."', '". $site_id ."', '". $zone_id ."')");
        header("location: ads.php");
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
                                        <li><a href="ads.php">Ads</a></li>
                                        <li class="active">Create ad</li>
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Create ad</h1>
                                </div>

                                <a href="ads.php" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back to ads</a>
                                <br>
                                <br>
                                
                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-picture-o"></i> Create ad</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($sites->num_rows <= 0) {
        echo "No site created yet. Create your first site by clicking <a href='site_create.php'>here</a>";
    } else {
        if ($zones->num_rows <= 0) {
            echo "No zone created yet. Create your first zone by clicking <a href='zone_create.php'>here</a>";
        } else {
?>                                                
                                                    <form role="form" method="post" action="ad_create.php" enctype="multipart/form-data" id="ad_form">
                                                        <div class="form-group">
                                                            <label for="ad_name">Ad name *</label>
                                                            <input type="text" class="form-control" name="ad_name" id="ad_name" placeholder="Ad name">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="max_impressions">Max impressions</label>
                                                            <input type="text" class="form-control" id="max_impressions" name="max_impressions" value="0">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="ad_deadline">Deadline for ad</label>
                                                            <input type="text" class="form-control" id="ad_deadline" name="ad_deadline" placeholder="DD/MM/YYYY">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="site_id">Site name *</label>
                                                            <select class="form-control" name="site_id" id="site_id">
                                                                <option value="" disabled selected>Please choose a site</option>
<?php
            foreach($sites as $site) {
                echo "<option value='". $site["id"] ."'>". $site["name"] ."</option>";
            }
?>
                                                            </select>
                                                        </div>                                                        
                                                        
                                                        <div class="form-group">
                                                            <label for="zone_id">Zone name *</label>
                                                            <select class="form-control" name="zone_id" id="zone_id" disabled>
                                                                <option value="" disabled selected>Please choose a zone</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ad_file">Choose file to upload *</label>
                                                            <input type="file" id="ad_file" name="ad_file">
                                                        </div>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary" id="create_submit"><i class="fa fa-floppy-o fa-inverse"></i> Create ad now</button>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        * Required field
                                                    </form>
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
        <script type="text/javascript" src="datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/easyad.js"></script>
        <script>
            $(document).ready(function() {
                $("#ad_deadline").datepicker();
                
                $("#site_id").change(function() {
                    var site_id = $(this).val();
                    
                    $("#zone_id").prop("disabled", "true");
                    $("#zone_id option:first").html("Please wait...");
                    
                    $.get("ajax_zones_get.php", { site_id: site_id }, function(response) {
                        console.log(response);
                        $("#zone_id").append(response);
                        $("#zone_id option:first").html("Please choose a zone");
                        $("#zone_id").removeAttr("disabled");
                    });
                });

                $("#create_submit").click(function(e) {
                    e.preventDefault();
                    
                    var ad_name = $("#ad_name").val();
                    var site_id = $("#site_id").val();
                    var zone_id = $("#zone_id").val();
                    var ad_file = $("#ad_file").val();
                    
                    if (!ad_name || ad_name == "") {
                        alert("Please write an ad name");
                    } else if (!site_id || site_id <= 0) {
                        alert("Please choose a site");
                    } else if (!zone_id || zone_id <= 0) {
                        alert("Please choose a zone");
                    } else if (!ad_file || ad_file == "") {
                        alert("Please choose an ad to upload");
                    } else {
                        $("#ad_form").submit();
                    }
                });
            });
        </script>
    </body>
</html>