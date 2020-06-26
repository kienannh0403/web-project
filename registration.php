
<?php 
    require_once('conn.php');

    $username = $_POST['user'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $status='available';
    function valid_email($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
    
    if(!valid_email($username)){
    echo "<script type='text/javascript'>alert('Invalid username. It must be example@email.com');
        window.location.href = 'regis.php';
    </script>";
    }
    if(strlen($password) < 6){
    echo "<script type='text/javascript'>alert('Password much contains at least 6 characters');
        window.location.href = 'regis.php';
    </script>";
    }

    if($password == $repassword){
        $sql = "INSERT INTO usertable(username, password , Status) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",$username, $password,$status);

        $isOK = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        if($isOK){
            echo "<script type='text/javascript'>alert('Registration Successful');
            window.location.href = 'login.php';
            </script>";
        }else{
            echo "<script type='text/javascript'>alert('Username already taken');
            window.location.href = 'regis.php';
            </script>";
        }    
    }else{
        echo "<script type='text/javascript'>alert('Two password do not match');
        window.location.href = 'regis.php';
        </script>";       
    }
    
?>

