<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");
    
    $id = $_POST["ad_id"];
    $on_or_off = $_POST["on_or_off"];
    
    $conn->query("UPDATE ads SET ad_active = '". $on_or_off ."' WHERE id = '". $id ."'");
    
    echo "success";
?>