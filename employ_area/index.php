<?php 
    session_start();
    include("includes/db.php");
    
    if(!isset($_SESSION['email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{
        $emp_session = $_SESSION['email'];
        $get_emp = "select * from employee where email='$emp_session'";
        $run_emp = mysqli_query($conn,$get_emp);
        $row = mysqli_fetch_array($run_emp);
        $id = $row['id'];
        $name = $row['full_name'];
        $email = $row['email'];
        $pass = $row['pass'];
        $phone = $row['phone'];
        $address = $row['address'];
        $sex = $row['sex'];
        $birthday = $row['birthday'];
        $level = $row['id_level'];
        $position = $row['id_position'];

        //Lấy dữ liệu từ bảng levels 
        $get_level = "select * from levels where id ='$level'";
        $run_level = mysqli_query($conn,$get_level);
        $row_level = mysqli_fetch_array($run_level);
        $name_l = $row_level['level_name'];

        //Lấy dữ liệu từ bảng position
        $get_p = "select * from position where id ='$position'";
        $run_p = mysqli_query($conn,$get_p);
        $row_p = mysqli_fetch_array($run_p);
        $name_p = $row_p['position_name'];

        //Lấy dữ liệu từ bảng kpi
        $get_kpi = "select * from kpi where employ_id ='$id'";
        
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hệ Thống Thông Tin Nhân Sự</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="css/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="css/bootstrap-progressbar-3.3.4.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="css/jqvmap.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="css/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
        <div id="wrapper">
            <?php
                include("includes/sidebar_emp.php");
            ?>
            <div id="page-wrapper">
                    <div class="container-fluid">
                    <?php
                        if(isset($_GET['employee_list'])){
                            include("employee_list.php");
                        }if(isset($_GET['employee_profile'])){
                            include("employ_profile.php");
                        }if(isset($_GET['change_pass'])){
                            include("change_pass.php");
                        }
                        if(isset($_GET['view_kpi'])){
                            include("kpi.php");
                        }
                        if(isset($_GET['view_salary'])){
                            include("salary.php");
                        }
                    ?>
                    </div>
            </div>
</body>
</html>    
<?php 
}
 ?>        