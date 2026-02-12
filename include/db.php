<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "medical";

    $conn = new mysqli($host, $user, $password, $dbname);
    $conn->set_charset("utf8");
?>