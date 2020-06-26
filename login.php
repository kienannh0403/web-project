<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content=""> 
    
</head>


<style type="text/css">
  form {
    box-sizing: border-box;
    width: 260px;
    margin: 100px auto 0;
    box-shadow: 2px 2px 5px 1px rgba(0, 0, 0, 0.2);
    padding-bottom: 30px;
    border-radius: 3px;
    background-color: white;
  }

  form h1 {
    box-sizing: border-box;
    padding: 20px;
  }
  form label{
    padding: 15px;
  }

  input {
    margin: 10px 25px;
    width: 170px;
    display: block;
    border: none;
    padding: 5px 0;
    border-bottom: solid 1px #1abc9c;
    transition: all 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 96%, #1abc9c 4%);
    background-position: -200px 0;
    background-size: 150px 100%;
    background-repeat: no-repeat;
    color: gray;
  }

  input:focus,
  input:valid {
    box-shadow: none;
    outline: none;
    background-position: 0 0;
  }

  input:focus::-webkit-input-placeholder,
  input:valid::-webkit-input-placeholder {
    color: #1abc9c;
    font-size: 11px;
    transform: translateY(-20px);

  }

  button {
    border: none;
    background: #1abc9c;
    cursor: pointer;
    border-radius: 3px;
    padding: 6px;
    width: 200px;
    color: white;
    margin-left: 25px;
    box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.2);
  }

  button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.2);
  }
</style>

<body background="loginbackground.png">

  <form action="" method="post">
    <h1>Login</h1>
    <div class="form-group">     
      <label>Username:</label>
      <input type="text" name="user" class="form-control"  autofocus="" required=""></br>
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password" placeholder="Password" class="form-control"  required="">
    </div>
    <?php
    session_start();
    if(isset($_POST['user']) && isset($_POST['password'])){
      require_once('conn.php');
      
      $username = $_POST['user'];
      
      $sql = "SELECT * FROM usertable WHERE username = '$username'";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();

      if(!(trim($username) == 'admin' && trim($_POST['password']) == 'administrator')){
        if($_POST['password'] == $row['password']){

            if($row['Status'] != "Banned"){
              $_SESSION['username']=$username;
            $_SESSION['isLoggedIn']=true;
            header("Location: mail.php");
            }else{
              echo "<script type='text/javascript'>alert('Your Account has been banned . Contact Admin for more information');
          window.location.href = 'login.php';
          </script>";
            }
        }else{
          echo "<script type='text/javascript'>alert('Invalid username or password');
          window.location.href = 'login.php';
          </script>";
        }
      }else{
        $_SESSION['username']=$username;
        $_SESSION['AdminisLoggedIn']=true;
        header("Location: admin.php");
      }
    }
    ?>
    <button  type="submit">Sign in</button></br>
    
    <p align="center">If you don't have exist account </br>   
      <a href="regis.php">Click here</a></p>
  </form>
</body>

</html>