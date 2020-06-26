<?php

// Kiem tra action can xu ly
$action = isset($_POST['action']) && $_POST['action'] != '' ? $_POST['action'] : '';
$colTo = $_POST['IDto'];
$colTitle = $_POST['Title'];
$colMessage = $_POST['Message'];
$colTime = $_POST['Time'];
session_start();
$colFrom = $_SESSION['username'];

// Xu ly action 
if($action == 'delete_messagesent'){
    require('conn.php');

    $sql = "DELETE FROM usermessage WHERE IDfrom = '$colFrom'
                                    AND     IDto = '$colTo'
                                    AND     TIME = '$colTime'
                                    ";
        
                                
    $result = $conn->query($sql);

}
die()
?>