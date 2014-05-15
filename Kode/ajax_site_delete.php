<?php
    require_once("include/common_includes.php");
    
    $id = $conn->real_escape_string(@$_POST["id"]);
    
    if(is_numeric($id)) {
        
        //First we delete all zones associated the the site
        $zones = $conn->query("SELECT * FROM zones WHERE site_id = '". $id ."'");
        foreach($zones as $zone) {
            $conn->query("DELETE FROM zones WHERE id = '". $zone["id"] ."'");
        }
        
        //First we delete all ads associated with the site
        $ads = $conn->query("SELECT * FROM ads WHERE site_id = '". $id ."'");
        foreach($ads as $ad) {
            $conn->query("DELETE FROM ads WHERE id = '". $ad["id"] ."'");
        }
        
        //Then we delete the site
        if ($conn->query("DELETE FROM sites WHERE id = '". $id ."'")) {
            $response = json_encode(array("status" => "OK", "msg" => "The site is now deleted"));
        } else {
            $response = json_encode(array("status" => "NOT_OK", "msg" => "Failed to delete the site"));
        }
        
        echo $response;
    }
?>