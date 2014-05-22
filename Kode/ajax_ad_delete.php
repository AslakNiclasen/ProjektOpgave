<?php
    require_once("include/common_includes.php");
    
    $id = $conn->real_escape_string(@$_POST["id"]);

	if(is_numeric($id)) {

	    if ($conn->query("DELETE FROM ads WHERE id = '". $id ."'")) {
	        $response = json_encode(array("status" => "OK", "msg" => "The ad is now deleted"));
	    } else {
	        $response = json_encode(array("status" => "NOT_OK", "msg" => "Failed to delete the ad"));
	    }
	    
	    echo $response;
	}
?>