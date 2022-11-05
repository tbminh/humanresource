<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> Trang tổng quan / Thêm danh mục khen thưởng
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Thêm danh mục khen thưởng
                </h3>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            Tên loại khen thưởng
                        </label>
                        <div class="col-md-6">
                            <input name="name_ship" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="" class="control-label col-md-3"> 
                            Hình thức khen thưởng
                        </label>
                        <div class="col-md-6">
                            
                            <textarea type="text" name="price_ship" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="" class="control-label col-md-3"> 
                            
                        </label>
                        <div class="col-md-6">
                        <input type="submit" name="submit"  value="Thêm" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['submit'])){
        $name_ship = $_POST['name_ship'];
        
        $price_ship = $_POST['price_ship'];

        $insert_ship = "insert into bonus (bonus_name,bonus_method) values ('$name_ship','$price_ship')";
        $run_box = mysqli_query($con,$insert_ship);

        echo "<script>alert('Thêm danh mục khen thưởng thành công')</script>";
        echo "<script>window.open('index.php?view_ships','_self')</script>";
        
    }
?>

<?php } ?>