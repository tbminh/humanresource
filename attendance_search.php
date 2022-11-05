<?php

include("includes/db.php");

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
    <section class="content-header">
        <h1 style="color: blue;">
            <a href="index.php?view_attendance">Điểm Danh</a>
        </h1>


        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Điểm danh</li>
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
</head>


<div class="topnav">
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
    <form method="get" action="index.php?attendance_search">
        <div class="search-container">
            <input type="text" placeholder="Search.." name="att_query" required>
            <button type="submit" name="attendance_search"><i class="fa fa-search"></i></button>
    </form>
</div>
</div>
</div><br>

<!-- Main content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thread>
                        <tr>
                            <th>STT</th>
                            <th>Mã Nhân Viên</th>
                            <th>Tên nhân viên </th>
                            <th>Ngày</th>
                            <th>Ca làm</th>
                            <th>Giờ vào ca</th>
                            <th> Giờ tan ca</th>
                            <th scope="col" colspan="2">Tùy chọn</th>
                        </tr>
                    </thread>
                    <?php
                    global $db;
                    $i = 0;
                    if (isset($_GET['attendance_search'])) {
                        $find = "%{$_GET['att_query']}%";

                        $get_att = "SELECT  u.*, sc.*, att.*
                            FROM users as u, schedule as sc, attendance as att
                            WHERE u.id = att.employ_id 
                            AND   u.id_schedule = sc.id
                            AND ( u.full_name like '$find' or u.employee_id like'$find' or u.phone like'$find') ";

                        $run_products = mysqli_query($db, $get_att);

                        $count = mysqli_num_rows($run_products);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_array($run_products)) {
                                $i++;
                                $a_id = $row['id'];
                                $emp_id = $row['employee_id'];
                                $name = $row['full_name'];
                                $work = $row['work_day'];
                                $sc_name = $row['schedule_name'];
                                $start = $row['start_time'];
                                $finish = $row['finish_time'];
                                $status = ($row['status']);
                                if ($status == 1) {
                                    $status = '<span class="label label-warning pull-right">ontime</span>';
                                } else if ($status == 0) {
                                    $status = '<span class="label label-danger pull-right">late</span>';
                                } else {
                                    $status = '<span class="label label-default pull-right">absent</span>';
                                }

                                echo "<tbody>
                                            <tr>
                                                <td> $i </td>
                                                <td> $emp_id </td>
                                                <td> $name </td>
                                                <td> $work </td>
                                                <td> $sc_name </td>
                                                <td> $start . $status </td>
                                                <td> $finish </td>
                                                <td> 
                                                    <a href='index.php?edit_employee= $a_id 'class='btn btn-success btn-sm btn-flat edit'>
                                                        <i class='fa fa-edit'></i> Edit
                                                    </a>
                                                </td>
                                                <td> 
                                                    <a href='index.php?delete_employee= $a_id' class='btn btn-danger btn-sm btn-flat delete'>
                                                        <i class='fa fa-trash'></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>";
                            }
                        } else {
                            echo "<script>alert('Không tìm thấy nhân viên nào')</script>";
                            echo "<script>window.open('index.php?view_employee','_self')</script>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="search">
    <?php
    getatt_search();
    ?>
</div>