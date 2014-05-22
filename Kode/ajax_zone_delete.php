<?php
    require_once("include/common_includes.php");
    
    $id = $conn->real_escape_string(@$_POST["id"]);
    
    if(is_numeric($id)) {
        
        //First we delete all ads associated with the zone
        $ads = $conn->query("SELECT * FROM ads WHERE zone_id = '". $id ."'");
        foreach($ads as $ad) {
            $conn->query("DELETE FROM ads WHERE id = '". $ad["id"] ."'");
        }
        
        //Then we delete the zone
        if ($conn->query("DELETE FROM zones WHERE id = '". $id ."'")) {
            $response = json_encode(array("status" => "OK", "msg" => "The zone is now deleted"));
        } else {
            $response = json_encode(array("status" => "NOT_OK", "msg" => "Failed to delete the zone"));
        }
        
        echo $response;
    }
?>