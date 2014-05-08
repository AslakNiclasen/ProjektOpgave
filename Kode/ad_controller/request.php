<?php
    require_once("connect.php");
 
    $access_token = "S#0#7,SIdRf#HS%1nhBd";
    $site_name = "";
    $referer = $_SERVER["HTTP_REFERER"];    
    $ads_array = [];
    
    $ads = $conn->query("SELECT file_name FROM ads WHERE customer_id = (SELECT id FROM customers WHERE access_token = '". $access_token ."') ");
    
    while($row = $ads->fetch_row()){
        array_push($ads_array, $row[0]);
    }
    
    if (substr($referer, 0, 6) == "http://") {
        $slash_pos = strpos($referer, "/", 7);
        $site_name = substr($referer, 7, $slash_pos);
    } else if (substr($referer, 0, 3) == "www.") {
        $slash_pos = strpos($referer, "/", 4);
        $site_name = substr($referer, 4, $slash_pos);
    } else if (substr($referer, 0, 10) == "http://www.") {
        $slash_pos = strpos($referer, "/", 11);
        $site_name = substr($referer, 11, $slash_pos);
    } else {
        echo "wrong source path";   
    }

    echo json_encode($ads_array);
?>