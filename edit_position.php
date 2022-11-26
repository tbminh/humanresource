<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

    <?php
    if (isset($_GET['edit_position'])) {
        $p_id = $_GET['edit_position'];
        $edit = "select p.*,d.depart_name from position as p, department as d
                 where p.depart_id = d.id 
                 and p.id = '$p_id'";
        $run_edit = mysqli_query($conn, $edit);
        $row_edit = mysqli_fetch_array($run_edit);
        $id = $row_edit['id'];
        $depart_id = $row_edit['depart_id'];
        $depart_name = $row_edit['depart_name'];
        $name = $row_edit['position_name'];
        $coef = $row_edit['basic_salary'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> Trang tổng quan / Chỉnh sửa danh mục chức vụ
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh mục chức vụ
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label">Đơn Vị</label>
                            <div class="col-md-6">
                                <select name="depart" class="form-control">
                                    <option value="<?php echo $depart_id; ?>"> <?php echo $depart_name; ?></option>
                                    <option value="">Chọn trình độ</option>
                                    <?php
                                    $get_l = "SELECT * FROM department";
                                    $run_l = mysqli_query($conn, $get_l);
                                    while ($row_l = mysqli_fetch_array($run_l)) {
                                        $d_id = $row_l['id'];
                                        $d_name = $row_l['depart_name'];
                                        echo "<option value = '$d_id' >$d_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3">
                                Tên chức vụ
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo $name; ?>" name="name" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3">
                                Lương chức vụ
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo $coef; ?>" name="coef" type="number" class="form-control">
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
        $d_id = $_POST['depart'];
        $name = $_POST['name'];
        $coef = $_POST['coef'];
        $update_cat = "update position set position_name='$name', basic_salary='$coef' where id ='$p_id'";
        $run_cat = mysqli_query($conn, $update_cat);
        if ($run_cat) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_position','_self')</script>";
        }
    }
    ?>

<?php } ?>