<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <?php
    if (isset($_GET['edit_list'])) {
        $edit_id = $_GET['edit_list'];
        $edit_ship_query = "SELECT rl.* FROM recruit_list as rl where id='$edit_id'";
        $run_edit_ship = mysqli_query($conn, $edit_ship_query);
        $row_edit_ship = mysqli_fetch_array($run_edit_ship);

        $rc_id = $row_edit_ship['recruitment_id'];
        $name = $row_edit_ship['apply_name'];
        $phone = $row_edit_ship['apply_phone'];
        $gender = $row_edit_ship['gender'];
        $birthday = $row_edit_ship['apply_birthday'];
        $email = $row_edit_ship['apply_email'];
        $date = $row_edit_ship['apply_date'];
        $status = $row_edit_ship['apply_status'];
        //Lấy tên chức vụ
        $get_emps = "SELECT ps.position_name, rec.position_id, list.recruitment_id
                    FROM position as ps, recruit_manage as rec, recruit_list as list
                    WHERE ps.id = rec.position_id
                    AND rec.id = list.recruitment_id
                    AND list.id = $edit_id";
        $run_emps = mysqli_query($conn, $get_emps);
        $rows = mysqli_fetch_array($run_emps);
        $poss = $rows['position_name'];
        $p_id = $rows['position_id'];
        $id = $rows['recruitment_id'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Chỉnh Sửa Danh sách</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh sách ứng viên
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="modal-body">
                        <form action="" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <label for="employee" class="col-sm-3 control-label">Chức Vụ</label>
                                <div class="col-md-6">
                                    <select name="rec" class="form-control">
                                        <option value="<?php echo $id; ?>"> <?php echo "$rc_id - $poss";  ?> </option>
                                        <option value="">---------- Chọn mã tuyển dụng ----------</option>
                                        <?php
                                        $get_p = "SELECT ps.position_name, rec.position_id, list.recruitment_id
                                                    FROM position as ps, recruit_manage as rec, recruit_list as list
                                                    WHERE ps.id = rec.position_id
                                                    AND rec.id = list.recruitment_id";
                                        $run_p = mysqli_query($conn, $get_p);
                                        while ($row_p = mysqli_fetch_array($run_p)) {
                                            $id = $row_p['recruitment_id'];
                                            $p_name = $row_p['position_name'];
                                            echo "<option value ='$id' >$rc_id - $p_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" require>Tên Ứng Viên</label>
                                <div class="col-sm-6">
                                    <input value="<?php echo $name; ?>" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" require>Điện thoại</label>
                                <div class="col-sm-6">
                                    <input value="<?php echo $phone; ?>" type="text" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" required>Ngày sinh</label>
                                <div class="col-sm-6">
                                    <input value="<?php echo $birthday; ?>" type="date" class="form-control" name="birthday">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" required>Email</label>
                                <div class="col-sm-6">
                                    <input value="<?php echo $email; ?>" type="email" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" required>Giới tính</label>
                                <?php
                                if ($gender == 'Nam') {
                                    echo "<input type='radio' name='sex' id='gender' value='Nam' checked/>
                                            <label for='gender'>Nam</label>
                                            &emsp;&emsp;
                                            <input type='radio' name='sex' id='gender' value='Nữ' />
                                            <label for='gender'>Nữ</label>";
                                } else {
                                    echo "<input type='radio' name='sex' id='gender' value='Nam' />
                                        <label for='gender'>Nam</label>
                                        &emsp;&emsp;
                                        <input type='radio' name='sex' id='gender' value='Nữ' checked/>
                                        <label for='gender'>Nữ</label>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" required>Ngày nộp đơn</label>
                                <div class="col-sm-6">
                                    <input value="<?php echo $date; ?>" type="date" class="form-control" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kpi-id" class="col-sm-3 control-label" required>Trạng thái</label>
                                <div class="col-sm-6">
                                    <select name="status" class="form-control">
                                        <?php
                                        if ($status == 0) : ?>
                                            <option value="0">Chưa phỏng vấn</b></option>
                                        <?php elseif ($status == 1) : ?>
                                            <option value="1">Đã phỏng vấn</b></option>
                                        <?php elseif ($status == 2) : ?>
                                            <option value="2">Đã đậu</b></option>
                                        <?php else : ?>
                                            <option value="3">Chưa đậu</b></option>
                                        <?php endif; ?>
                                        <option value="">---------- Chọn trạng thái ----------</option>
                                        <option value="0">Chưa phỏng vấn</b></option>
                                        <option value="1">Đã phỏng vấn</b></option>
                                        <option value="2">Đã đậu</b></option>
                                        <option value="3">Chưa đậu</b></option>
                                    </select>
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
            $rc_id = $_POST['rec'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $birthday = $_POST['birthday'];
            $email = $_POST['email'];
            $sex = $_POST['sex'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            echo "$rc_id - $name - $phone - $birthday - $email - $sex - $date - $status";

            $update_ship = "update recruit_list set
                                    recruitment_id='$rc_id',
                                    apply_name ='$name',
                                    apply_phone='$phone',
                                    gender='$sex',
                                    apply_birthday='$birthday',
                                    apply_email='$email',
                                    apply_date='$date',
                                    apply_status='$status'
                                where id='$edit_id'";
            $run_ship = mysqli_query($conn, $update_ship);
            if ($run_ship) {
                echo "<script>alert('Cập nhật thành công')</script>";
                echo "<script>window.open('index.php?view_list','_self')</script>";
            } else {
                echo "<script>alert('Cập nhật thất bại')</script>";
            }
        }
        ?>
    <?php } ?>