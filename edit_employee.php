<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <?php
    if (isset($_GET['edit_employee'])) {
        $id = $_GET['edit_employee'];
        $get_emp = "select * from users where id ='$id'";
        $run_emp = mysqli_query($conn, $get_emp);
        $row = mysqli_fetch_array($run_emp);
        $c_name = $row['full_name'];
        $c_email = $row['email'];
        $c_address = $row['address'];
        $c_phone = $row['phone'];
        $c_sex = $row['sex'];
        $c_birthday = $row['birthday'];
        $level = $row['id_level'];
        $pos = $row['id_position'];
        $sc = $row['id_schedule'];
        $get_empp = "select * from levels where id ='$level'";
        $run_empp = mysqli_query($conn, $get_empp);
        $rowp = mysqli_fetch_array($run_empp);
        $levels = $rowp['level_name'];

        $get_emps = "select * from position where id ='$pos'";
        $run_emps = mysqli_query($conn, $get_emps);
        $rows = mysqli_fetch_array($run_emps);
        $poss = $rows['position_name'];
        $get_empsc = "select * from schedule where id ='$sc'";
        $run_empsc = mysqli_query($conn, $get_empsc);
        $rowsc = mysqli_fetch_array($run_empsc);
        $in = $rowsc['time_in'];
        $out = $rowsc['time_out'];

        //Đổi kiểu time lịch làm việc
        $t_in = strtotime($in);
        $t_out = strtotime($out);
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Chỉnh sửa nhân viên</title>
    </head>

    <body>

        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Trang tổng quan / Chỉnh sửa nhân viên
                    </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-money fa-fw"></i> Chỉnh sửa nhân viên
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Tên nhân viên </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_name; ?>" name="name" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="employee" class="col-sm-3 control-label">Trình Độ</label>
                                <div class="col-md-6">
                                    <select name="level" class="form-control">
                                        <option value="<?php echo $level; ?>"> <?php echo $levels; ?></option>
                                        <option value="">Chọn trình độ</option>
                                        <?php
                                        $get_l = "SELECT * FROM levels";
                                        $run_l = mysqli_query($conn, $get_l);
                                        while ($row_l = mysqli_fetch_array($run_l)) {
                                            $l_id = $row_l['id'];
                                            $l_name = $row_l['level_name'];
                                            echo "<option value = '$l_id' >$l_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="employee" class="col-sm-3 control-label">Chức Vụ</label>
                                <div class="col-md-6">
                                    <select name="pos" class="form-control">
                                        <option value="<?php echo $pos; ?>"> <?php echo $poss; ?> </option>
                                        <option value="">Chọn vị trí</option>
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
                                <label for="employee" class="col-sm-3 control-label">Lịch Làm Việc</label>
                                <div class="col-md-6">
                                    <select name="sc" class="form-control">
                                        <option value="<?php echo $sc; ?>"><?php echo  date('h:i A', $t_in)  . ' - ' .  date('h:i A', $t_out); ?> </option>
                                        <option value="">Chọn lịch biểu</option>
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
                                            echo "<option value = '$s_id'>$s1 - $s2</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"> E-mail </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_email; ?>" name="email" type="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Địa chỉ </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_address; ?>" name="address" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Số điện thoại </label>
                                <div class="col-md-6">
                                    <input value="<?php echo  "0$c_phone"; ?>" name="phone" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Giới tính </label>
                                <?php
                                if ($c_sex == 0) {
                                    echo "<input type='radio' name='sex' id='gender' value='0' checked/>
                                            <label for='gender'>Nam</label>
                                            &emsp;&emsp;
                                            <input type='radio' name='sex' id='gender' value='1' />
                                            <label for='gender'>Nữ</label>";
                                } else {
                                    echo "<input type='radio' name='sex' id='gender' value='0' />
                                        <label for='gender'>Nam</label>
                                        &emsp;&emsp;
                                        <input type='radio' name='sex' id='gender' value='1' checked/>
                                        <label for='gender'>Nữ</label>";
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Ngày sinh </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_birthday; ?>" name="birthday" type="date" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <input name="update" value="Chỉnh sửa nhân viên" type="submit" class="btn btn-primary form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            });
        </script>
    </body>

    </html>

    <?php
    if (isset($_POST['update'])) {
        $idd = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];
        $l_id = $_POST['level'];
        $p_id = $_POST['pos'];
        $s_id = $_POST['sc'];
        $update_emp = "update users set full_name='$name',id_level='$l_id',id_position='$p_id',id_schedule='$s_id',email='$email',address='$address',phone='$phone',sex='$sex',birthday='$birthday' where id='$id'";
        $run_emp = mysqli_query($conn, $update_emp);

        if ($run_emp) {
            echo "<script>alert('Chỉnh sửa thành công')</script>";
            echo "<script>window.open('index.php?view_employee','_self')</script>";
        }
    }

    ?>
<?php
}
?>