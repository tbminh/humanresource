<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <?php
    if (isset($_GET['edit_qltd'])) {
        $edit_id = $_GET['edit_qltd'];
        $edit_ship_query = "select * from recruit_manage where id='$edit_id'";
        $run_edit_ship = mysqli_query($conn, $edit_ship_query);
        $row_edit_ship = mysqli_fetch_array($run_edit_ship);

        $rc_id = $row_edit_ship['recruit_id'];
        $pos_id = $row_edit_ship['position_id'];
        $qty = $row_edit_ship['quantity'];
        $date = $row_edit_ship['date_recruit'];
        $expire = $row_edit_ship['expired_recruit'];
        $status = $row_edit_ship['status'];
        //Lấy tên chức vụ
        $get_emps = "select * from position where id ='$pos_id'";
        $run_emps = mysqli_query($conn, $get_emps);
        $rows = mysqli_fetch_array($run_emps);
        $poss = $rows['position_name'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Chỉnh Sửa Tuyển Dụng</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh mục tuyển dụng
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="POST">
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label for="position-id" class="col-sm-3 control-label" required>Mã tuyển dụng </label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $rc_id; ?>" type="text" class="form-control" name="rc_id">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="employee" class="col-sm-3 control-label">Chức Vụ</label>
                                    <div class="col-md-6">
                                        <select name="pos" class="form-control">
                                            <option value="<?php echo $pos_id; ?>"> <?php echo $poss; ?> </option>
                                            <option value="">---------- Chọn vị trí ----------</option>
                                            <?php
                                            $get_p = "SELECT * FROM position";
                                            $run_p = mysqli_query($conn, $get_p);
                                            while ($row_p = mysqli_fetch_array($run_p)) {
                                                $p_id = $row_p['id'];
                                                $p_name = $row_p['position_name'];
                                                echo "<option value ='$p_id' >$p_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" require>Số lượng</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $qty; ?>" type="number" class="form-control" name="qty">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Ngày đăng tuyển</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $date; ?>" type="date" class="form-control" name="date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Hạn chót</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $expire; ?>" type="date" class="form-control" name="expire">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Trạng thái</label>
                                    <div class="col-sm-6">
                                        <?php
                                        if ($status == 0) : ?>
                                            <input value="Chưa tuyển đủ" type="text" class="form-control" disabled>
                                        <?php else : ?>
                                            <input value="Đã tuyển đủ" type="text" class="form-control" disabled>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-3"></label>
                                    <div class="col-md-6">
                                        <input value="Cập nhật" name="update" type="submit" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['update'])) {
            $rc_id = $_POST['rc_id'];
            $pos_id = $_POST['pos'];
            $qty = $_POST['qty'];
            $date = $_POST['date'];
            $expire = $_POST['expire'];
            // echo "$rc_id - $pos_id - $qty - $date - $expire";

            $update_ship = "update recruit_manage set recruit_id='$rc_id',position_id ='$pos_id',quantity='$qty',date_recruit='$date',expired_recruit='$expire' where id='$edit_id'";
            $run_ship = mysqli_query($conn, $update_ship);
            if ($run_ship) {
                echo "<script>alert('Cập nhật thành công')</script>";
                echo "<script>window.open('index.php?view_qltd','_self')</script>";
            }
        }
        ?>
    <?php } ?>