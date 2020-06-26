<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Register</title>
  <meta charset="utf-8">
</head>
<style type="text/css">
  form {
    box-sizing: 200px 100px;
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
    margin: 15px 20px;
    width: 200px;
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

  .box {
    text-align: center;
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
  <form action="registration.php" method="post">
    <h1>Register</h1>
    <p style="margin: 10px">
      <div class="form-group">
        <label>Username:</label>
        <input type="text" name="user"  autofocus="" required=""></br>
      </div>
      <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" required=""></br>
      </div>
      <div class="form-group">
        <label>Re-enter Password:</label>
        <input type="password" name="repassword" required=""></br>
      </div>
      <p align="center">Already have account? </br>   
      <a href="login.php">Click here</a></p>
    <button type="submit" >Register</button>
  </form>
</body>

</html>