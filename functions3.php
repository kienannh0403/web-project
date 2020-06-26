<?php

// Kiem tra action can xu ly
$action = isset($_POST['action']) && $_POST['action'] != '' ? $_POST['action'] : '';
$colUsername = $_POST['colUsername'];

// Xu ly action 
if($action == 'ban_account'){
    require('conn.php');

    $sql = "UPDATE usertable SET Status='Banned' WHERE username='$colUsername' ";
        
                                
    $result = $conn->query($sql);

}else if($action == 'delete_account'){
    require('conn.php');

    $sql = "DELETE FROM usertable WHERE username ='$colUsername' ";       
                                
    $result = $conn->query($sql);
}
die()
?>