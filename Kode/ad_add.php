<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    
    $customers = $conn->query("SELECT * FROM customers ORDER BY name ASC");

    $groups = $conn->query("SELECT * FROM groups ORDER BY name ASC");

    $name = $_POST["adname"];
    $customer_id = $_POST["customer_id"];
    $group_id = $_POST["group_id"];

    
    if ( $name && $customer_id && $group_id) {

        move_uploaded_file($_FILES["ad_file"]["tmp_name"], "ads/" . $_FILES["ad_file"]["name"]);


        $conn->query("INSERT INTO ads (ad_name, file_name, customer_id, group_id) VALUES('". $name ."', '". $_FILES["ad_file"]["name"] ."', '". $customer_id ."', '". $group_id ."')");
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
                                        <li><i class="fa fa-home"></i><a href="#">Home</a></li>
                                        <li><a href="ads.php">Ads</a></li>   
                                        <li class="active">Add ad</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h2>Ad</h2>
                                    <em>Add an ad</em>
                                </div>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-picture-o"></i> Add ad</h3>
                                                </div>
                                                <div class="widget-content">
                                                    <form role="form" method="post" action="ad_add.php" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Ad name</label>
                                                            <input type="text" class="form-control" name="adname" id="adname" placeholder="Ad name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Customer name</label>
                                                            <select class="form-control" name="customer_id">
<?php
    foreach($customers as $customer) {
        echo "<option value='". $customer["id"] ."'>". $customer["name"] ."</option>";
    }
?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Group name</label>
                                                            <select class="form-control" name="group_id">
<?php
    foreach($groups as $group) {
        echo "<option value='". $group["id"] ."'>". $group["name"] ."</option>";
    }
?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">File input</label>
                                                            <input type="file" id="exampleInputFile" name="ad_file">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    </body>
</html>