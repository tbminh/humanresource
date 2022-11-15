<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <section class="content-header">
        <h1 style="color:blue;">
            Chức Vụ
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Chức Vụ</li>
        </ol>
    </section>
    <div class="box-header with-border"></div>
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th> Mã phòng ban</th>
                                <th> Mã chức vụ </th>
                                <th> Tên chức vụ </th>
                                <th> Luơng chức vu </th>
                                <th scope="col" colspan="2" style="text-align: center;"> Tùy chọn </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            //Hiển thị thông tin phòng ban và chức vụ
                            $get_p = "SELECT dp.*, ps.*
                                        FROM department as dp, position as ps
                                        WHERE dp.id = ps.depart_id";
                            $run_p = mysqli_query($conn, $get_p);
                            while ($row = mysqli_fetch_assoc($run_p)) {
                                //Gán các giá trị nhận được từ lệnh SQL vào biến
                                $id = $row['id'];
                                $d_id = $row['department_id'];
                                $p_id = $row['position_id'];
                                $p_name = $row['position_name'];
                                $p_coef = $row['basic_salary'];
                                $i++;
                            ?>
                                <tr>
                                    <!-- Hiển thị các biến -->
                                    <td> <?php echo $i; ?> </td>
                                    <td> <?php echo $d_id; ?> </td>
                                    <td> <?php echo $p_id; ?> </td>
                                    <td> <?php echo $p_name; ?> </td>
                                    <td> <?php echo number_format($p_coef) . ' VND'; ?></td>
                                    <td>
                                        <a style="text" href="index.php?edit_position=<?php echo $id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>
                                    </td>
                                    <td>
                                        <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_position=<?php echo $id; ?>">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Bảng thêm chức vụ mới -->
    <div class="modal fade" id="addnew">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Thêm chức vụ</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">

                        <div class="form-group">
                            <label for="position-id" class="col-sm-3 control-label" require>Mã Chức Vụ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id_position">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position-id" class="col-sm-3 control-label" require>Tên Chức Vụ</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="p_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="employee" class="col-sm-3 control-label" required>Phòng Ban </label>
                            <div class="col-md-6">
                                <select name="dep" class="form-control" required>
                                    <option>--------- Phòng ban Nhân Viên ---------</option>
                                    <?php
                                    //Truy vấn SQL hiển thị ra thông tin phòng ban
                                    $get_l = "SELECT * FROM department";
                                    $run_l = mysqli_query($conn, $get_l);
                                    while ($row_l = mysqli_fetch_array($run_l)) {
                                        $l_id = $row_l['department_id'];
                                        $l_name = $row_l['depart_name'];
                                        echo "<option>$l_id - $l_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position-id" class="col-sm-3 control-label" require>Lương chức vụ</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="p_coef">
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
<?php } ?>

<?php
//Nhận sự kiện 'add' từ nút thêm của modal
if (isset($_POST['add'])) {
    // Gán giá trị đã nhập vào các biến
    $id = $_POST['id_position'];
    $name = $_POST['p_name'];
    $depart = $_POST['dep'];
    $coef = $_POST['p_coef'];

    //Thực hiện truy vấn dữ liệu
    $insert_p = "insert into position (position_id,depart_id,position_name,basic_salary) VALUES ('$id','$depart','$name','$coef')";
    $run_p = mysqli_query($conn, $insert_p);
    if ($run_p) {
        echo "<script>alert('Bạn đã thêm chức vụ thành công')</script>";
        echo "<script>window.open('index.php?view_position','_self')</script>";
    }
}
?>