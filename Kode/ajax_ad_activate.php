<?php
    require_once("include/common_includes.php");
    
    $id = $_POST["ad_id"];
    $on_or_off = $_POST["on_or_off"];
    
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
?>