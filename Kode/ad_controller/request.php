<?php
    require_once("connect.php");
    require_once("show_ad.php");
    
    //echo "Du kom fra: ". $_SERVER["HTTP_REFERER"];
<<<<<<< HEAD
=======

    $referer = $_SERVER["HTTP_REFERER"];

    if (substr($referer, 0, 6) == "http://") {

    }

    if (substr($referer, 0, 3) == "www.") {

    }
>>>>>>> 26562f44f963edf5d0ab293d3424e0769ce6dede

    $referer = $_SERVER["HTTP_REFERER"];
    
    $site_name = "";

    if (substr($referer, 0, 6) == "http://") {
        $slash_pos = strpos($referer, "/", 7);
        $site_name = substr($referer, 7, $slash_pos);
    }
    else if (substr($referer, 0, 3) == "www.") {
        $slash_pos = strpos($referer, "/", 4);
        $site_name = substr($referer, 4, $slash_pos);
    }
    else if (substr($referer, 0, 10) == "http://www.") {
        $slash_pos = strpos($referer, "/", 11);
        $site_name = substr($referer, 11, $slash_pos);
    }
    else echo "wrong source path";
    //$ads = $conn->query("SELECT * FROM ads WHERE id = '5'")->fetch_array();
    
    //echo $ads["file_name"];
?>