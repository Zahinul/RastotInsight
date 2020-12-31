<?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = '';

    $conn = new mysqli($host, $user, $pass, $db_name);

    if($conn->connect_error){
        die('Database Connection Error: ' . $conn->connect_error);
    }else{
        //echo 'Database connection established.';
    }

    
?>