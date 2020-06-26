<?php

// Kiem tra action can xu ly
$action = isset($_POST['action']) && $_POST['action'] != '' ? $_POST['action'] : '';
$colFrom = $_POST['IDfrom'];
$colTitle = $_POST['Title'];
$colMessage = $_POST['Message'];
$colTime = $_POST['Time'];
session_start();
$colTo = $_SESSION['username'];

// Xu ly action 
if($action == 'delete_message'){
    require('conn.php');

    $sql = "DELETE FROM usermessage WHERE IDfrom = '$colFrom'
                                    AND     IDto = '$colTo'
                                    AND     TIME = '$colTime'
                                    ";
        
                                
    $result = $conn->query($sql);

}
die()
?>