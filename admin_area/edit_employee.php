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

        $c_id = $row['employee_id'];
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
                                <label class="col-md-3 control-label"> Mã Nhân viên </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_id; ?>" name="id" type="text" class="form-control" required>
                                </div>
                            </div>
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
                                        <option> <?php echo $levels; ?> </option>
                                        <?php
                                        $get_l = "SELECT * FROM levels";
                                        $run_l = mysqli_query($conn, $get_l);
                                        while ($row_l = mysqli_fetch_array($run_l)) {
                                            $l_id = $row_l['id'];
                                            $l_name = $row_l['level_name'];
                                            echo "<option>$l_id - $l_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="employee" class="col-sm-3 control-label">Chức Vụ</label>
                                <div class="col-md-6">
                                    <select name="pos" class="form-control">
                                        <option><?php echo $poss; ?> </option>
                                        <?php
                                        $get_l = "SELECT * FROM position";
                                        $run_l = mysqli_query($conn, $get_l);
                                        while ($row_l = mysqli_fetch_array($run_l)) {
                                            $l_id = $row_l['id'];
                                            $l_name = $row_l['position_name'];
                                            echo "<option>$l_id - $l_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="employee" class="col-sm-3 control-label">Lịch Làm Việc</label>
                                <div class="col-md-6">
                                    <select name="sc" class="form-control">
                                        <option> <?php echo  date('h:i A', $t_in)  . ' - ' .  date('h:i A', $t_out); ?> </option>
                                        <?php
                                        $get_l = "SELECT * FROM schedule";
                                        $run_l = mysqli_query($conn, $get_l);
                                        while ($row_l = mysqli_fetch_array($run_l)) {
                                            $s_id = $row_l['id'];
                                            $in = $row_l['time_in'];
                                            $out = $row_l['time_out'];
                                            $t_in = strtotime($in);
                                            $t_out = strtotime($out);
                                            $s1 = date('h:i A', $t_in);
                                            $s2 = date('h:i A', $t_out);
                                            echo "<option>$s_id -$s1 - $s2</option>";
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
                                    <input value="<?php echo $c_phone; ?>" name="phone" type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"> Giới tính </label>
                                <div class="col-md-6">
                                    <input value="<?php echo $c_sex; ?>" name="sex" type="text" class="form-control" required>
                                </div>
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
        $level = $_POST['level'];
        $pos = $_POST['pos'];
        $sc = $_POST['sc'];

        $update_emp = "update users set employee_id='$idd',full_name='$name',id_level='$level',id_position='$pos',id_schedule='$sc',email='$email',address='$address',phone='$phone',sex='$sex',birthday='$birthday' where id='$id'";
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