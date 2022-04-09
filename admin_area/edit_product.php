<?php
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{
?>
<?php
    if(isset($_GET['edit_product'])){
        $edit_id = $_GET['edit_product'];
        $get_p = "select * from products where product_id='$edit_id'";
        $run_edit = mysqli_query($con,$get_p);
        $row_edit = mysqli_fetch_array($run_edit);
        $p_id = $row_edit['product_id'];
        $p_title = $row_edit['product_title'];
        $p_sale= $row_edit['product_sale'];
        $p_sale_format = number_format((float)$p_sale, 0, ',', '.');
        $p_label= $row_edit['product_label'];
        $p_cat = $row_edit['p_cat_id'];
        $cat = $row_edit['cat_id'];
        $p_image1 = $row_edit['product_img1'];
        $p_image2 = $row_edit['product_img2'];
        $p_image3 = $row_edit['product_img3'];
        $p_price = $row_edit['product_price'];
        $p_price_format = number_format((float)$p_price, 0, ',', '.');

        $p_keywords = $row_edit['product_keywords'];
        $p_desc = $row_edit['product_desc'];
        $soluong = $row_edit['amount'];
        
    }
        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat'";
        $run_p_cat = mysqli_query($con,$get_p_cat);
        $row_p_cat = mysqli_fetch_array($run_p_cat);
        $p_cat_title = $row_p_cat['p_cat_title'];

        $get_cat = "select * from categories where cat_id='$cat'";
        $run_cat = mysqli_query($con,$get_cat);
        $row_cat = mysqli_fetch_array($run_cat);
        $cat_title = $row_cat['cat_title'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Insert Products</title>
    
   
</head>
<body>
    
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard / Edit Product
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money fa-fw"></i> Thêm sản phẩm
                </h3>
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Tiêu đề sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_title" type="text" class="form-control" required value="<?php echo $p_title; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Danh mục sản phẩm </label>
                        <div class="col-md-6">
                            <select name="product_cat"  class="form-control">
                                <option value="<?php echo $p_cat; ?>"> <?php echo $p_cat_title; ?> </option>
                                <?php
                                    $get_p_cats = "select * from product_categories";
                                    $run_p_cats = mysqli_query($con,$get_p_cats);
                                    while($row_p_cats=mysqli_fetch_array($run_p_cats)){
                                        $p_cat_id = $row_p_cats['p_cat_id'];
                                        $p_cat_title = $row_p_cats['p_cat_title'];

                                        echo "
                                        <option value='$p_cat_id'> $p_cat_title </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Loại </label>
                        <div class="col-md-6">
                            <select name="cat"  class="form-control">
                                <option value="<?php echo $cat; ?>"> <?php echo $cat_title; ?> </option>
                                <?php
                                    $get_cat = "select * from categories";
                                    $run_cat = mysqli_query($con,$get_cat);
                                    while($row_cat=mysqli_fetch_array($run_cat)){
                                        $cat_id = $row_cat['cat_id'];
                                        $cat_title = $row_cat['cat_title'];

                                        echo "
                                        <option value='$cat_id'> $cat_title </option>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Hình ảnh sản phẩm 1 </label>
                        <div class="col-md-6">
                            <input name="product_img1" type="file" class="form-control" >
                            <br>
                            <img width="250" height="300" src="product_images/<?php echo $p_image1; ?>" alt="<?php echo $p_image1; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Hình ảnh sản phẩm 2 </label>
                        <div class="col-md-6">
                            <input name="product_img2" type="file" class="form-control">
                            <br>
                            <img width="250" height="300" src="product_images/<?php echo $p_image2; ?>" alt="<?php echo $p_image2; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Hình ảnh sản phẩm 3 </label>
                        <div class="col-md-6">
                            <input name="product_img3" type="file" class="form-control">
                            <br>
                            <img width="250" height="300" src="product_images/<?php echo $p_image3; ?>" alt="<?php echo $p_image3; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Giá sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_price" type="text" class="form-control"  value="<?php echo $p_price_format; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Giảm giá sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_sale" type="text" class="form-control"  value="<?php echo  $p_sale_format; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Từ khoá sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_keywords" type="text" class="form-control"  value="<?php echo $p_keywords; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Mô tả sản phẩm </label>
                        <div class="col-md-6">
                            <textarea name="product_desc"  cols="19" rows="6" class="form-control" >
                                <?php echo $p_desc; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Số lượng sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_sl" type="number" class="form-control" value="<?php echo $soluong; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"> Nhãn sản phẩm </label>
                        <div class="col-md-6">
                            <input name="product_label" type="text" class="form-control"  value="<?php echo $p_label; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input name="update" value="Chỉnh sửa sản phẩm" type="submit" class="btn btn-primary form-control">
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
    if(isset($_POST['update'])){
    
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $cat = $_POST['cat'];
    
    $product_price = preg_replace("/[^0-9]/", "", $_POST['product_price']);
    $product_sale = preg_replace("/[^0-9]/", "", $_POST['product_sale']);

    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_desc'];
    $product_label = $_POST['product_label'];
    $product_sl = $_POST['product_sl'];
        
        

    
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];
    
    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];
    $temp_name3 = $_FILES['product_img3']['tmp_name'];
    
    move_uploaded_file($temp_name1,"product_images/$product_img1");
    move_uploaded_file($temp_name2,"product_images/$product_img2");
    move_uploaded_file($temp_name3,"product_images/$product_img3");
    
    if($temp_name1 != null AND $temp_name2 !=null AND $temp_name3!=null){
    $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',date=NOW(),product_title='$product_title',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_keywords='$product_keywords',product_desc='$product_desc',product_sale='$product_sale',product_label='$product_label',product_price='$product_price',amount='$product_sl' where product_id='$p_id'";
    
    $run_product = mysqli_query($con,$update_product);
    
    if($run_product){
        
    echo "<script>alert('Sản phẩm của bạn đã được cập nhật thành công')</script>"; 
        
    echo "<script>window.open('index.php?view_products','_self')</script>"; 
    }
    return false;
}else if($temp_name1 == null AND $temp_name2 ==null AND $temp_name3==null){
    $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',date=NOW(),product_title='$product_title',product_keywords='$product_keywords',product_desc='$product_desc',product_sale='$product_sale',product_label='$product_label',product_price='$product_price',amount='$product_sl' where product_id='$p_id'";
    
    $run_product = mysqli_query($con,$update_product);
    
    if($run_product){
        
    echo "<script>alert('Sản phẩm của bạn đã được cập nhật thành công')</script>"; 
        
    echo "<script>window.open('index.php?view_products','_self')</script>"; 
    }
    return false;
}else if($temp_name1 != null AND $temp_name2 ==null AND $temp_name3==null){
    $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',date=NOW(),product_title='$product_title',product_img1='$product_img1',product_keywords='$product_keywords',product_desc='$product_desc',product_sale='$product_sale',product_label='$product_label',product_price='$product_price',amount='$product_sl' where product_id='$p_id'";
    
    $run_product = mysqli_query($con,$update_product);
    
    if($run_product){
        
    echo "<script>alert('Sản phẩm của bạn đã được cập nhật thành công')</script>"; 
        
    echo "<script>window.open('index.php?view_products','_self')</script>"; 
    }
    return false;
}else if($temp_name1 == null AND $temp_name2 !=null AND $temp_name3==null){
    $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',date=NOW(),product_title='$product_title',product_img2='$product_img2',product_keywords='$product_keywords',product_desc='$product_desc',product_sale='$product_sale',product_label='$product_label',product_price='$product_price',amount='$product_sl' where product_id='$p_id'";
    
    $run_product = mysqli_query($con,$update_product);
    
    if($run_product){
        
    echo "<script>alert('Sản phẩm của bạn đã được cập nhật thành công')</script>"; 
        
    echo "<script>window.open('index.php?view_products','_self')</script>"; 
    }
    return false;
}else {
    $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',date=NOW(),product_title='$product_title',product_img3='$product_img3',product_keywords='$product_keywords',product_desc='$product_desc',product_sale='$product_sale',product_label='$product_label',product_price='$product_price',amount='$product_sl' where product_id='$p_id'";
    
    $run_product = mysqli_query($con,$update_product);
    
    if($run_product){
        
    echo "<script>alert('Sản phẩm của bạn đã được cập nhật thành công')</script>"; 
        
    echo "<script>window.open('index.php?view_products','_self')</script>"; 
    }
}
    


}


?>
<?php
}
?>
