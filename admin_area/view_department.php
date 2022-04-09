<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<section class="content-header">
      <h1 style="color:blue;">
        Phòng Ban
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Phòng Ban</li>
      </ol>

</section>
<div class="box-header with-border"></div>
            <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
</div><br/>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> STT </th>
                                <th> Mã phòng ban </th>
                                <th> Tên phòng ban </th>
                                <th> Mô tả phòng ban </th>
                                <th scope="col" colspan="2" style="text-align: center;">Tùy chọn</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                $get_p = "select * from department";
                                $run_p = mysqli_query($conn,$get_p);
                                while($row_p=mysqli_fetch_array($run_p)){
                                    $id = $row_p['id'];
                                    $d_id = $row_p['department_id'];
                                    $d_title = $row_p['depart_name'];
                                    $d_desc = $row_p['depart_note'];
                                    $i++;
                                
                            ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $d_id; ?> </td>
                                <td> <?php echo $d_title; ?> </td>
                                <td width="300"><?php echo $d_desc; ?></td>
                                <td>
                                    <a style="text" href="index.php?edit_depart=<?php echo $id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>     
                                </td>
                                <td> 
                                    <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_depart=<?php echo $id; ?>">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                            <?php }?>
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
            	<h4 class="modal-title"><b>Thêm phòng ban</b></h4>
          	</div>
          	<div class="modal-body">
            	<form action="" method="POST" class="form-horizontal" >

                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Mã Phòng Ban</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="depart_id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Tên Phòng Ban</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="depart_name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Mô Tả</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="depart_note">
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
<?php } 
    ?>
<?php
    if(isset($_POST['add'])){
        $id = $_POST['depart_id'];
        $d_name = $_POST['depart_name'];
        $d_note = $_POST['depart_note'];

        
        //Thực hiện thêm dữ liệu
        $insert_depart = "INSERT INTO department(depart_id,depart_name,depart_note) VALUES ('$id','$d_name','$d_note')";
        $run_depart = mysqli_query($conn,$insert_depart);
        if($run_depart){
            echo "<script>alert('Bạn đã thêm phòng ban thành công')</script>";
            echo "<script>window.open('index.php?view_department','_self')</script>";
        }
    }
?>