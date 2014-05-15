<?php
    require_once("include/common_includes.php");
    
    $admins = $conn->query("SELECT * FROM admins ORDER BY name ASC");
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
                                        <li class="active">Admins</li>                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Admins</h1>
                                </div>

                                <a href="admin_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Create admin</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-user"></i> Admins</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($admins->num_rows <= 0) {
        echo "No admins created yet. Create your first admin by clicking <a href='admin_add.php'>here</a>";
    } else {
?>
                                                    <table class="table">

                                                        <tr>
                                                            <th>
                                                                Name
                                                            </th>
                                                            <th>
                                                                Email
                                                            </th>
                                                            <th>
                                                                Last login
                                                            </th>
                                                        </tr>                                           
<?php
        foreach($admins as $admin){
            echo "<tr>";
            echo "<td>" . $admin["name"] . "</td>";
            echo "<td>" . $admin["email"] . "</td>";
            echo "<td>" . date("d-m-Y H:i:s", strtotime($admin["last_login"])) . "</td>";
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
    </body>
</html>