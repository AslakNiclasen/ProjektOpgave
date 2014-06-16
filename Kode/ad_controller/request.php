<?php
    require_once("connect.php");
    require_once("../include/timezone.php");
 
    //Declaring all variables used in system
    $access_token = $_GET["access_token"];  //Access-token
    $site_name = "";                        //The site name from HTTP referer
    $referer = @$_SERVER["HTTP_REFERER"];   //HTTP referer
    $ads_array = array();                   //Array to hold ads

    //Checking for access-token
    if (!$access_token || $access_token = "" || strlen($access_token) != 20) {
        //Showing error message
        $status = array("status" => "NO_ADS");
        
        //Temporary access token for testing.
        //$access_token = "WvcZA&ulOhOjk3M5ZxHH";
    }
    
    //Getting site name from HTTP REFERER
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
        $status = array("status" => "NO_ADS");
    }

    //Checking to see if site name and access-token match
    if ($status["status"] != "NO_ADS") {
        //Fething url and matching access-token
        $legal_site = $conn->query("SELECT url FROM sites WHERE access_token = '". $access_token ."'");

        if ($legal_site->num_rows > 0) {
            //We have a legal site and we're going to show ads
            $today_timestamp = date("Y-m-d H:i:s", time());
            
            //Querying all ads for the appropriate site
            $ads = $conn->query("SELECT * 
                                 FROM ads 
                                 WHERE site_id = (SELECT id FROM sites WHERE access_token = '". $access_token ."') 
                                    AND ad_deadline > '". $today_timestamp ."'
                                    OR ad_deadline = '0000-00-00 00:00:00'
                                    AND number_of_impressions < max_impressions
                                 ");
                                 
            //Updating impressions on the selected ads
            foreach ($ads as $ad) {
                $conn->query("UPDATE ads SET number_of_impressions = number_of_impressions+1 WHERE id = '". $ad["id"] ."'");
            }

            //Constructing JSON-response
            if ($ads->num_rows <= 0) {
                //No ads have been created for the site
                $status = array("status" => "NO_ADS");
            } else {
                $status = array("status" => "MANY_ADS");
                
                //Filling array with ads
                foreach ($ads as $ad) {
                    array_push($ads_array, array("file_name" => $ad["file_name"], "group_id" => $ad["group_id"], "customer_id" => $ad["customer_id"]));
                }
            }
        } else {
            $status = array("status" => "NO_ADS");
        }
    }

    //JSON Response to request    
    $response_array = array($status, $ads_array);

    /*
    echo "<pre>";
    print_r($response_array);
    echo "</pre>";
    
    echo "<pre>";
    print_r(json_encode($response_array));
    echo "</pre>";
    
    echo "<pre>";
    print_r(json_decode(json_encode($response_array)));
    echo "</pre>";
    */
?>