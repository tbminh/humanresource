<?php 
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{
        $admin_session = $_SESSION['admin_email'];
        $get_admin = "select * from admins where admin_email='$admin_session'";
        $run_admin = mysqli_query($conn,$get_admin);
        $row_admin = mysqli_fetch_array($run_admin);
        $admin_id = $row_admin['admin_id'];
        $account = $row_admin['account'];
        $admin_name = $row_admin['admin_name'];
        $admin_email = $row_admin['admin_email'];
        $admin_pass = $row_admin['admin_pass'];
        $admin_image = $row_admin['admin_image'];
        $admin_country = $row_admin['admin_country'];
        $admin_contact = $row_admin['admin_contact'];
        $admin_birthday = $row_admin['admin_birthday'];

        // $get_employ = "select * from employee";
        // $run_employ = mysqli_query($conn,$get_employ);
        // $count_employ = mysqli_num_rows($run_employ);
        
        
        // $get_pb = "select * from department";
        // $run_pb = mysqli_query($conn,$get_pb);
        // $count_pb = mysqli_num_rows($run_pb);
        // $get_cv = "select * from position";
        // $run_cv = mysqli_query($conn,$get_cv);
        // $count_cv = mysqli_num_rows($run_cv);
        // $get_cm = "select * from department";
        // $run_cm = mysqli_query($conn,$get_cm);
        // $count_cm = mysqli_num_rows($run_cm);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Hệ Thống Quản Lý Nhân Sự</title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awsome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <div id="wrapper">
            <?php
                include("includes/sidebar.php");
            ?>
            <div id="page-wrapper">
                <div class="container-fluid">
                <?php
                    if(isset($_GET['dashboard'])){
                        include("dashboard.php");
                    }
                    if(isset($_GET['profile_admin'])){
                        include("admin_profile.php");
                    }
                    if(isset($_GET['view_schedule'])){
                        include("view_schedule.php");
                    }
                    if(isset($_GET['edit_schedule'])){
                        include("edit_schedule.php");
                    }if(isset($_GET["delete_schedule"])){
                        include("delete_schedule.php");
                    }if(isset($_GET['view_attendance'])){
                        include("attendance.php");
                    }
                    if(isset($_GET['delete_attendance'])){
                        include("delete_attendance.php");
                    }
                    if(isset($_GET['view_kpi'])){
                        include("view_kpi.php");
                    }
                    if(isset($_GET['edit_attendance'])){
                        include("edit_attendance.php");
                    }if(isset($_GET['view_department'])){
                        include("view_department.php");
                    }if(isset($_GET['edit_depart'])){
                        include("edit_depart.php");
                    }if(isset($_GET['delete_depart'])){
                        include("delete_depart.php");
                    }if(isset($_GET['insert_cat'])){
                        include("insert_cat.php");
                    }if(isset($_GET['view_position'])){
                        include("view_position.php");
                    }if(isset($_GET['edit_position'])){
                        include("edit_position.php");
                    }if(isset($_GET['delete_position'])){
                        include("delete_position.php");
                    }if(isset($_GET['view_employee'])){
                        include("view_employee.php");
                    }if(isset($_GET['delete_employee'])){
                        include("delete_employee.php");
                    }if(isset($_GET['view_salary'])){
                        include("view_salary.php");
                    }if(isset($_GET['confirm_yes'])){
                        include("confirm_yes.php");
                    }if(isset($_GET['confirm_no'])){
                        include("confirm_no.php");
                    }if(isset($_GET['view_bonus'])){
                        include("view_bonus.php");
                    }if(isset($_GET['edit_ship'])){
                        include("edit_ship.php");
                    }if(isset($_GET["delete_ship"])){
                        include("delete_ship.php");
                    }if(isset($_GET['view_level'])){
                        include("view_level.php");
                    }if(isset($_GET['edit_level'])){
                        include("edit_level.php");
                    }if(isset($_GET["delete_level"])){
                        include("delete_level.php");
                    }if(isset($_GET["print"])){
                        include("print.php");
                    }if(isset($_GET["view_ord"])){
                        include("view_ord.php");
                    }if(isset($_GET["edit_employee"])){
                        include("edit_employee.php");
                    }if(isset($_GET["edit_cm"])){
                        include("edit_cm.php");
                    }if(isset($_GET["delete_cm"])){
                        include("delete_cm.php");
                    }
                    if(isset($_GET["view_ktkl"])){
                        include("view_ktkl.php");
                    }
                    if(isset($_GET["delete_ktkl"])){
                        include("delete_ktkl.php");
                    }
                    if(isset($_GET["edit_ktkl"])){
                        include("edit_ktkl.php");
                    }if(isset($_GET['search'])){
                        include("search.php");
                    }if(isset($_GET['delete_kpi'])){
                        include("delete_kpi.php");
                    }if(isset($_GET['edit_kpi'])){
                        include("edit_kpi.php");
                    }if(isset($_GET['kpi_search'])){
                        include("kpi_search.php");
                    }if(isset($_GET['hoanthanh'])){
                        include("hoanthanh.php");
                    }if(isset($_GET['chuahoanthanh'])){
                        include("chuahoanthanh.php");
                    }
                ?>
                </div>
            </div>
        </div>

    <script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>   
</body>
</html>
<?php 
}
 ?>