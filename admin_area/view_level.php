<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<section class="content-header">
      <h1 style="color:blue;">
        Trình Độ
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Trình Độ</li>
      </ol>
</section>

<div class="box-header with-border"></div>
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
</div><br/>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thread>
                            <tr>
                                <th> STT </th>
                                <th> Mã trình độ </th>
                                <th> Tên trình độ </th>
                                <th> Mô tả trình độ </th>
                                <th scope="col" colspan="2" style="text-align: center;"> Tùy chọn </th>
                               
                            </tr>
                        </thread>
                        <tbody>
                            <?php
                                $i=0;
                                //Dùng lệnh SQL hiển thị thông tin trình độ
                                $get_coupons = "select * from levels";
                                $run_coupons = mysqli_query($conn,$get_coupons);
                                while($row_coupons=mysqli_fetch_array($run_coupons)){
                                    //Gán các giá trị nhận được từ lệnh SQl vào biến
                                    $id = $row_coupons['id'];
                                    $level_id = $row_coupons['level_id'];
                                    $level_name = $row_coupons['level_name'];
                                    $level_note = $row_coupons['level_note'];

                                    $i++;

                               
                            ?>
                            <tr>
                                <!-- Show các biến ra -->
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $level_id; ?></td>
                                    <td><?php echo  $level_name; ?></td>
                                    <td><?php echo $level_note; ?></td>
                                   
                                    <td>
                                        <a style="text" href="index.php?edit_level=<?php echo $level_id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>     
                                    </td>
                                    <td> 
                                        <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_level=<?php echo $level_id ?>">
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
<!-- MOdal thêm mới trình độ -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Thêm trình độ</b></h4>
          	</div>
          	<div class="modal-body">
            	<form action="" method="POST" class="form-horizontal" >

                    <div class="form-group">
                        <label for="expert-id" class="col-sm-3 control-label" require>Mã trình độ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="level_id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="expert-id" class="col-sm-3 control-label" require>Tên trình độ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="level_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expert-id" class="col-sm-3 control-label" require>Mô Tả</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="level_note">
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
//Nhận sự kiện nút name = 'add' 
    if(isset($_POST['add'])){
        //Gán các giá trị đã nhập trong modal vào các biến
        $l_id = $_POST['level_id'];
        $l_name = $_POST['level_name'];
        $l_note = $_POST['level_note'];

        
        //Thực hiện truy vấn dữ liệu
        $insert_level = "insert into levels(level_id,level_name,level_note) VALUES ('$l_id','$l_name','$l_note')";
        $run_level = mysqli_query($conn,$insert_level);
        if($run_level){
            echo "<script>alert('Bạn đã thêm trình độ thành công')</script>";
            echo "<script>window.open('index.php?view_level','_self')</script>";
        }
    }
?>