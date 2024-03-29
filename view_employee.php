<?php
if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <section class="content-header">
        <h1>
            Nhân Viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh Sách Nhân Sự</li>
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
        <div class="search-container">
            <form method="get" action="index.php?search">
                <div class="search-container">
                    <input type="text" placeholder="Search.." name="user_query" required>
                    <button type="submit" name="search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <br>

    <!-- Main content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã Nhân Viên</th>
                                <th>Tên nhân viên </th>
                                <th>Chức Vụ </th>
                                <th>Trình Độ</th>
                                <th>Ca làm việc</th>
                                <th>Email</th>
                                <th scope="col" colspan="2">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Truy vấn SQL lấy ra thông tin cá nhân, chức vụ, lịch làm việc.
                            $get_c = "SELECT lv.level_name, u.* ,sc.schedule_name, ps.position_name
                                        FROM users as u, levels as lv, schedule as sc, position as ps
                                        WHERE lv.id = u.id_level 
                                        AND sc.id = u.id_schedule
                                        AND ps.id = u.id_position	
                                        ORDER BY u.id DESC";
                            $run_c = mysqli_query($conn, $get_c);
                            $i = 0;
                            //Gán những thông tin lấy được vào các biến
                            while ($row_c = mysqli_fetch_array($run_c)) {
                                $id = $row_c['id'];
                                $name = $row_c['full_name'];
                                $p_name = $row_c['position_name'];
                                $lv_name = $row_c['level_name'];
                                $sc_name = $row_c['schedule_name'];
                                $c_email = $row_c['email'];
                                $i++;
                            ?>
                                <tr>
                                    <!-- Show các biến ra ngoài -->
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $id; ?> </td>
                                    <td> <?php echo $name; ?> </td>
                                    <td> <?php echo $p_name; ?> </td>
                                    <td> <?php echo $lv_name; ?> </td>
                                    <td> <?php echo $sc_name; ?></td>
                                    <td> <?php echo $c_email; ?> </td>
                                    <td>
                                        <a href="index.php?edit_employee=<?php echo $id; ?>" class='btn btn-success btn-sm btn-flat edit'>
                                            <i class="fa fa-edit"></i> Chỉnh Sửa
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?delete_employee=<?php echo $id; ?>" class="btn btn-danger btn-sm btn-flat delete" onclick="return confirm('Xác nhận xóa?')">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><b>Thêm Nhân Viên</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">
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
                                        echo "<option value='$l_id'>$l_name</option>";
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
                                    $get_p = "SELECT * FROM position";
                                    $run_p = mysqli_query($conn, $get_p);
                                    while ($row_p = mysqli_fetch_array($run_p)) {
                                        $p_id = $row_p['id'];
                                        $p_name = $row_p['position_name'];
                                        echo "<option value='$p_id'>$p_name</option>";
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
                                    $get_s = "SELECT * FROM schedule";
                                    $run_s = mysqli_query($conn, $get_s);
                                    while ($row_s = mysqli_fetch_array($run_s)) {
                                        $s_id = $row_s['id'];
                                        $in = $row_s['time_in'];
                                        $out = $row_s['time_out'];
                                        $t_in = strtotime($in);
                                        $t_out = strtotime($out);
                                        $s1 = date('h:i A', $t_in);
                                        $s2 = date('h:i A', $t_out);
                                        echo "<option value='$s_id'>$s1 - $s2</option>";
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
                            <label for="expert-id" class="col-sm-3 control-label">Giới tính</label>
                            <div class="col-sm-9">
                                <input type="radio" name="sex" id="sex" value="Nam" />
                                <label for="sex">Nam</label>

                                <input type="radio" name="sex" id="sex" value="Nữ" />
                                <label for="sex">Nữ</label>
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
                            <button type="submit" name="add" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
<?php
//Nhận sự kiện 'add' từ nút thêm của modal
if (isset($_POST['add'])) {
    // Gán giá trị đã nhập vào các biến
    $name = $_POST['name'];
    $level_id = $_POST['level'];
    $pos_id = $_POST['pos'];
    $sc_id = $_POST['sc'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $pass = md5('12345');
    $role = 2;
    $get_soluong = "select * from users where id = '$id'";
    $run_soluong = mysqli_query($conn, $get_soluong);
    while ($row_soluong = mysqli_fetch_array($run_soluong)) {
        $soluong = $row_soluong['email'];
        //Báo lỗi khi nhập trùng mã nhân viên hoặc email
        if ($soluong ==  $email) {
            echo "<script>alert('Email đã tồn tại')</script>";
            exit();
        }
    }
    //Thực hiện thêm dữ liệu từ các biến 
    $insert_emp = "insert into users(
                                    role_id,
                                    full_name,
                                    id_level,
                                    id_position,
                                    id_schedule,
                                    email,
                                    pass,
                                    address,
                                    phone,
                                    sex,
                                    birthday)
                    VALUES ('$role','$name','$level_id','$pos_id','$sc_id', '$email','$pass','$address','$phone','$sex','$birthday')";
    $run_emp = mysqli_query($conn, $insert_emp);
    if ($run_emp) {
        echo "<script>alert('Bạn đã thêm nhân viên thành công')</script>";
        echo "<script>window.open('index.php?view_employee','_self')</script>";
    } else {
        echo "<script>alert('Thêm không thành công')</script>";
    }
}
?>