<?php
session_start();
include("includes/db.php");
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Đăng nhập</title>
    <style>
        * {
            font-family: sans-serif;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <img src="customer_image/hinhaccount.png" alt="" class="left__img">
        </div>
        <div class="right">
            <h1 class="right__title">
                HỆ THỐNG QUẢN LÍ NHÂN SỰ
            </h1>
            <div class="right__form">
                <div class="form__heading">
                    <h2 class="form__title">ĐĂNG NHẬP</h2>
                </div>

                <form action="" method="post" class="form__login">
                    <label for="email" class="login__label">Email</label>
                    <input type="email" name="admin_email" placeholder="Nhập vào email" required class="login__input">
                    <label for="password" class="login__label">Mật khẩu</label>
                    <input type="password" name="admin_pass" placeholder="Nhập vào mật khẩu" required class="login__input">
                    <button name="admin_login" class="login__btn">ĐĂNG NHẬP</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);

    $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_pass']);
    $pass_md5 = md5($admin_pass);
    $get_admin = "select * from users
                  where email='$admin_email'
                  AND pass='$pass_md5'
                  AND role_id = 1";

    $run_admin = mysqli_query($conn, $get_admin);

    $count = mysqli_num_rows($run_admin);

    if ($count == 1) {
        $_SESSION['admin_email'] = $admin_email;
        echo "<script>alert('Đăng nhập thành công. Xin chào')</script>";
        echo "<script>window.open('index.php?dashboard','_self')</script>";
    } else {
        echo "<script>alert('Sai email hoặc mật khẩu!')</script>";
    }
}
?>