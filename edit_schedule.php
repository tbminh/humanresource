<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php
    if(isset($_GET['edit_schedule'])){
        $edit_cat = $_GET['edit_schedule'];
        $edit_cat_que = "select * from schedule where id='$edit_cat'";
        $run_edit = mysqli_query($conn,$edit_cat_que);
        $row_edit = mysqli_fetch_array($run_edit);
        $schedule_id = $row_edit['id'];
        $in = $row_edit['time_in'];
        $out = $row_edit['time_out'];
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
                            Giờ làm việc
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $in; ?>" name="time_in" type="time" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            Giờ tan ca
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $out; ?>" name="time_out" type="time" class="form-control">
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
        $in = $_POST['time_in'];
        $out = $_POST['time_out'];
        $update_cat = "update schedule set time_in='$in',time_out='$out' where id='$schedule_id'";
        $run_cat = mysqli_query($conn,$update_cat);
        if($run_cat){
            echo "<script>alert('Danh mục lịch của bạn đã được cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_schedule','_self')</script>";
        }
        
    }
?>

<?php } ?>