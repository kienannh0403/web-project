<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'userregistration';

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die($conn->connect_error);
    }
?>