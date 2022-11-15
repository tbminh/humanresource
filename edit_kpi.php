<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <?php
    if (isset($_GET['edit_kpi'])) {
        $edit_id = $_GET['edit_kpi'];
        $edit_ship_query = "select * from kpi where id='$edit_id'";
        $run_edit_ship = mysqli_query($conn, $edit_ship_query);
        $row_edit_ship = mysqli_fetch_array($run_edit_ship);

        $emp_name = $row_edit_ship['employ_name'];
        $id_kpi = $row_edit_ship['id_kpi'];
        $kpi_name = $row_edit_ship['kpi_name'];
        $unit = $row_edit_ship['unit'];
        $percent = $row_edit_ship['percent'];
        $target = $row_edit_ship['target'];
        $time = $row_edit_ship['time'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a>
                </li>
                <li class="active">Chỉnh Sửa KPI</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Chỉnh sửa KPI
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="POST">
                        <div class="modal-body">
                            <form action="" method="POST" class="form-horizontal">
                                <div class="form-group">
                                    <label for="employee" class="col-sm-3 control-label">Mã Nhân Viên</label>
                                    <div class="col-md-6">
                                        <select name="employ_id" class="form-control">
                                            <option> <?php echo $emp_name; ?> </option>
                                            <?php
                                            $get_emp = "SELECT * FROM users";
                                            $run_emp = mysqli_query($conn, $get_emp);
                                            while ($row_emp = mysqli_fetch_array($run_emp)) {
                                                $emp_id = $row_emp['id'];
                                                $employ_id = $row_emp['employee_id'];
                                                $emp_name = $row_emp['full_name'];
                                                echo "<option>  $emp_id - $employ_id - $emp_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="position-id" class="col-sm-3 control-label" required>Mã KPI </label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $id_kpi; ?>" type="text" class="form-control" name="id_kpi">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Tên KPI</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $kpi_name; ?>" type="text" class="form-control" name="kpi_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" require>Đơn Vị Tính</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $unit; ?>" type="text" class="form-control" name="unit">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Tỉ Trọng</label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $percent; ?>" type="text" class="form-control" name="percent">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Chỉ Tiêu Giao </label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo number_format($target); ?>" type="texy" step="any" class="form-control" name="target">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kpi-id" class="col-sm-3 control-label" required>Thời gian giao </label>
                                    <div class="col-sm-6">
                                        <input value="<?php echo $time; ?>" type="date" class="form-control" name="time">
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
            $emp_id = $_POST['employ_id'];
            $emp_name = $_POST['employ_id'];
            $id_kpi = $_POST['id_kpi'];
            $kpi_name = $_POST['kpi_name'];
            $unit = $_POST['unit'];
            $percent = $_POST['percent'];
            $target = $_POST['target'];
            $time = $_POST['time'];

            $update_ship = "update kpi set id_kpi='$id_kpi',kpi_name='$kpi_name',employ_id='$emp_id',full_name='$emp_name',unit='$unit',percent='$percent',target='$target',time='$time' where id='$edit_id'";
            $run_ship = mysqli_query($conn, $update_ship);
            if ($run_ship) {
                echo "<script>alert('KPI của bạn đã được cập nhật thành công')</script>";
                echo "<script>window.open('index.php?view_kpi','_self')</script>";
            }
        }
        ?>
    <?php } ?>