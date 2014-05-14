<?php
    require_once("include/common_includes.php");
    
    $site_id = $_GET["site_id"];
    
    $zones = $conn->query("SELECT id, name FROM zones WHERE site_id = '". $site_id ."'");
    
    foreach ($zones as $zone) {
        echo "<option value='". $zone["id"] ."'>". $zone["name"] ."</option>";
    }
?>