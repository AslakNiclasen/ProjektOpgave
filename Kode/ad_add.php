<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");

    $customers = $conn->query("SELECT * FROM customers ORDER BY name ASC");
    $groups = $conn->query("SELECT * FROM groups ORDER BY name ASC");

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    $name = @$_POST["adname"];
    $customer_id = @$_POST["customer_id"];
    $group_id = @$_POST["group_id"];
    $max_impressions = @$_POST["maxImpressions"];
    $ad_deadline = @$_POST["adDeadline"];
    $file_name_extensions = @explode(".", $_FILES["ad_file"]["name"]);
    $length_of_array = count($file_name_extensions);
    $file_type = @$file_name_extensions[$length_of_array-1];
    $new_file_name = generateRandomString() .".". $file_type;  
    
    if (strtotime(@$ad_deadline) > 10000) {
        $timestamp = @date("Y-m-d H:i:s", strtotime($ad_deadline));
    } else {
        $timestamp = NULL;
    }
    
    if ( $name && $customer_id && $group_id) {
        move_uploaded_file($_FILES["ad_file"]["tmp_name"], "ads/" . $new_file_name);

        $conn->query("INSERT INTO ads (ad_name, file_name, max_impressions, ad_deadline, customer_id, group_id) VALUES('". $name ."', '". $new_file_name ."', '". $max_impressions ."', '". $timestamp ."', '". $customer_id ."', '". $group_id ."')");
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
    if ($customers->num_rows <= 0) {
        echo "No customer created yet. Create your first customer by clicking <a href='customer_add.php'>here</a>";
    } else {
        if ($groups->num_rows <= 0) {
            echo "No group created yet. Create your first group by clicking <a href='group_add.php'>here</a>";
        } else {
?>                                                
                                                    <form role="form" method="post" action="ad_add.php" enctype="multipart/form-data" id="ad_form">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Ad name *</label>
                                                            <input type="text" class="form-control" name="adname" id="adname" placeholder="Ad name">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="maxImpressions">Max impressions</label>
                                                            <input type="text" class="form-control" id="maxImpressions" name="maxImpressions" value="0">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="adDeadline">Deadline for ad</label>
                                                            <input type="text" class="form-control" id="adDeadline" name="adDeadline" placeholder="DD/MM/YYYY">
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Customer name *</label>
                                                            <select class="form-control" name="customer_id" id="customer_id">
                                                                <option value="" disabled selected>Please choose a customer</option>
<?php
            foreach($customers as $customer) {
                echo "<option value='". $customer["id"] ."'>". $customer["name"] ."</option>";
            }
?>
                                                            </select>
                                                        </div>                                                        
                                                        
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Group name *</label>
                                                            <select class="form-control" name="group_id" id="group_id" disabled>
                                                                <option value="" disabled selected>Please choose a customer</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">Choose file to upload *</label>
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
        <script>
            $(document).ready(function() {
                $("#adDeadline").datepicker();
                
                $("#customer_id").change(function() {
                    var customer_id = $(this).val();
                    
                    $("#group_id").prop("disabled", "true");
                    $("#group_id option:first").html("Please wait...");
                    
                    $.get("ajax_get_groups.php", { customer_id: customer_id }, function(response) {
                        $("#group_id").append(response);
                        $("#group_id option:first").html("Please choose a group");
                        $("#group_id").removeAttr("disabled");
                    });
                });

                $("#create_submit").click(function(e) {
                    e.preventDefault();
                    
                    var adname = $("#adname").val();
                    var customer_id = $("#customer_id").val();
                    var group_id = $("#group_id").val();
                    var ad_file = $("#ad_file").val();
                    
                    if (!adname || adname == "") {
                        alert("Please write an ad name");
                    } else if (!customer_id || customer_id <= 0) {
                        alert("Please choose a customer");
                    } else if (!group_id || group_id <= 0) {
                        alert("Please choose a group");
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