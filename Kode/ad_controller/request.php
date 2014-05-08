<?php
    require_once("connect.php");
    require_once("../include/timezone.php");
 
    //Declaring all variables used in system
    $access_token = $_GET["access_token"];
    if (!$access_token || $access_token = "" || strlen($access_token) != 20) {
        //Set temporary access token
        $access_token = "WvcZA&ulOhOjk3M5ZxHH";
        //$access_token = "4NP/4LjRcJA8oc3C0ygR";
    }
    
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

    
    //Constructing JSON-response
    if ($ads->num_rows <= 0) {
        $status = array("status" => "NO_ADS");
    } else {
        $status = array("status" => "MANY_ADS");
        
        $ads_array = array();
        foreach ($ads as $ad) {
            array_push($ads_array, array("file_name" => $ad["file_name"], "group_id" => $ad["group_id"], "customer_id" => $ad["customer_id"]));
        }
    }
    
    $response_array = array($status, $ads_array);
    
    $site_name = "";
    $referer = @$_SERVER["HTTP_REFERER"];
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

    echo "<pre>";
    print_r($response_array);
    echo "</pre>";
    
    echo "<pre>";
    print_r(json_encode($response_array));
    echo "</pre>";
    
    echo "<pre>";
    print_r(json_decode(json_encode($response_array)));
    echo "</pre>";
?>