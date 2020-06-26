<?php
session_start();
if (!isset($_SESSION['AdminisLoggedIn']) || $_SESSION['AdminisLoggedIn'] != true)
{
	header("Location: login.php");
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Admin</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>

  <div id="banner">
    <img src="admin.png" style="position: center;">
  </div>
  </br>




  <li style="margin-bottom: 10px;list-style: none;display: inline-block;margin: 0px 30px 0px 30px"><a href="#"><button
        type="button" class="btn btn-primary" id="btn1"> List User</button></a></li>

  <li style="margin-bottom: 10px;list-style: none;display: inline-block;margin: 0px 30px 0px 30px"><a href="#"><button
        type="button" class="btn btn-secondary" id="btn2"> Admin Setting </button></a></li>

  <li style="margin-bottom: 10px;list-style: none;display: inline-block;margin: 0px 30px 0px 30px"><a href="login.php"><button
        type="button" class="btn btn-danger"> Back to Login </button></a></li>
  </br></br>
  <form action="" method="post" style="overflow: scroll; height: 400px;display: none;" id="ad1">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="panel panel-default panel-table">
            <div class="panel-heading">
              <div class="row">
                <div class="col col-xs-6">
                  <h3 class="panel-title">List User</h3>
                </div>
                <div class="col col-md-10 text-right">

                </div>
              </div>
            </div>

            <div class="panel-body">
              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>
                    
                    <th class="hidden-xs" style="text-align: center;">Username</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Ban</th>
                    <th ><em class="fa fa-cog"></em>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td style="text-align:center;">asdasd</td>
                    <td style="text-align:center;">asdasdasd</td>
                    <td align="center">
                      <a class="btn btn-danger">
                        <em class="fa fa-trash">
                          Ban
                        </em>
                      </a>
                    </td>
                    <td align="center">
                      <a class="btn btn-danger">
                        <em class="fa fa-trash">
                          Delete Account
                        </em>
                      </a>
                    </td>          
                  </tr> -->

                  <?php
                    require('conn.php');

                    $sql = "SELECT * FROM usertable WHERE NOT username = 'admin' ";
                    $result = $conn->query($sql);
                    if($result->num_rows >0){
                      while($row = $result->fetch_assoc()){
                  ?>
                  <tr>
                    <td style="text-align:center;"><?=$row['username'] ?></td>
                    <td style="text-align:center;"><?=$row['Status'] ?></td>
                    <td align="center">
                      <a class="btn btn-danger btn-ban">
                        <em class="fa fa-trash">
                          Ban
                        </em>
                      </a>
                    </td>
                    <td align="center">
                      <a class="btn btn-danger btn-del">
                        <em class="fa fa-trash">
                          Delete Account
                        </em>
                      </a>
                    </td>
                  </tr>
                      <?php }
                    }
                    ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>


  <form action="limittext.php" method="post" id="ad2" style="display:none; border: 100px 100px 100px 100px solid red">
    <h3><b>Setting</b></h3>
    Giới hạn kí tự: <input  type="text" name="limittext" style="width: 100px"> 
    
    <button  type="submit" name="submitlimit">Confirm</button>

  <div id="footer">Created By 51703037 - 51703137</div>


  <script language="javascript">

    document.getElementById("btn1").onclick = function () {
      document.getElementById("ad1").style.display = 'block';
      if (document.getElementById("ad2").style.display == 'block') {
        document.getElementById("ad2").style.display = 'none';
      }
    };

    document.getElementById("btn2").onclick = function () {
      document.getElementById("ad1").style.display = 'none';
      if (document.getElementById("ad1").style.display == 'none') {
        document.getElementById("ad2").style.display = 'block';
      }
    };



  </script>
  <script>
$('.table-bordered').on('click','.btn-ban',function(){
                        var currow = $(this).closest('tr');
                        var colUsername = currow.find('td:eq(0)').text();
                        var colStatus = currow.find('td:eq(1)').text();
                        // console.log(colUsername);
                        // console.log(colStatus);
                        //var result = colFrom +'\n' +colTitle+'\n'+colMessage+'\n'+colTime;
                        // currow.remove();
                        if(!(colStatus == 'Banned')){
                          $.ajax({
                            // URL File se nhan ajax de xy ly
                            url: 'functions3.php',
                            datatype: 'text',
                            type: 'post',
                            data: {
                                // action: dat ten de phan biet cac action khac nhau.
                                'action': 'ban_account',
                                'colUsername': colUsername,
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                            console.log("err" + textStatus, errorThrown);
                            }
                            
                        });
                        location.reload(true);
                        }else{
                            alert('Already Banned');
                        }
                    });
                    $('.table-bordered').on('click','.btn-del',function(){
                        var currow = $(this).closest('tr');
                        var colUsername = currow.find('td:eq(0)').text();
                        var colStatus = currow.find('td:eq(1)').text();
                        //var result = colFrom +'\n' +colTitle+'\n'+colMessage+'\n'+colTime;
                        currow.remove();
                            $.ajax({
                              // URL File se nhan ajax de xy ly
                              url: 'functions3.php',
                              datatype: 'text',
                              type: 'post',
                              data: {
                                  // action: dat ten de phan biet cac action khac nhau.
                                  'action': 'delete_account',
                                  'colUsername': colUsername,
                              },
                              success: function (response) {
                                  console.log(response);
                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                              console.log("err" + textStatus, errorThrown);
                              }
                          });
                    });   
  </script>

</body>

</html>