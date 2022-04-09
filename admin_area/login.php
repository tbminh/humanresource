<?php
    session_start();
    include("includes/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Đăng Nhập</title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="wrapper">
        <div class="content">
            <h2 class="subtitle">LOGIN</h2>
            <form action="" method="post">
                <div class="input-wrapper">
                    <label for="email">Email</label>
                    <input id="email" name="admin_email" type="text">
                </div>
                
                <div class="input-wrapper">
                    <label for="password">Mật khẩu</label>
                    <input id="password" name="admin_pass" type="password">
                </div>

                <button class="btn" name="admin_login">Đăng Nhập</button>
            </form>
        </div>

    </div>

    <script src="js/main.js"></script>
</body>
</html>

<?php 

    if(isset($_POST['admin_login'])){
        
        $admin_email = mysqli_real_escape_string($conn,$_POST['admin_email']);
        
        $admin_pass = mysqli_real_escape_string($conn,$_POST['admin_pass']);
        
        $get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$admin_pass'";
        
        $run_admin = mysqli_query($conn,$get_admin);
        
        $count = mysqli_num_rows($run_admin);
        
        if($count==1){
            
            $_SESSION['admin_email']=$admin_email;
            
            echo "<script>alert('Đăng nhập thành công. Xin chào')</script>";
            
            echo "<script>window.open('index.php?dashboard','_self')</script>";
            
        }else{
            
            echo "<script>alert('Sai email hoặc mật khẩu!')</script>";
            
        }
        
    }

?>
