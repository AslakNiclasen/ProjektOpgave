<?php
    require_once("connect.php");
    
    echo "Du kom fra: ". $_SERVER["HTTP_REFERER"];

    //$ads = $conn->query("SELECT * FROM ads WHERE id = '5'")->fetch_array();
    
    //echo $ads["file_name"];
?>