<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" style="border-top: 3px solid #007bff;">
                        <div class="card-body box-profile text-center" style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); margin-bottom: 1rem;">
                            <span class="profile-picture">
                                <img class="editable img-responsive" alt=" Avatar" id="avatar2" style="margin-left: 0px;" src="https://png.pngtree.com/png-vector/20190501/ourmid/pngtree-users-icon-design-png-image_1014936.jpg" style="width:100px; height:100px;">
                            </span>

                            <div class="text-center">
                                <a href="#" class="d-block"><?php echo $admin_name ?></a>
                            </div>

                            <p class="text-muted text-center">
                                Quản trị viên
                            </p>

                            <a href="#update_p" data-toggle="modal" class="btn btn-primary btn-block" style="width: 80%; margin-left:30px;"><i class="fa fa-key"></i><b>Đổi mật khẩu</b></a><br>


                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <!-- /.card-header -->
                                <div class="card-body" style="box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%); margin-bottom: 1rem;">

                                    <br /><strong> <i class="fa fa-user"> </i> Họ và tên </strong>
                                    <p class="text-muted"><?php echo $admin_name ?></p>
                                    <hr>

                                    <strong><i class="fa fa-tags"></i> Địa chỉ</strong>
                                    <p class="text-muted"><?php echo $admin_country ?></p>
                                    <hr>

                                    <strong><i class="fa fa-phone"></i> Số điện thoại </strong>
                                    <p class="text-muted"><?php echo '0' . $admin_contact ?></p>

                                    <hr>

                                    <strong><i class="fa fa-file-text"></i> Email</strong>

                                    <p class="text-muted"><?php echo $admin_email ?></p><br>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- Hiển thị thông tin admin để chỉnh sửa -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item" style="background-color: #007BFF; border-radius: 5px;"><a class="nav-link active" href="#" style="color: cornsilk;">Thông tin cập nhật</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <br /><label for="admin_id">Họ và tên:</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $admin_name; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $admin_email; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Ngày sinh:</label>
                                    <input type="date" class="form-control" name="birthday" value="<?php echo $admin_birthday; ?>">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="expert-id" class="col-sm-2 control-label" style="padding-left: 0px !important;">Giới tính</label>
                                    <div class="col-sm-10">
                                        <?php
                                        if ($admin_gender == 'Nam') {
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
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for=""> Điện thoại </label>
                                    <input type="number" class="form-control" name="phone" value="<?php echo '0' . $admin_contact; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="admin_id">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $admin_country; ?>">
                                </div>

                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary" name="update_pr">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
    <!-- Đổi mật khẩu -->
    <div class="modal fade" id="update_p">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="text-align: center;"><b>Đổi mật khẩu</b></h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-horizontal">

                        <div class="form-group">
                            <label for="admin_id" class="col-sm-3 control-label" require>Mật Khẩu Cũ</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu cũ...." name="old">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="admin_id-id" class="col-sm-3 control-label" require>Mật Khẩu Mới</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu mới...." name="new">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="admin_id-id" class="col-sm-3 control-label" require> Xác Nhận Mật Khẩu</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" placeholder="Xác nhận mật khẩu...." name="confirm">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                            <button type="submit" class="btn btn-primary btn-flat" name="update_p"><i class="fa fa-save"></i> Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php }
?>
<?php
if (isset($_PUT['update_pr'])) {
    $email = $_PUT['email'];
    $birthday = $_PUT['birthday'];
    $gender = $_PUT['sex'];
    $phone = $_PUT['phone'];
    $address = $_PUT['address'];
    // Cập nhật thông tin
    $update = "update admins set email='$email',birthday = '$birthday', phone='$phone',address='$address',sex = '$gender'
                            where admin_id='$admin_id'";
    $run = mysqli_query($conn, $update);
    if ($run) {
        echo "<script>alert('Cập nhật thông tin thành công!')</script>";
        echo "<script>window.open('index.php?profile_admin','_self')</script>";
    }
}
?>
<?php
if (isset($_POST['update_p'])) {
    $old = $_POST['old'];
    $new = $_POST['new'];
    $old_md5 = md5($old);
    $new_md5 = md5($new);
    $confirm = $_POST['confirm'];

    if ($old == "" || $new == "" || $confirm == "") {
        echo "<script>alert('Hãy Điền đầy đủ thông tin!')</script>";
    } else if ($old_md5 != $admin_pass) {
        echo "<script>alert('Mật khẩu cũ nhập không chính xác, đảm bảo đã tắt caps lock!')</script>";
    } else if (strlen($new) < 6) {
        echo "<script>alert('Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn!')</script>";
    } else if ($new != $confirm) {
        echo "<script>alert('Xác nhận mật khẩu không đúng!')</script>";
    } else {
        $update_pass = "update users set pass='$new_md5' where id='$admin_id'";
        $run_pass = mysqli_query($conn, $update_pass);
        if ($run_pass) {
            echo "<script>alert('Đổi mật khẩu thành công!')</script>";
            echo "<script>window.open('index.php?profile_admin','_self')</script>";
        }
    }
}
?>