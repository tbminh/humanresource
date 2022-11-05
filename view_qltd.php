<?php
if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <section class="content-header">
        <h1 style="color: blue;">
            Quản lý tuyển dụng
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản lý tuyển dụng</li>
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
        <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
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
                                <th>Mã tuyển dụng</th>
                                <th>Chức Vụ </th>
                                <th>Số lượng </th>
                                <th>Ngày tuyển</th>
                                <th>Hạn chót</th>
                                <th>Trạng thái</th>
                                <th scope="col" colspan="3" style="text-align:center;">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Truy vấn SQL lấy ra thông tin cá nhân, chức vụ, lịch làm việc.
                            $get_c = "SELECT ps.position_name, rec.*
                                        FROM position as ps, recruit_manage as rec
                                        WHERE ps.id = rec.position_id
                                        ORDER BY rec.id DESC";
                            $run_c = mysqli_query($conn, $get_c);
                            $i = 0;
                            //Gán những thông tin lấy được vào các biến
                            while ($row_c = mysqli_fetch_array($run_c)) {
                                $id = $row_c['id'];
                                $c_id = $row_c['recruit_id'];
                                $p_name = $row_c['position_name'];
                                $qty = $row_c['quantity'];
                                $date = $row_c['date_recruit'];
                                $expire = $row_c['expired_recruit'];
                                $status = $row_c['status'];
                                $i++;
                            ?>
                                <tr>
                                    <!-- Show các biến ra ngoài -->
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $c_id; ?> </td>
                                    <td> <?php echo $p_name; ?> </td>
                                    <td> <?php echo $qty; ?> </td>
                                    <td> <?php echo $date; ?></td>
                                    <td> <?php echo $expire; ?> </td>
                                    <?php
                                    if ($status == 0) {
                                        echo "<td style='color: red;'> <b> Chưa tuyển đủ </b></td>";
                                    } else {
                                        echo "<td style='color: green;'><b> Đã tuyển đủ </b></td>";
                                    }
                                    ?>

                                    <td>
                                        <?php
                                        $ab = '0';
                                        $bc = '1';
                                        if ($status == $bc) : ?>
                                            <a href="index.php?donot_qltd=<?php echo $id; ?>" class="btn btn-warning">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i> Huỷ
                                            </a>
                                        <?php elseif ($status == $ab) : ?>
                                            <a href="index.php?done_qltd=<?php echo $id; ?>" class="btn btn-primary">
                                                <i class="fa fa-check" aria-hidden="true"></i> Duyệt
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="index.php?edit_qltd=<?php echo $id; ?>" class='btn btn-success '>
                                            <i class="fa fa-edit"></i> Chỉnh Sửa
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?delete_qltd=<?php echo $id; ?>" class='btn btn-danger' onclick="return confirm('Xác nhận xóa?')">
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
                            <label for="expert-id" class="col-sm-3 control-label" require>Mã tuyển dụng</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="recruit">
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
                            <label for="expert-id" class="col-sm-3 control-label" require>Số lượng</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="quantity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Ngày tuyển</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Hạn chót</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="expire">
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
    $rec_id = $_POST['recruit'];
    $pos_id = $_POST['pos'];
    $qty = $_POST['quantity'];
    $date = $_POST['date'];
    $expire = $_POST['expire'];
    $status = 0;
    //Kiểm tra xem ID đã tồn tại hay chưa
    $get_soluong = "select * from recruit_manage where id = '$id'";
    $run_soluong = mysqli_query($conn, $get_soluong);
    $row_soluong = mysqli_fetch_array($run_soluong);
    if ($row_soluong) {
        echo "<script>alert('Mã tuyển dụng đã tồn tại')</script>";
    }
    //Thực hiện thêm dữ liệu từ các biến 
    $insert_rec = "insert into recruit_manage (recruit_id, position_id, quantity ,date_recruit, expired_recruit , status) 
                    VALUES ('$rec_id','$pos_id','$qty','$date','$expire','$status')";
    $run_rec = mysqli_query($conn, $insert_rec);
    if ($run_rec) {
        echo "<script>alert('Thêm thành công')</script>";
        echo "<script>window.open('index.php?view_qltd','_self')</script>";
    } else {
        echo "<script>alert('Thêm không thành công')</script>";
    }
}
?>