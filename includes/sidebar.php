<?php
if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <header class="main-header">
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #2F4F4F;">
            <a href="index.php?dashboard" class="navbar-brand" style="color: white; margin-left:50px;">HRM System</a>
            <div class="navbar-header">

                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="float: left; background-color: transparent; background-image: none; padding: 15px 15px; font-family: fontAwesome;">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </div>

            <ul class="nav navbar-right top-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="https://png.pngtree.com/png-vector/20190501/ourmid/pngtree-users-icon-design-png-image_1014936.jpg" class="img-circle" alt="User Image" style="width: 100%; max-width: 30px; height: auto; ">
                        <span class="hidden-xs" style="margin-right: 20px;"><?php echo $admin_name; ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: 175px; padding:10px 90px 20px 90px ;  text-align: center; background-color:#2F4F4F;">
                            <img src="https://png.pngtree.com/png-vector/20190501/ourmid/pngtree-users-icon-design-png-image_1014936.jpg" class="img-circle" alt="User Image" style="z-index: 5;height: 90px; width: 90px;border: 3px solid;border-color: transparent; border-color: rgba(255, 255, 255, 0.2);">

                            <p style="z-index: 5;color: #fff; color: rgba(255, 255, 255, 0.8); font-size: 17px; margin-top: 10px;">
                                <?php echo $admin_name; ?>
                                <small style="display: block;font-size: 12px;"> Member since July-10-2021</small>
                            </p>
                        </li>
                        <li class="user-footer" style="background-color: #f9f9f9; padding: 10px;">
                            <div class="pull-left">
                                <a href="index.php?profile_admin" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout.php" class="btn btn-default btn-flat" style="margin-right:10px;">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="test" class="nav navbar-nav side-nav">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="https://png.pngtree.com/png-vector/20190501/ourmid/pngtree-users-icon-design-png-image_1014936.jpg" class="img-circle" alt="User Image" style="width: 100%; max-width: 50px; height: auto; margin:0px 30px 0px 30px;">
                        </div>
                        <div class="pull-left info" style="margin: 10px 0px;">
                            <p style="color: white;"><?php echo  $admin_name; ?></p>
                            <a style="color: white; font-size: 10px;"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <li class="list">
                        <a href="index.php?dashboard">
                            <i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_employee" data-toggle="collapse" data-target="#user">
                            <i class="fa fa-fw fa-users"></i> Danh sách nhân sự
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_schedule">
                            <i class="fa fa-clock-o"></i>&nbsp; Ca Làm Việc
                        </a>
                    </li>
                    <!-- <li class="list">
                        <a href="index.php?view_attendance">
                            <i class="fa fa-check-square"></i>&nbsp; Chấm Công
                        </a>
                    </li> -->
                    <li class="list">
                        <a href="index.php?view_department" data-toggle="collapse" data-target="#p_cat">
                            <i class="fa fa-object-group"></i>&nbsp; Đơn Vị
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_position" data-toggle="collapse" data-target="#cat">
                            <i class="fa fa-suitcase"></i>&nbsp; Chức vụ
                        </a>
                    </li>

                    <li class="list">
                        <a href="index.php?view_kpi" data-toggle="collapse" data-target="#cat">
                            <i class="fa fa-bullseye"></i>&nbsp; Quản lý KPI
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_salary" data-toggle="collapse" data-target="#boxes">
                            <i class="fa fa-credit-card-alt"></i>&nbsp; Quản lý mức lương
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_level" data-toggle="collapse" data-target="#coupon">
                            <i class="fa fa-graduation-cap"></i>&nbsp; Trình độ
                        </a>
                    </li>

                    <li class="list">
                        <a href="index.php?view_ktkl" data-toggle="collapse" data-target="#ships">
                            <i class="fa fa-thumbs-up"></i>&nbsp; Khen Thưởng - Kỷ luật
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_qltd" data-toggle="collapse" data-target="#ships">
                            <i class="fa fa-location-arrow"></i>&nbsp; Quản lý tuyển dụng
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?view_list" data-toggle="collapse" data-target="#ships">
                            <i class="fa fa-user-secret"></i>&nbsp; Danh sách ứng viên
                        </a>
                    </li>
                    <li class="list">
                        <a href="index.php?profile_admin" data-toggle="collapse" data-target="#users">
                            <i class="fa fa-user"></i>&nbsp; Admin
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class="fa fa-fw fa-power-off"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
<?php } ?>