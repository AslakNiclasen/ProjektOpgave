<?php
    require_once("connect.php");
    require_once("../include/timezone.php");
 
    //Declaring all variables used in system
    $access_token = "4NP/4LjRcJA8oc3C0ygR";
    $site_name = "";
    $referer = @$_SERVER["HTTP_REFERER"];    
    $ads_array = array();
    $today_timestamp = date("Y-m-d H:i:s", time());
    
    //Querying all ads for the appropriate customer
    $ads = $conn->query("SELECT * 
                         FROM ads 
                         WHERE customer_id = (SELECT id FROM customers WHERE access_token = '". $access_token ."') 
                            AND ad_deadline > '". $today_timestamp ."'
                            OR ad_deadline = '0000-00-00 00:00:00'
                            AND number_of_impressions < max_impressions
                         ");
                         
    //Adding impression to the selected ads
    foreach ($ads as $ad) {
        $conn->query("UPDATE ads SET number_of_impressions = number_of_impressions+1 WHERE id = '". $ad["id"] ."'");
    }

    
    
    if ($ads->num_rows <= 0) {
        echo "No ads found<br>";
    } else {
        echo "A lot of ads found<br>";
    }
    
    foreach ($ads as $ad) {
        array_push($ads_array, $ad["file_name"]);
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
        echo "wrong source path<br>";   
    }

    echo json_encode($ads_array);
?>