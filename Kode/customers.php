<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");
    
    $customers = $conn->query("SELECT * FROM customers ORDER BY name ASC");
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
                                        <li class="active">Sites</li>                             
                                    </ul>
                                </div>
                            </div>


                            <!-- main -->
                            <div class="content">
                                <div class="main-header">
                                    <h1>Sites</h1>
                                </div>

                                <a href="customer_add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Create site</a>
                                <br>
                                <br>

                                <div class="main-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- INPUT GROUPS -->
                                            <div class="widget">
                                                <div class="widget-header">
                                                    <h3><i class="fa fa-group"></i> Sites</h3>
                                                </div>
                                                <div class="widget-content">
<?php
    if ($customers->num_rows <= 0) {
        echo "No sites created yet. Create your first site by clicking <a href='customer_add.php'>here</a>";
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
                                                                &nbsp;
                                                            </th>
                                                        </tr>                              
<?php
        foreach($customers as $customer){
            echo "<tr>";
            echo "<td><a href='customer_edit.php?id=". $customer["id"] ."' title='Edit customer'>" . $customer["name"] . "</a></td>";
            echo "<td>" . $customer["url"] . "</td>";
            echo "<td>" . $customer["access_token"] . "</td>";
            echo "<td><a href='customer_edit.php?id=". $customer["id"] ."'><i class='fa fa-wrench' title='Edit customer'></i></a> &nbsp;&nbsp;&nbsp;&nbsp; <i class='fa fa-trash-o' id='customer_delete_". $customer["id"] ."' title='Delete customer'></i></td>";
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
        <script>
            $(document).ready(function() {
                $("i, a").tooltip();
                
                $("i[id^='customer_delete_']").click(function() {
                    var id = $(this).attr("id").split("_")[2];
                    
                    console.log(id);
                    
                    /*
                    $.post("ajax_customer_delete.php", { id: id }, function(response) {
                        console.log(response);
                    });
                    */
                });
            });
        </script>
    </body>
</html>