<?php 
    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<section class="content-header">
      <h1 style="color:blue;">
        Khen Thưởng - Kỉ Luật
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Khen Thưởng - Kỉ Luật</li>
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
                                <th> Mã KT-KL </th>
                                <th> Tên KT-KL </th>
                                <th> Hình Thức KT-KL </th>
                                <th> Số tiền quy đổi </th>
                                <th scope="col" colspan="2" style="text-align: center;">Tùy chọn</th>  
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            $i=0;
                            $query = "SELECT * from ktkl";
                            $result = mysqli_query($conn,$query); 
                            while($row = mysqli_fetch_array($result))
                            {
                                $id = $row['id'];
                                $id_db = $row['id_db'];
                                $db_name = $row['db_name'];
                                $db_note = $row['db_note'];
                                $money = $row['money'];
                                $i++;
                        ?>
                            
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $id_db; ?></td>
                                <td><?php echo $db_name; ?></td>
                                <td><?php echo $db_note; ?></td>
                                <td><?php echo number_format($money).' VND'; ?></td>
                                <td>
                                    <a style="text" href="index.php?edit_ktkl=<?php echo $id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>     
                                </td>
                                <td> 
                                    <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_ktkl=<?php echo $id; ?>">
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
            	<h4 class="modal-title"><b>Thêm hình thức KT-KL</b></h4>
          	</div>
          	<div class="modal-body">
            	<form action="" method="POST" class="form-horizontal" >

                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Mã KTKL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="id">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Tên KTKL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Hình Thức KTKL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="note">
                            <!-- <textarea  type="text" name="money" id="" cols="30" rows="10" class="form-control"></textarea> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="depart-id" class="col-sm-3 control-label" require>Số tiền quy đổi</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control"  name="money">
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
<?php } ?>
<?php
    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $note = $_POST['note'];
        $money = $_POST['money'];

        
        //Thực hiện truy vấn dữ liệu
        $insert_depart = "insert INTO ktkl (id_db ,db_name,db_note, money) values ('$id','$name','$note','$money')";
        $run_depart = mysqli_query($conn,$insert_depart);
        if($run_depart){
            echo "<script>alert('Bạn đã thêm hình thức khen thưởng kỉ luật mới')</script>";
            echo "<script>window.open('index.php?view_ktkl','_self')</script>";
        }
    }
?>