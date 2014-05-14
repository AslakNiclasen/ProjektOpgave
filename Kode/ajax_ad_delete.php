<?php
    require_once("include/common_includes.php");
    
    $id = @$_POST["id"];
    
    if ($conn->query("DELETE FROM ads WHERE id = '". $id ."'")) {
        $response = json_encode(array("status" => "OK", "msg" => "The ad is now deleted"));
    } else {
        $response = json_encode(array("status" => "NOT_OK", "msg" => "Failed to delete the ad"));
    }
    
    echo $response;
?>