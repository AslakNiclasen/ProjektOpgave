<div class="top-bar">
    <div class="container">
        <div class="row">
            <!-- logo -->
            <div class="col-md-2 logo">
                <a href="index.php">
                    <img src="assets/img/easyad-logo.png">
                </a>
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
                                        <span class="name" style="font-size: 14px;"><?php echo @$_SESSION["user_name"]; ?></span>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="logout.php">
                                                <i class="fa fa-power-off"></i> 
                                                <span class="text" style="font-size: 14px;">Logout</span>
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