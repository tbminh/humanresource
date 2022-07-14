<?php include 'includes/header.php'; ?>
<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1 style="color: blue;">
                        <a href="index.php?view_kpi"> Quản lý danh sách ứng viên</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                        <li class="active"><a href="index.php?view_list">Quản ký ứng viên </a> </li>
                    </ol>
                </section>
                <style>
                    .topnav .search-container {
                        float: right;
                    }

                    .topnav input[type=text] {
                        padding: 6px;
                        font-size: 17px;
                        border: none;
                    }

                    .topnav .search-container button {
                        float: right;
                        padding: 6px 10px;
                        margin-right: 16px;
                        background: #ddd;
                        font-size: 17px;
                        border: none;
                        cursor: pointer;
                    }

                    .topnav .search-container button:hover {
                        background: #ccc;
                    }
                </style>

                <div class="topnav">
                    <div class="search-container">
                        <form method="get" action="index.php?list_search">
                            <div class="search-container">
                                <input type="text" placeholder="Search.." name="list_query" required>
                                <button type="submit" name="list_search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div><br>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th>STT</th>
                                        <th>Mã tuyển dụng</th>
                                        <th>Chức Vụ</th>
                                        <th>Họ tên</th>
                                        <th>Điện thoại</th>
                                        <th>Ngày sinh</th>
                                        <th>Email</th>
                                        <th>Ngày nộp</th>
                                        <th>Trạng thái</th>
                                        <th scope="col" colspan="2" style="text-align:center;">Tùy chọn</th>
                                    </thead>
                                    <?php
                                    global $db;
                                    $i = 0;
                                    if (isset($_GET['list_search'])) {
                                        $find = $_GET['list_query'];
                                        $get_products = "SELECT ps.position_name, rec.recruit_id, list.*
                                                        FROM position as ps, recruit_manage as rec, recruit_list as list
                                                        WHERE ps.id = rec.position_id
                                                        AND rec.id = list.recruitment_id 
                                                        AND apply_name like '%$find%'
                                                        OR apply_phone like '%$find%'";

                                        $run_products = mysqli_query($db, $get_products);

                                        $count = mysqli_num_rows($run_products);

                                        if ($count > 0) {
                                            while ($row_c = mysqli_fetch_array($run_products)) {
                                                $id = $row_c['id'];
                                                $rc_id = $row_c['recruit_id'];
                                                $p_name = $row_c['position_name'];
                                                $name = $row_c['apply_name'];
                                                $phone = $row_c['apply_phone'];
                                                $birthday = $row_c['apply_birthday'];
                                                $email = $row_c['apply_email'];
                                                $date = $row_c['apply_date'];
                                                $status = $row_c['apply_status'];
                                                $i++;
                                                if ($status == 0) {
                                                    $status_pr = " <td style='color: red;''> <b> Chưa phỏng vấn </b></td>";
                                                } else if ($status == 1) {
                                                    $status_pr = " <td style='color: orange;'><b> Đã phỏng vấn </b></td>";
                                                } else if ($status == 2) {
                                                    $status_pr = "<td style='color: green;'> <b> Đã đạt </b></td>";
                                                } else {
                                                    $status_pr = "<td style='color: grey;'> <b> Không đạt </b></td>";
                                                }
                                                echo "
                                                        <tbody>
                                                        <tr>
                                                            <td> $i </td>
                                                            <td> $rc_id</td>
                                                            <td> $p_name </td>
                                                            <td> $name </td>
                                                            <td> $phone </td>
                                                            <td> $birthday </td>
                                                            <td> $email </td>
                                                            <td> $date </td>
                                                                $status_pr
                                                            <td>
                                                                <a href='index.php?edit_list= $id'  class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>     
                                                            </td>

                                                            <td> 
                                                                <a class='btn btn-danger btn-sm btn-flat delete' href='index.php?delete_list= $id'>
                                                                    <i class='fa fa-trash'></i> Delete
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        </tbody>";
                                            }
                                        } else {
                                            echo "<script>alert('Không tìm thấy ứng viên nào')</script>";

                                            echo "<script>window.open('index.php?view_list','_self')</script>";
                                        }
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>