<?php
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function sanitize($string, $db) {
    	return $db->real_escape_string($string);
    }

    function flash_message($status, $msg) {
        $_SESSION["status"] = $status;
        $_SESSION["msg"] = $msg;
    }

    function showArray($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
?>