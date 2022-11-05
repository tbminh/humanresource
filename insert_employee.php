<?php
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Thêm nhân viên</title>
    
   
</head>
<body>
    
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Trang tổng quan / Thêm nhân viên
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Thêm nhân viên
                </h3>
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Tên nhân viên </label>
                        <div class="col-md-6">
                            <input name="c_name" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> E-mail </label>
                        <div class="col-md-6">
                        <input name="c_email" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Mật khẩu </label>
                        <div class="col-md-6">
                        <input name="c_pass" type="password" class="form-control" required>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Phòng ban </label>
                        <div class="col-md-6">
                            <select name="product_cat"  class="form-control">
                                <option> Chọn một danh mục phòng ban </option>
                                <?php
                                    $get_phongban = "select * from department";
                                    $run_phongban = mysqli_query($conn,$get_phongban);
                                    while($row_phongban=mysqli_fetch_array($run_phongban)){
                                        $phongban_id = $row_phongban['depart_id'];
                                        $phongban_title = $row_phongban['depart_name'];

                                        echo "
                                        <option value='$phongban_id'>  $phongban_title </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Chức vụ </label>
                        <div class="col-md-6">
                            <select name="product_cat"  class="form-control">
                                <option> Chọn một danh mục chức vụ </option>
                                <?php
                                    $get_chucvu = "select * from position";
                                    $run_chucvu = mysqli_query($con,$get_chucvu);
                                    while($row_chucvu=mysqli_fetch_array($run_chucvu)){
                                        $id_position = $row_chucvu['id_position'];
                                        $position_name = $row_chucvu['position_name'];

                                        echo "
                                        <option value='$id_position'>  $position_name </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Chuyên môn </label>
                        <div class="col-md-6">
                            <select name="product_cat"  class="form-control">
                                <option> Chọn một danh mục chuyên môn </option>
                                <?php
                                    $get_chuyenmon = "select * from expert";
                                    $run_chuyenmon = mysqli_query($con,$get_chuyenmon);
                                    while($row_chuyenmon=mysqli_fetch_array($run_chuyenmon)){
                                        $expert_id = $row_chuyenmon['expert_id'];
                                        $expert_name = $row_chuyenmon['expert_name'];

                                        echo "
                                        <option value='$expert_id'>  $expert_name </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Địa chỉ </label>
                        <div class="col-md-6">
                        <input name="c_address" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Liên hệ </label>
                        <div class="col-md-6">
                        <input name="c_contact" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Hình ảnh </label>
                        <div class="col-md-6">
                            <input name="c_image" type="file" class="form-control">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input name="submit" value="Thêm nhân viên" type="submit" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea'});</script>
</body>
</html>

<?php
//Nhận lệnh submit từ button ở file view_employee kèm theo các thông tin như họ tên, phòng ban, chức vụ,....
    if(isset($_POST['submit'])){
        //Gán các thông tin nhận được vào các biến
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_phongban = $_POST['c_phongban'];
        $c_chucvu = $_POST['c_chucvu'];
        $c_chuyenmon = $_POST['c_chuyenmon'];
        $c_lienhe = $_POST['c_contact'];
        $c_diachi = $_POST['c_address'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        
        move_uploaded_file( $c_image_tmp,"customer_image/$c_image");

        $get_soluong = "select * from customers";
        $run_soluong = mysqli_query($con, $get_soluong);
        while($row_soluong = mysqli_fetch_array($run_soluong)){
        $soluong = $row_soluong['customer_email'];

        
        if ($soluong ==  $c_email) {

            echo "<script>alert('Email đã có người dùng')</script>";

            exit();

        } }
        //Sau đó insert vào bảng 
        $insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_phongban,customer_chucvu,customer_contact,customer_address,customer_image,customer_chuyenmon) values ( '$c_name','$c_email','$c_pass','$c_phongban','$c_chucvu','$c_lienhe','$c_diachi','$c_image','$c_chuyenmon')";
        $run_customer = mysqli_query($con,$insert_customer);
        if($run_customer){
            echo "<script>alert('Bạn đã thêm nhân viên thành công')</script>";
            echo "<script>window.open('index.php?view_customers','_self')</script>";
        }
    }
?>

<?php
    }
?>