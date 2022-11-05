<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php
    if(isset($_GET['edit_ktkl'])){
        $edit_id = $_GET['edit_ktkl'];
        $edit_ship_query = "select * from ktkl where id='$edit_id'";
        $run_edit_ship = mysqli_query($conn,$edit_ship_query);
        $row_edit_ship = mysqli_fetch_array($run_edit_ship);

        $id = $row_edit_ship['id'];
        $id_db = $row_edit_ship['id_db'];
        $db_name = $row_edit_ship['db_name'];
        $db_note = $row_edit_ship['db_note'];
        $money = $row_edit_ship['money'];
       
    }
?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
            <a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a>
            </li>
            <li class="active">Chỉnh Sửa Khen Thưởng - Kỉ Luật</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Chỉnh sửa danh mục kỷ luật
                </h3>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            Mã KTKL
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $id_db; ?>" name="id" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            Tên KTKL
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $db_name; ?>" name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                           Hình thức KTKL
                        </label>
                        <div class="col-md-6">
                            <textarea  type="text" name="note" id="" cols="30" rows="10" class="form-control"><?php echo $db_note; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                           Quy đổi thành tiền
                        </label>
                        <div class="col-md-6">
                            <input value="<?php echo $money; ?>" name="money" type="number" class="form-control"></div>
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
        $idd = $_POST['id'];
        $name = $_POST['name'];
        $note = $_POST['note'];
        $money = $_POST['money'];
       
        $update_ship = "update ktkl set id_db='$idd',db_name='$name',db_note='$note',money='$money' where id='$id'";
        $run_ship = mysqli_query($conn,$update_ship);
        if($run_ship){
            echo "<script>alert('Danh mục KTKL của bạn đã được cập nhật thành công')</script>";
            echo "<script>window.open('index.php?view_ktkl','_self')</script>";
        }
    }
?>
<?php } ?>