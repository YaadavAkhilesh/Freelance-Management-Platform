<?php
    $srvrnm = "localhost";
    $usrnm = "root";
    $passwd = "";
    $dbnm = "frelaxDB";

    $conn = new mysqli($srvrnm , $usrnm , $passwd , $dbnm);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $dbmessage = "Connected successfully to the database : " . $dbnm;
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
?>