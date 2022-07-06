<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <section class="content-header">
        <h1 style="color:blue;">
            Lịch Làm Việc
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Lịch Làm Việc</li>
        </ol>
    </section>

    <div class="box-header with-border"></div>
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
    </div><br />

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thread>
                            <tr>
                                <th> STT </th>
                                <th> Mã lịch </th>
                                <th> Giờ vào việc </th>
                                <th> Giờ tan ca </th>
                                <th scope="col" colspan="2" style="text-align: center; width: 25%;"> Tùy chọn </th>

                            </tr>
                        </thread>
                        <tbody>
                            <?php
                            $i = 0;
                            //Truy vấn SQL hiển thị lịch làm việc
                            $get_s = "select * from schedule";
                            $run_s = mysqli_query($conn, $get_s);
                            while ($row = mysqli_fetch_array($run_s)) {
                                $id = $row['id'];
                                $s_id = $row['schedule_id'];
                                $in = $row['time_in'];
                                $out = $row['time_out'];
                                $i++;
                            ?>
                                <tr>
                                    <!-- Show các biến thông tin lịch làm việc ra ngoài -->
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $s_id; ?></td>
                                    <td><?php echo $in . " AM"; ?></td>
                                    <td><?php echo $out . " PM" ?></td>
                                    <td>
                                        <a style="text" href="index.php?edit_schedule=<?php echo $id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>
                                    </td>
                                    <td>
                                        <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_schedule=<?php echo $id ?>" onclick="return confirm('Xác nhận xóa?')">
                                            <i class="fa fa-trash"></i> Delete
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
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><b>Thêm lịch làm việc</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Mã lịch</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="id">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Giờ làm việc</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" name="time_in">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="expert-id" class="col-sm-3 control-label" require>Giờ tan ca</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" name="time_out">
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
}
?>
<?php
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $in = $_POST['time_in'];
    $out = $_POST['time_out'];

    //Thực hiện truy vấn dữ liệu
    $insert_s = "insert into schedule(schedule_id,time_in,time_out) VALUES ('$id','$in','$out')";
    $run_s = mysqli_query($conn, $insert_s);
    if ($run_s) {
        echo "<script>alert('Bạn đã thêm lịch thành công')</script>";
        echo "<script>window.open('index.php?view_schedule','_self')</script>";
    }
}
?>