<?php
    session_start();
    require('connect.php');
    require('function.php');
    
    if(isset($_SESSION['id']))
    {
        header("Location:index.php");
    }

    if(isset($_POST['register']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];

        $check = SELECT_ID($conn,"tb_members","username = '$username'");
        if($check->num_rows == 0)
        {
            $password_encode = hash_hmac('sha256',$password,"as1d56asd1as56d1as56d1as56d1gre561g5fds6");
            $INSERT = INSERT($conn,"tb_members","username,password,firstname,lastname,address,tel","'$username','$password_encode','$firstname','$lastname','$address','$tel'");
            if($INSERT)
            {
                alert("สมัครสมาชิกเสร็จสิ้น!","login.php");
            }
            else
            {
                alert("เกิดข้อผิดพลาดในการสมัครสมาชิก!","register.php");
            }
        }
        else
        {
            alert("ชื่อผู้ใช้นี้ถูกใช้งานแล้ว!","register.php");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUPERCARCARESHOP | เร็ว แรง</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
     html,body
    {
        background-color: #D3D3D3;
    }
    .breadcrumb{
        background-color: #D49B54;
        font-size: 16px;
    }
</style>
<body>
    

    <form action="" method="post">
    <div class="container">
        <div class="panel panel-warning" style="margin:0 auto;width: 500px; margin-top: 20px; margin-bottom: 20px;">
            <div class="breadcrumb text-center">สมัครสมาชิก</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="username">ชื่อผู้ใช้</label>
                    <input type="email" name="username" placeholder="username@gmail.com" required class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" pattern=".{8,}" name="password" placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" required class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="firstname">ชื่อจริง</label>
                    <input type="text" name="firstname" placeholder="ชื่อจริง" required class="form-control" id="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">นามสกุล</label>
                    <input type="text" name="lastname" placeholder="นามสกุล" required class="form-control" id="lastname">
                </div>
                <div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <textarea name="address" id="address" cols="5" class="form-control" rows="5" placeholder="ที่อยู่ปัจจุบัน" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" name="tel" pattern="[0-9]{10}" placeholder="เบอร์โทร (08X-XXX-XXXX)" required class="form-control" id="tel">
                </div>
            </div>
            <div class="panel-footer text-center">
                <input type="submit" class="btn btn-success" name="register" onclick="return confirm('คุณต้องการที่จะสมัครสมาชิก ?');" value="สมัครสมาชิก">
                <a href="index.php" class="btn btn-danger">กลับ</a>
            </div>
        </div>
    </div>
</form>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>