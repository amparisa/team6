<?php
    session_start();
    require('connect.php');
    require('function.php');
    if(isset($_SESSION['status'],$_SESSION['id']) && $_SESSION['status'] != 'admin')
    {
        header('Location:index.php');
    }
    

    if(!isset($_SESSION['id']))
    {
        header("Location:index.php");
    }
    
    if(empty($_GET['id']))
    {
        header("Location:index.php");
    }
    if(isset($_POST['login']))
    {
        $username = $_GET['id'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

            if($password1 == $password2)
            {
                $password_encode = hash_hmac('sha256',$password2,"as1d56asd1as56d1as56d1as56d1gre561g5fds6");
                $UPDATE = UPDATE($conn,"tb_members","password = '$password_encode'","id_member= '$username'");
                if($UPDATE)
                {
                    alert("เปลื่ยนรหัสผ่านเสร็จสิ้น!","admin_member.php");
                }
                else
                {
                    alert("เกิดข้อผิดพลาดในการเปลื่ยนรหัสผ่าน!","admin_member.php");
                }
            }
            else
            {
                alert("รหัสผ่านไม่ตรงกัน!","admin_member.php");
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
    .container
    {
        width:95%;
    }
    .breadcrumb{
        background-color: #D49B54;
        font-size: 16px;
 
    }
    .breadcrumb a{
        color: black;
    }
    .dropdown:hover .dropdown-menu
    {
        display: block;
        margin-top: 0;
    }
</style>
<body>
    

    <form action="" method="post">
    <div class="container">
        <div class="panel panel-warning" style="margin:0 auto;width: 500px; margin-top: 20px; margin-bottom: 20px;">
            <div class="breadcrumb text-center">แก้ไขรหัสผ่าน</div>
            <div class="panel-body">
            <div class="form-group">
            <div class="form-group">
                    <label for="password1">รหัสผ่าน ใหม่</label>
                    <input type="password" pattern=".{8,}" name="password1" placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" required class="form-control" id="password1">
                </div>
            <div class="form-group">
                    <label for="password2">ยืนยันรหัสผ่าน</label>
                    <input type="password" pattern=".{8,}" name="password2" placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" required class="form-control" id="password2">
                </div>
                <input type="submit" onclick="return confirm('คุณต้องการที่จะเปลื่ยนรหัสผ่าน ?');" class="btn btn-success btn-block" name="login" value="ยืนยัน">
                <a href="admin_member.php" class="btn btn-danger btn-block">กลับ</a>
            </div>
        </div>
    </div>
</form>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>