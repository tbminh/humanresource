<?php 
    if(!isset($_SESSION['email'])){
        
        echo "<script>window.open('login.php','_self')</script>"; 
    }else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hệ Thống Thông Tin Nhân Sự</title>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">

    <div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>Sandwitch Group !</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="pull-left image">
                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-circle" alt="User Image" style="width: 100%; max-width: 60px; height: auto; margin:0px 30px 0px 10px; background: white;">
            </div>

            <div class="pull-left info" style="margin: 10px 0px;">
                <p style="color: white;"><?php echo $name; ?></p>
                <a style="color: white; font-size: 10px;"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div><br />
        <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>DANH BẠ</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="index.php?employee_list"><i class="fa fa-group"></i> Danh bạ nhân sự</a>
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>QUẢN TRỊ NHÂN LỰC</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="index.php?employee_profile"><i class="fa fa-book"></i> Hồ sơ cá nhân tự khai</a>
                       
                    </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>QUẢN LÝ GIAO VIỆC</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="index.php?view_kpi"><i class="fa fa-bullseye"></i> KPI cá nhân được giao</a>
                    </li>
                </ul>
            </div>
            
            <div class="menu_section">
                <h3>QUẢN LÝ THU NHẬP</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="index.php?view_salary"><i class="fa fa-laptop"></i> Bảng lương tháng</a>
                    </li>

                    <li>
                        <a href="logout.php"><br>
                            <i class="fa fa-fw fa-power-off"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
            </div>
        </div>

<!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="" onclick="myFunction()" class="user-profile dropdown-toggle">
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""><?php echo $name; ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul id="myDropdown" class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="#;"> Profile</a></li>
                                <li><a href="#"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
<!-- /top navigation -->
</div>
</div>
<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
    var dropdowns = document.getElementsByClassName("dropdown-menu");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<?php } ?>