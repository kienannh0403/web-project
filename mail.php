<?php
session_start();
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] != true)
{
	header("Location: login.php");
}
require('conn.php');
//lay limit_num ( limit ki tu cua mail)
$sql = "SELECT limit_num FROM limit_textmessage WHERE id='limit'";
$result = $conn->query($sql);
$row=$result->fetch_assoc();
$_SESSION['limit-text']=$row['limit_num']; // gan gia tri limit vao session 


date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Mail</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous">
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
            
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .trhover:hover{
            background-color:#DCDCDC;
            cursor: pointer;
            box-shadow: 5px 5px 5px grey;
        }
        td{
            overflow: hidden;
        }
    </style>
</head>


<body>


    <img src="New Project.png" class="center">

    </div>
    <div id="menu_top">
        <ul>
            <li><a href="mail.php" title="Trang Chủ" id="btn">Trang Chủ</a></li>

            


            

            <li style="padding-left: 1008px"> </li>

            <li class="nav-item dropdown">
                <a style="align-content: right"  class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <?php
                        $username = $_SESSION['username'];
                        echo $username; 
                    ?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Log Out</a>

                </div>
            </li>
        </ul>
    </div>
    <div id="main">
        <div id="left">


            <div id="content" style="border: solid 1px; padding: 20px; background: #ddd;display: none">
                <form action="" method="post">
                    <lable> To: </lable>
                    <input type="text" id="compose-to" name="Message-to"><p id="alert-messageto" style="color:red; display:none">Please fill in a email address</p>
                    <hr>
                    <lable> Title </lable>
                    <input type="text" id="compose-title" name="Message-title">
                    <hr>    
                    <label for="comment">Message</label>
                    <textarea maxlength="<?php echo $_SESSION['limit-text'];//lay gia tri limit message tu session ra ?>" class="form-control" rows="5" id="comment" name="Message-input"></textarea>
                    <hr>
                    
                    
                    <button type="submit" name="submit" id='sendbtn'>Send</button>
                    <?php 
                    if(isset($_POST['submit'])){
                        require_once('conn.php');
                        //lay cac bien tu trong session va post tu from
                        $Message_From = $_SESSION['username'];
                        $Message_To = $_POST['Message-to'];
                        $Message_Title = $_POST['Message-title'];
                        $Message_Input = $_POST['Message-input'];
                        $datetime = date('Y-m-d H:i:s');

                        // tao du lieu da nhan vao trong database
                        $sql = "INSERT INTO usermessage(IDfrom, IDto, title, Message, Time) VALUES(?, ?, ?, ?, ?)";// cau lenh truyen du lieu vao database
                        $stmt = $conn->prepare($sql);//prepare cau lenh
                        $stmt->bind_param("sssss",$Message_From,$Message_To,$Message_Title,$Message_Input,$datetime);//gan bien
                        $isOK = $stmt->execute();//thuc thi
                        $stmt->close();//dong ket noi
                        $conn->close();
                        
                    }
                    
                    ?>
                </form>
            </div>
            
            <div id="mailshow" style="border: solid 1px; padding: 20px; background: #ddd;display: none; width: 100%" >
            <form>
                    <button id="back"><b><</b></button>
                    <hr>
                    
                    <lable> From: </lable>
                    <input type="text" name="Message-from" id="Message-from" READONLY disabled>
                    <hr>
                    <lable> To: </lable>
                    <input type="text" name="Message-to" id="Message-to" READONLY disabled>
                    <hr>
                    <lable> Title </lable>
                    <input type="text" name="Message-title" id="Message-title" READONLY disabled>
                    <hr>    
                    <label for="comment">Message</label>
                    <textarea class="form-control" rows="5" id="Message-view" name="Message-view" READONLY></textarea>
                    <hr>
                    
                    
                    <button type="submit" name="submit" id='replybtn'>Reply</button>
                </form>

            </div> 
            <div id="mailshow2" style="border: solid 1px; padding: 20px; background: #ddd;display: none; width: 100%" >
            <form>
                    <button onclick="back2()"><b><</b></button>
                    <hr>
                    
                    <lable> From: </lable>
                    <input type="text" name="Message-from" id="Message-from2" READONLY disabled>
                    <hr>
                    <lable> To: </lable>
                    <input type="text" name="Message-to" id="Message-to2" READONLY disabled>
                    <hr>
                    <lable> Title </lable>
                    <input type="text" name="Message-title" id="Message-title2" READONLY disabled>
                    <hr>    
                    <label for="comment">Message</label>
                    <textarea class="form-control" rows="5" id="Message-view2" name="Message-view" READONLY></textarea>
                    <hr>
                    
                    

                </form>

            </div>       
            <div id="content1" style="border: solid 1px; padding: 20px; background: #ddd;display: none; width: 100%" >
                <label>Inbox</label>
                <table id="myTable" class="table"  width="100%" border="1" cellspacing="0" cellpadding="5" style="background-color: white">
                    <tr >
                        <td style="width:200px;max-width:150px;text-align: center;background-color: pink;" ><b>From</b></td>
                        <td style="width:200px;max-width:150px;text-align: center;background-color: pink;"><b>Title</b></td>
                        <td style="max-width:200px;text-align: center;background-color: pink;"><b>Message</b></td>
                        <td style="width:100px;max-width:100px;text-align: center;background-color: pink;"><b>Time</b></td>
                        <td style="width:50px;max-width:100px;text-align: center;background-color: pink;"><b>Delete</b></td>
                    </tr>
                    
                    <?php
                        require('conn.php');

                        $sql = "SELECT * FROM usermessage ORDER BY Time DESC ";
                        $result = $conn->query($sql);
                        if($result->num_rows >0){
                            while($row = $result->fetch_assoc()){
                                if($row['IDto'] == $_SESSION['username']){
                    ?>
                    <tr class="trhover" >
                        <td style="max-width:150px;max-height: 20px;text-align: center;"><?= $row['IDfrom'] ?></td>
                        <td style="max-width:150px;text-align: center;"><?= $row['title'] ?></td>
                        <td style="max-width:600px;text-align: center;"><?= $row['Message'] ?></td>
                        <td style="max-width:150px;text-align: center;"><?= $row['Time'] ?></td>
                        <td ><button type="button" class="btn btn-primary" >X</button></td>
                    </tr>
                                <?php }
                            }
                        }?>   
                </table>
            </div>
            <script>
                    $('.table').on('click','.btn',function(){
                        var currow = $(this).closest('tr');
                        var colFrom = currow.find('td:eq(0)').text();
                        var colTitle = currow.find('td:eq(1)').text();
                        var colMessage = currow.find('td:eq(2)').text();
                        var colTime = currow.find('td:eq(3)').text();
                        //var result = colFrom +'\n' +colTitle+'\n'+colMessage+'\n'+colTime;
                        currow.remove();
                        $.ajax({
                            // URL File se nhan ajax de xy ly
                            url: 'functions.php',
                            datatype: 'text',
                            type: 'post',
                            data: {
                                // action: dat ten de phan biet cac action khac nhau.
                                'action': 'delete_message',
                                'IDfrom': colFrom,
                                'Title': colTitle,
                                'Message': colMessage,
                                'Time':colTime
                            },
                            success: function (response) {
                                console.log("success"+response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                            console.log("err" + textStatus, errorThrown);
                            }
                        });
                    });
                    

                    $('#back').on('click',function(){
                        
                        $('#content1').css("display","block");
                        $('#mailshow').css("display","none");
                        
                    });
                    $('.table tr').on('click',function(){
                        $('#content1').css("display","none");
                        $('#mailshow').css("display","block");
                        var currow = $(this).closest('tr');
                        var colFrom = currow.find('td:eq(0)').text();
                        var colTitle = currow.find('td:eq(1)').text();
                        var colMessage = currow.find('td:eq(2)').text();
                        var colTime = currow.find('td:eq(3)').text();
                        $('#Message-from').val(colFrom);
                        $('#Message-to').val('<?php echo $_SESSION['username']; ?>');
                        $('#Message-title').val(colTitle);
                        $('#Message-view').val(colMessage);

                        $('#replybtn').on('click',function(){
                            $('#content').css("display","block");
                            $('#mailshow').css("display","none");

                            $('#compose-to').val(colFrom);
                        });

                    });
                    function badwords(str){
                        var HaveBadWords = false;
                        var badWords = ['dkm','dmm','dm','vl','vcl','đụ','cc','lz','cặc','concac','con cac','cl','con cặc','cái lồn','lồn'];
                        if(str){
                            for(var i=0;i < badWords.length;i++){
                                HaveBadWords = !!(str.replace(/\W|\s/g, '').toLowerCase().indexOf(badWords[i]) + 1);
                                if(HaveBadWords){
                                    //console.log("có badwords nè");
                                    break;}
                            }
                        }
                        //console.log(HaveBadWords);
                        return HaveBadWords;
                    }
                    $('#sendbtn').hover(
                        function(){
                            var comment = $('#comment').val();
                            if(badwords(comment)){
                                $(this).attr("disabled", true);	
                                //console.log("disabled nè");
                                alert('Your message has bad words, Check it before send');  
                            }
                            // else{
                            //     $(this).removeAttr("disabled");
                            //     console.log("remove nè");
                            // }
                        }
                    );
                    $('#comment').blur(// di chuot ra
                        function(){
                            //console.log("blur ra nè");
                            var comment = $(this).val();
                            if(!badwords(comment)){
                                $('#sendbtn').removeAttr("disabled");
                            }
                        }
                    );
                    
                    // $('#test_btn').on('click',function(){
                    //     console.log('clicked #btn3');
                    //     $.ajax({
                    //         // URL File se nhan ajax de xy ly
                    //         url: 'functions.php',
                    //         datatype: 'text',
                    //         type: 'post',
                    //         data: {
                    //             // action: Minh dat ten de phan biet cac action khac nhau.
                    //             'action': 'new_action',
                    //         },
                    //         success: function (response) {
                    //             console.log('Hanh Dong Thu 1 : '+ response);
                    //             console.log('Gia tri tra ve: '+ response);

                    //         },
                    //     });
                    // });

            // function deleteRow(r) {
            //     var i = r.parentNode.parentNode.rowIndex;
            //     var txt;
            //         if(confirm("Do you want to Delete this mail ?")){
            //             // <?php
            //             //     require('conn.php');

            //             // ?>
                       
            //             document.getElementById("myTable").deleteRow(i);
            //             window.alert('Delete Successful');
            //         }else{
            //             window.alert('Cancel');
            //         }
            // }
               
            
                // $(document).ready(function(){
                //     $(".trhover").click(function(){
                //         alert(<?= $row['IDfrom']?>);
                //     });
                // }); 
                // var findtr = document.getElementById('content1').getElementsByTagName('tr');
                // findtr.style.backgroundColor = red;
            </script>    
            <!-- <?php
                $IDfrom = $_POST['IDfrom'];
                echo "<script type='text/javascript'>alert(''.%);
        
                </script>";
            ?> -->
            
            <div id="content2"  style="border: solid 1px; padding: 20px; background: #ddd;display: none">
                <b>Sent</b>
                <table class="tablesent" border="1" width="100%" cellspacing="0" cellpadding="5" style="background-color: white">
                    <tr>
                        
                        <td style="width:200px;max-width:150px;text-align: center;background-color: pink;" ><b>To</b></td>
                        <td style="width:200px;max-width:150px;text-align: center;background-color: pink;"><b>Title</b></td>
                        <td style="max-width:200px;text-align: center;background-color: pink;"><b>Message</b></td>
                        <td style="width:100px;max-width:100px;text-align: center;background-color: pink;"><b>Time</b></td>
                        <td style="width:50px;max-width:100px;text-align: center;background-color: pink;"><b>Delete</b></td>
                    </tr>
                    <?php
                        require('conn.php');

                        $sql = "SELECT * FROM usermessage ORDER BY Time DESC "; // truy xuat database sap xep theo thoi gian giam dan
                        $result = $conn->query($sql);
                        if($result->num_rows >0){
                            while($row = $result->fetch_assoc()){
                                //echo '<td style="width: 150px;text-align: center;">'.$result->num_rows.'</td>';
                                if($row['IDfrom'] == $_SESSION['username']){
                    ?>
                    <tr class="trhover">
                        
                        <td style="max-width:150px;max-height: 20px;text-align: center;"><?= $row['IDto'] ?></td>
                        <td style="max-width:150px;text-align: center;"><?= $row['title'] ?></td>
                        <td style="max-width:600px;text-align: center;"><?= $row['Message'] ?></td>
                        <td style="max-width:150px;text-align: center;"><?= $row['Time'] ?></td>
                        <td ><button type="button" class="btn btn-primary" >X</button></td>
                    </tr>
                                <?php }
                            }
                        }?>
                </table>
            </div>
            <script>
            $('.tablesent').on('click','.btn',function(){
                        var currow = $(this).closest('tr');
                        var colTo = currow.find('td:eq(0)').text();
                        var colTitle = currow.find('td:eq(1)').text();
                        var colMessage = currow.find('td:eq(2)').text();
                        var colTime = currow.find('td:eq(3)').text();
                        // console.log(colTo);
                        //var result = colFrom +'\n' +colTitle+'\n'+colMessage+'\n'+colTime;
                        currow.remove();
                        $.ajax({
                            // URL File se nhan ajax de xy ly
                            url: 'functions2.php',
                            datatype: 'text',
                            type: 'post',
                            data: {
                                // action: dat ten de phan biet cac action khac nhau.
                                'action': 'delete_messagesent',
                                'IDto': colTo,
                                'Title': colTitle,
                                'Message': colMessage,
                                'Time':colTime
                            },
                            success: function (response) {
                                console.log(response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                            console.log("err" + textStatus, errorThrown);
                            }
                        });
                    });
                    
                    
                    
                    $('.tablesent tr').on('click',function(){ // click vao dong 
                        $('#content2').css("display","none");
                        $('#mailshow2').css("display","block");
                        var currow = $(this).closest('tr');
                        var colTo = currow.find('td:eq(0)').text();
                        var colTitle = currow.find('td:eq(1)').text();
                        var colMessage = currow.find('td:eq(2)').text();
                        var colTime = currow.find('td:eq(3)').text();
                        $('#Message-to2').val(colTo);
                        $('#Message-from2').val('<?php echo $_SESSION['username']; ?>');
                        $('#Message-title2').val(colTitle);
                        $('#Message-view2').val(colMessage);


                        

                    });
                    </script>

            <div id="content3" style="border: solid 1px; padding: 20px; background: #ddd;display: none">
                <b>HỘP THƯ NHÁP</b>
                <table border="1" cellspacing="0" cellpadding="5" style="background-color: white">
                    <tr>

                        <td style="width: 900px;text-align: center"><b>Nội Dung</b></td>
                    </tr>
                    <tr>

                        <td style="width: 900px;text-align: center;"></td>
                    </tr>
                    <tr>

                        <td style="width: 900px;text-align: center;"></td>
                    </tr>
                    <tr>

                        <td style="width: 900px;text-align: center;"></td>
                    </tr>
                </table>
            </div>

        </div>
        <div id="right">
            <ul>
                <li style="margin-bottom: 10px;list-style: none"><a href="#"><button type="button" class="btn"
                            id="btn1"> Compose</button></a>

                <li style="margin-bottom: 10px;list-style: none"><a href="#"><button type="button"
                            class="btn btn-primary" id="btn3">Inbox</button></a>

                <li style="margin-bottom: 10px;list-style: none"><a href="#"><button type="button"
                            class="btn btn-secondary" id="btn5">Sent Mail</button>
            </ul>
        </div>
    </div>
    <div id="footer">Created By 51703037 - 51703137</div>


    <script language="javascript">

        document.getElementById("btn1").onclick = function () {
            document.getElementById("compose-to").value='';
            document.getElementById("content").style.display = 'block';
            if(document.getElementById("content1").style.display == 'block'){
                document.getElementById("content1").style.display = 'none';
            }
            if(document.getElementById("content2").style.display == 'block'){
                document.getElementById("content2").style.display = 'none';
            }
            if(document.getElementById("content3").style.display == 'block'){
                document.getElementById("content3").style.display = 'none';
            }
            if(document.getElementById("mailshow").style.display == 'block'){
                document.getElementById("mailshow").style.display = 'none';
            }
            if(document.getElementById("mailshow2").style.display == 'block'){
                document.getElementById("mailshow2").style.display = 'none';
            }
        };

    </script>

    <script language="javascript">

        document.getElementById("btn3").onclick = function () {
            document.getElementById("content1").style.display = 'block';
            if(document.getElementById("content").style.display == 'block'){
                document.getElementById("content").style.display = 'none';
            }
            if(document.getElementById("content2").style.display == 'block'){
                document.getElementById("content2").style.display = 'none';
            }
            if(document.getElementById("content3").style.display == 'block'){
                document.getElementById("content3").style.display = 'none';
            }
            if(document.getElementById("mailshow").style.display == 'block'){
                document.getElementById("mailshow").style.display = 'none';
            }
            if(document.getElementById("mailshow2").style.display == 'block'){
                document.getElementById("mailshow2").style.display = 'none';
            }
        };

    </script>

    <script language="javascript">

        document.getElementById("btn5").onclick = function () {
            document.getElementById("content2").style.display = 'block';
            if(document.getElementById("content1").style.display == 'block'){
                document.getElementById("content1").style.display = 'none';
            }
            if(document.getElementById("content").style.display == 'block'){
                document.getElementById("content").style.display = 'none';
            }
            if(document.getElementById("content3").style.display == 'block'){
                document.getElementById("content3").style.display = 'none';
            }
            if(document.getElementById("mailshow").style.display == 'block'){
                document.getElementById("mailshow").style.display = 'none';
            }
            if(document.getElementById("mailshow2").style.display == 'block'){
                document.getElementById("mailshow2").style.display = 'none';
            }
        };
        
        function back2(){
            document.getElementById("mailshow2").style.display ='none';
            document.getElementById("content2").style.display = 'block';

        }
    </script>
    <script>
        $('#compose-to').focusout(function(){
            var value = $(this).val();
            if(value.length < 10){
                $('#alert-messageto').css("display","block");
            }else{
                $('#alert-messageto').css("display","none");
            }
        });
        
    </script>


    
</body>

</html>