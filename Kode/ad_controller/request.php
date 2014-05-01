<?php
    require_once("connect.php");
    require_once("show_ad.php");
    
    //echo "Du kom fra: ". $_SERVER["HTTP_REFERER"];

    $referer = $_SERVER["HTTP_REFERER"];

    if (substr($referer, 0, 6) == "http://") {

    }

    if (substr($referer, 0, 3) == "www.") {

    }

    //$ads = $conn->query("SELECT * FROM ads WHERE id = '5'")->fetch_array();
    
    //echo $ads["file_name"];
?>