<?php

$limit = $_POST['limittext'];
$id = 'limit';
if($limit == ''){
    echo "<script type='text/javascript'>alert('Please fill in limit characters of message');
        window.location.href = 'admin.php';
        </script>";     
}
if(!(is_numeric($limit))){
    echo "<script type='text/javascript'>alert('This is not a number');
window.location.href = 'admin.php';
    </script>";   
}
if($limit){
    if($limit < 20){
        echo "<script type='text/javascript'>alert('The limit is too short . It should be larger than 20 characters');
window.location.href = 'admin.php';
    </script>";   
    }
    require_once('conn.php');

    $sql = "SELECT * FROM limit_textmessage";
    $result = $conn->query($sql);
    if($result->num_rows >0){
        $sql1 = "UPDATE limit_textmessage SET limit_num=$limit WHERE id='limit'";
        $result1= $conn->query($sql1);
    }else{
        $sql2 = "INSERT INTO limit_textmessage(id, limit_num) VALUES(?, ?)";
        $stmt = $conn->prepare($sql2);
        $stmt->bind_param("ss",$id,$limit);
        $isOK=$stmt->execute();
        $stmt->close();
        $conn->close();
    }

    echo "<script type='text/javascript'>alert('Set limit successful');
window.location.href = 'admin.php';
    </script>";   
    
}

?>
