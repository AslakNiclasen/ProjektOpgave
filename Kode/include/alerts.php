<?php
    if (@$_SESSION["status"] == "OK") {
        echo "<div class='alert alert-success' id='feedback_status'>";
            echo "<div class='text-center' id='feedback_msg'>";
                echo "<strong>". @$_SESSION["msg"] ."</strong>";
            echo "</div>";
        echo "</div>";
    } else if (@$_SESSION["status"] == "NOT_OK") {
        echo "<div class='alert alert-danger' id='feedback_status'>";
            echo "<div class='text-center' id='feedback_msg'>";
                echo "<strong>". @$_SESSION["msg"] ."</strong>";
            echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='alert hidden' id='feedback_status'>";
            echo "<div class='text-center' id='feedback_msg'>";
                echo "<strong></strong>";
            echo "</div>";
        echo "</div>";
    }
    
    $_SESSION["status"] = "";
    $_SESSION["msg"] = "";
?>