<?php
    require_once("include/session.php");
    require_once("include/security.php");
    require_once("include/connect.php");
    require_once("include/timezone.php");
    
    $customer_id = $_GET["customer_id"];
    
    $groups = $conn->query("SELECT id, name FROM groups WHERE customer_id = '". $customer_id ."'");
    
    foreach ($groups as $group) {
        echo "<option value='". $group["id"] ."'>". $group["name"] ."</option>";
    }
?>