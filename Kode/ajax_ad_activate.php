<?php
    require_once("include/common_includes.php");
    
    $id = $conn->real_escape_string($_POST["ad_id"]);
    $on_or_off = $conn->real_escape_string($_POST["on_or_off"]);

    if(is_numeric($id) && is_numeric($on_or_off)) {
    
        if ($conn->query("UPDATE ads SET ad_active = '". $on_or_off ."' WHERE id = '". $id ."'")) {
            if ($on_or_off == 1) {
                $response = json_encode(array("status" => "OK", "msg" => "The ad is now activate"));
            } else {
                $response = json_encode(array("status" => "OK", "msg" => "The ad is now deactivated"));
            }
        } else {
            $response = json_encode(array("status" => "NOT_OK", "msg" => "There was an error!"));
        }
        
        echo $response;
    }
?>