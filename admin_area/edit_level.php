<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <?php
    if (isset($_GET['edit_level'])) {
        $edit_cat = $_GET['edit_level'];
        $edit_cat_que = "SELECT * from levels where level_id ='$edit_cat'";
        $run_edit = mysqli_query($conn, $edit_cat_que);
        $row_edit = mysqli_fetch_array($run_edit);
        $level_id = $row_edit['level_id'];
        $level_title = $row_edit['level_name'];
        $level_desc = $row_edit['level_note'];
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> Trang tổng quan / Chỉnh sửa danh mục trình độ
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh mục trình độ
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label for="" class="control-label col-md-3">
                                Tên trình độ
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo $level_title; ?>" name="cat_title" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3">
                                Mô tả trình độ
                            </label>
                            <div class="col-md-6">
                                <textarea type="text" name="cat_desc" id="" cols="30" rows="10" class="form-control"><?php echo $level_desc; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label col-md-3">

                            </label>
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
        $cat_title = $_POST['cat_title'];
        $cat_desc = $_POST['cat_desc'];
        $update_cat = "UPDATE levels set level_name='$cat_title', level_note='$cat_desc' where level_id='$edit_cat'";
        $run_cat = mysqli_query($conn, $update_cat);
        if ($run_cat) {
            echo "<script>alert('Danh mục trình độ của bạn đã được cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_level','_self')</script>";
        }
    }
    ?>

<?php } ?>