<?php
    //$access_token = $_GET["access_token"];

	$access_token = "S#0#7,SIdRf#HS%1nhBd";

    $ads = $conn->query("SELECT file_name FROM ads WHERE customer_id = (SELECT id FROM customers WHERE access_token = '". $access_token ."') ");

    $ads_array = array("piss" => "haha");

    while($row = $ads->fetch_row()){
        $tmp_array = array("reklame" => $row[0]);
        $ads_array = array_merge($ads_array, $tmp_array);

    	//array_push($ads_array, $row[0]);
    }

    echo json_encode($ads_array);
?>
