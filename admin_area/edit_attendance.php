<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php
    if(isset($_GET['edit_attendance'])){
        $d_id = $_GET['edit_attendance'];
        $query = "select * from attendance where id ='$d_id'";
        $run_edit = mysqli_query($conn,$query);
        $row_edit = mysqli_fetch_array($run_edit);
        
        $a_id = $row_edit['id'];
        $date = $row_edit['work_day'];
        $in = $row_edit['start_time'];
        $out = $row_edit['finish_time'];
    }
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> Trang tổng quan / Chỉnh sửa điểm danh
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh mục điểm danh
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="">
            		<input type="hidden" id="attid" name="id">
                    <div class="form-group">
                        <label for="datepicker_edit" class="col-sm-3 control-label">Ngày</label>

                        <div class="col-md-6">
                                <input value="<?php echo $date; ?>" name="date" type="date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_time_in" class="col-sm-3 control-label">Giờ làm việc</label>

                        <div class="col-md-6">
                                <input value="<?php echo $in; ?>" name="time_in" type="time" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_time_out" class="col-sm-3 control-label">Giờ tan ca</label>
                        <div class="col-md-6">
                                <input value="<?php echo $out; ?>" name="time_out" type="time" class="form-control">
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Trạng Thái</label>
                            <div class="col-md-6">
                                <select name="status" class="form-control"  required ><!--40-->
                                    <option>---Chọn trạng thái---</option>
                                    <?php
                                    $st1 = "Đúng giờ";
                                    $st0= "Đi trễ";
                                    $st2= "Vắng";
                                    
                                    echo"
                                    <option> $st1  </option>
                                    <option> $st0  </option>
                                    <option> $st2 </option>
                                    ";
                                    ?>  
                                </select>
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
    if(isset($_POST['update'])){
        $date = $_POST['date'];
        $time_in = $_POST['time_in'];
        $time_out = $_POST['time_out'];
        $get = $_POST['status'];
        if($get== "Đúng giờ"){
          $status =1;
        }else if($get== "Đi trễ"){
          $status =0;
        }
        else{
          $status = 2;
        }
        $update = "update attendance set work_day ='$date', start_time='$time_in', finish_time = 'time_out', status ='$status' where id='$a_id'";
        $run_p_cat = mysqli_query($conn,$update);
        if($run_p_cat){
            echo "<script>alert('Danh mục điểm danh của bạn đã được cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_attendance','_self')</script>";
        }
    }
?>

<?php } ?>