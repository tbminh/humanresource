<?php 
    if(!isset($_SESSION['admin_email'])){
        echo "<script>window.open('login.php','_self')</script>";
    }else{
?>

<?php
    if(isset($_GET['edit_position'])){
        $p_id = $_GET['edit_position'];
        $edit = "select * from position where id = '$p_id'";
        $run_edit = mysqli_query($conn,$edit);
        $row_edit = mysqli_fetch_array($run_edit);
        $id = $row_edit['id'];
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
                        <label for="" class="control-label col-md-3"> 
                            Tên chức vụ
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $name; ?>" name="cat_title" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            Lương chức vụ
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $coef; ?>" name="cat_desc" type="number" class="form-control">
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
    if(isset($_POST['update'])){
        $cat_title = $_POST['cat_title'];
        $cat_desc = $_POST['cat_desc'];
        $update_cat = "update position set position_name='$cat_title', basic_salary='$cat_desc' where id ='$p_id'";
        $run_cat = mysqli_query($conn,$update_cat);
        if($run_cat){
            echo "<script>alert('Danh mục chức vụ của bạn đã được cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_position','_self')</script>";
        }
        
    }
?>

<?php } ?>