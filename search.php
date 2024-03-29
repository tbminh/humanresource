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
            <a href="index.php?view_employee"> Nhân Viên</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Nhân Viên</li>
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
        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
        <form method="get" action="index.php?search">
            <div class="search-container">
                <input type="text" placeholder="Search.." name="user_query" required>
                <button type="submit" name="search"><i class="fa fa-search"></i></button>
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
                                <th>Tên nhân viên </th>
                                <th>Chức Vụ </th>
                                <th>Trình Độ</th>
                                <th> Lịch làm việc</th>
                                <th> Email </th>
                                <th scope="col" colspan="2">Tùy chọn</th>
                            </tr>
                        </thread>
                        <?php
                        global $db;
                        $i = 0;
                        if (isset($_GET['search'])) {
                            $find = "%{$_GET['user_query']}%";

                            $get_products = "SELECT lv.level_name, u.*, sc.*,ps.position_name
                            FROM users as u, levels as lv, schedule as sc, position as ps
                            WHERE lv.id = u.id_level 
                            AND sc.id = u.id_schedule
                            AND ps.id = u.id_position	
                            AND (u.id like'$find' or u.full_name like '$find' or u.email like'$find' or u.phone like'$find') ";

                            $run_products = mysqli_query($db, $get_products);

                            $count = mysqli_num_rows($run_products);
                            if ($count > 0) {
                                while ($row_c = mysqli_fetch_array($run_products)) {
                                    $i++;
                                    $id = $row_c['id'];
                                    $name = $row_c['full_name'];
                                    $p_name = $row_c['position_name'];
                                    $lv_name = $row_c['level_name'];
                                    $in = $row_c['time_in'];
                                    $out = $row_c['time_out'];
                                    $c_email = $row_c['email'];
                                    $sc_name = $row_c['schedule_name'];
                                    //Đổi kiểu time lịch làm việc
                                    $t_in = strtotime($in);
                                    $t_out = strtotime($out);

                                    $ab = date('h:i A', $t_in)  . ' - ' .  date('h:i A', $t_out);
                                    echo "
                                        <tbody>
                                            <tr>
                                                <td> $i </td>
                                                <td> $id </td>
                                                <td> $name </td>
                                                <td> $p_name </td>
                                                <td> $lv_name </td>
                                                <td> $sc_name </td>
                                                <td> $c_email </td>
                                                <td> 
                                                    <a href='index.php?edit_employee= $id 'class='btn btn-success btn-sm btn-flat edit'>
                                                        <i class='fa fa-edit'></i> Edit
                                                    </a>
                                                </td>
                                                <td> 
                                                    <a href='index.php?delete_employee= $id ' class='btn btn-danger btn-sm btn-flat delete'>
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
        getsearch();
        ?>
    </div>

    <div class="modal fade" id="addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Thêm Nhân Viên</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Mã Nhân Viên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="employ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Tên Nhân Viên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label">Trình Độ</label>
                            <div class="col-md-6">
                                <select name="level" class="form-control">
                                    <option>--------- Trình Độ Nhân Viên ---------</option>
                                    <?php
                                    $get_l = "SELECT * FROM levels";
                                    $run_l = mysqli_query($conn, $get_l);
                                    while ($row_l = mysqli_fetch_array($run_l)) {
                                        $l_id = $row_l['id'];
                                        $l_name = $row_l['level_name'];
                                        echo "<option>$l_id - $l_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label">Chức Vụ</label>
                            <div class="col-md-6">
                                <select name="pos" class="form-control">
                                    <option>--------- Chức Vụ Nhân Viên ---------</option>
                                    <?php
                                    $get_l = "SELECT * FROM position";
                                    $run_l = mysqli_query($conn, $get_l);
                                    while ($row_l = mysqli_fetch_array($run_l)) {
                                        $l_id = $row_l['id'];
                                        $l_name = $row_l['position_name'];
                                        echo "<option>$l_id - $l_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label">Lịch Làm Việc</label>
                            <div class="col-md-6">
                                <select name="sc" class="form-control">
                                    <option>--------- Chọn Lịch Làm Việc ---------</option>
                                    <?php
                                    $get_l = "SELECT * FROM schedule";
                                    $run_l = mysqli_query($conn, $get_l);
                                    while ($row_l = mysqli_fetch_array($run_l)) {
                                        $s_id = $row_l['id'];
                                        $in = $row_l['time_in'];
                                        $out = $row_l['time_out'];
                                        $t_in = strtotime($in);
                                        $t_out = strtotime($out);
                                        $s1 = date('h:i A', $t_in);
                                        $s2 = date('h:i A', $t_out);
                                        echo "<option>$s_id -$s1 - $s2</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Địa chỉ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Số điện thoại</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Giới tính</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="sex">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Ngày sinh</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="birthday">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (isset($_POST['add'])) {
        $id = $_POST['employ'];
        $name = $_POST['name'];
        $level = $_POST['level'];
        $pos = $_POST['pos'];
        $sc = $_POST['sc'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];

        //Báo lỗi khi nhập trùng mã nhân viên và email
        $get_soluong = "select * from employee";
        $run_soluong = mysqli_query($conn, $get_soluong);
        while ($row_soluong = mysqli_fetch_array($run_soluong)) {
            $soluong = $row_soluong['email'];
            $idd = $row_soluong['employee_id'];

            if ($idd ==  $id) {

                echo "<script>alert('Mã nhân viên đã tồn tại')</script>";

                exit();
            }
            if ($soluong ==  $email) {
                echo "<script>alert('Email đã tồn tại')</script>";
                exit();
            }
        }

        //Thực hiện truy vấn dữ liệu
        $insert_emp = "insert into employee( employee_id, full_name, id_level, id_position, id_schedule, email,address,phone,sex,birthday) 
                        VALUES ( '$id','$name','$level','$pos', '$sc', '$email','$address','$phone','$sex','$birthday')";
        $run_emp = mysqli_query($conn, $insert_emp);
        if ($run_emp) {
            echo "<script>alert('Bạn đã thêm nhân viên thành công')</script>";
            echo "<script>window.open('index.php?view_employee','_self')</script>";
        }
    }
    ?>