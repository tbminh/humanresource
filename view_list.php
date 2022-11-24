<?php
if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <section class="content-header">
        <h1 style="color: blue;">
            Danh sách ứng viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Danh sách ứng viên</li>
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
    <br>
    <div class="topnav">
        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới ứng viên</a>
        <div class="search-container">
            <form method="get" action="index.php?list_search">
                <div class="search-container">
                    <input type="text" placeholder="Search.." name="list_query" required>
                    <button type="submit" name="list_search"><i class="fa fa-search"></i></button>
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
                                <th>Chức Vụ</th>
                                <th>Họ tên</th>
                                <th>Điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Email</th>
                                <th>Ngày nộp</th>
                                <th>Trạng thái</th>
                                <th scope="col" colspan="2" style="text-align:center;">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Truy vấn SQL lấy ra thông tin cá nhân, chức vụ, lịch làm việc.
                            $get_c = "SELECT ps.position_name, rec.*, list.*
                                        FROM position as ps, recruit_manage as rec, recruit_list as list
                                        WHERE ps.id = rec.position_id
                                        AND rec.id = list.recruitment_id 
                                        ORDER BY list.id DESC";
                            $run_c = mysqli_query($conn, $get_c);
                            $i = 0;
                            //Gán những thông tin lấy được vào các biến
                            while ($row_c = mysqli_fetch_array($run_c)) {
                                $id = $row_c['id'];
                                $p_name = $row_c['position_name'];
                                $name = $row_c['apply_name'];
                                $phone = $row_c['apply_phone'];
                                $birthday = $row_c['apply_birthday'];
                                $email = $row_c['apply_email'];
                                $date = $row_c['apply_date'];
                                $status = $row_c['apply_status'];
                                $i++;
                            ?>
                                <tr>
                                    <!-- Show các biến ra ngoài -->
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $p_name; ?> </td>
                                    <td> <?php echo $name; ?> </td>
                                    <td> <?php echo "0$phone"; ?></td>
                                    <td> <?php echo $birthday; ?> </td>
                                    <td> <?php echo $email; ?> </td>
                                    <td> <?php echo $date; ?> </td>
                                    <?php
                                    if ($status == 0) {
                                        echo "<td style='color: red;'> <b> Chưa phỏng vấn </b></td>";
                                    } else if ($status == 1) {
                                        echo "<td style='color: orange;'> <b> Đã phỏng vấn </b></td>";
                                    } else if ($status == 2) {
                                        echo "<td style='color: green;'><b> Đã đạt </b></td>";
                                    } else if ($status == 3) {
                                        echo "<td style='color: grey;'><b> Chưa đạt </b></td>";
                                    }
                                    ?>
                                    <td>
                                        <a href="index.php?edit_list=<?php echo $id; ?>" class='btn btn-success '>
                                            <i class="fa fa-edit"></i> Chỉnh Sửa
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?delete_list=<?php echo $id; ?>" class='btn btn-danger' onclick="return confirm('Xác nhận xóa?')">
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
                    <h4 class="modal-title"><b>Thêm Mới</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label">Mã tuyển dụng</label>
                            <div class="col-md-6">
                                <select name="rec" class="form-control">
                                    <option>--------- Chọn vị trí tuyển dụng ---------</option>
                                    <?php
                                    $get_p = "SELECT p.position_name, rc.id
                                                FROM recruit_manage as rc, position as p
                                                WHERE rc.position_id = p.id
                                                AND rc.status = 0";
                                    $run_p = mysqli_query($conn, $get_p);
                                    while ($row_p = mysqli_fetch_array($run_p)) {
                                        $r_id = $row_p['id'];
                                        $rc_id = $row_p['recruit_id'];
                                        $p_name = $row_p['position_name'];
                                        echo "<option value='$r_id'>$p_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Tên Ứng Viên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Điện thoại</label>
                            <div class="col-sm-9">
                                <input type="varchar" class="form-control" name="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email">
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
                            <label for="expert-id" class="col-sm-3 control-label" require>Ngày Sinh</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="birthday">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Ngày Nộp</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date">
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
    $id = $_POST['rec'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $date = $_POST['date'];
    $status = 0;

    // Thực hiện thêm dữ liệu từ các biến 
    $insert_emp = "insert into recruit_list(
                                    recruitment_id, 
                                    apply_name,
                                    apply_phone,
                                    gender,
                                    apply_birthday,
                                    apply_email,
                                    apply_date,
                                    apply_status) 
                    VALUES ( '$id','$name','$phone','$sex', '$birthday','$email','$date','$status')";
    $run_emp = mysqli_query($conn, $insert_emp);
    if ($run_emp) {
        echo "<script>alert('Thêm thành công')</script>";
        echo "<script>window.open('index.php?view_list','_self')</script>";
    } else {
        echo "<script>alert('Thêm không thành công')</script>";
    }
}
?>