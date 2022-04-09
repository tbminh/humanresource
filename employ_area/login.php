<?php
    session_start();
    include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Form</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css/animate.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="" method="post">
                        <h1>Log in your Account</h1>
                        
                        <div>
                            <input type="email" id="userName" name="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" id="password" name="pass" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <button type="submit" name="login" class="btn btn-default submit">Log in</button>
                            <a class="reset_pass" href="#">Lost your password ?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                        <div class="clearfix"></div>
                        <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> Sandwitch Group !</h1>
                                <p>©2017 All Rights Reserved. Sandwitch Group</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
</html>

<?php 

    if(isset($_POST['login'])){
        
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        
        $pass = mysqli_real_escape_string($conn,$_POST['pass']);
        
        $get_emp = "select * from employee where email='$email' AND pass='$pass'";
        
        $run_emp = mysqli_query($conn,$get_emp);
        
        $count = mysqli_num_rows($run_emp);
        
        if($count==1){
            
            $_SESSION['email'] = $email;
            
            echo "<script>alert('Đăng nhập thành công. Xin chào')</script>";
            
            echo "<script>window.open('index.php?employee_list','_self')</script>";
            
        }else{
            
            echo "<script>alert('Sai email hoặc mật khẩu!')</script>";
            
        }
        
    }

?>

