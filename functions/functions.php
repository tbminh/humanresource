<?php

$db = mysqli_connect("localhost", "root", "", "quanlynew");
mysqli_set_charset($db, 'UTF8');
///bat dau getRealIpUser function///
function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}

/// bat dau add cart///
function add_cart()
{
    global $db;
    if (isset($_GET['add_cart'])) {
        $ip_add = getRealIpUser();
        $p_id = $_GET['add_cart'];

        $product_qty = $_POST['product_qty'];
        $product_size = $_POST['product_size'];
        $check_product = "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($db, $check_product);
        $row_check = mysqli_fetch_array($run_check);
        $size = $row_check['size'];
        $qty = $row_check['qty'];
        $sl_update = $qty + $product_qty;
        $get_soluong = "select * from products where product_id = '$p_id'";
        $run_soluong = mysqli_query($db, $get_soluong);
        while ($row_soluong = mysqli_fetch_array($run_soluong)) {
            $soluong = $row_soluong['amount'];
            $soluong_update = $soluong - $product_qty;
        }
        if ($product_qty > $soluong == true) {
            echo "<script>alert('Mặc hàng này chỉ còn $soluong sản phẩm. Mong quý khách thông cảm!')</script>";
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            return false;
        } else if (mysqli_num_rows($run_check) > 0 and ($size != $product_size) == false) {
            $update_soluong = "update cart set qty='$sl_update' where ip_add='$ip_add' AND p_id='$p_id'";
            $run_update_soluong = mysqli_query($db, $update_soluong);
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
            return false;
        } else {
            $get_price = "select * from products where product_id='$p_id'";
            $run_price = mysqli_query($db, $get_price);
            $row_price = mysqli_fetch_array($run_price);
            $pro_price = $row_price['product_price'];
            $pro_sale = $row_price['product_sale'];
            $pro_label = $row_price['product_label'];
            if ($pro_label == "Giảm Giá") {
                $product_price = $pro_sale;
            } else {
                $product_price = $pro_price;
            }
            $query = "insert into cart (p_id,ip_add,qty,p_price,size) values ('$p_id','$ip_add','$product_qty','$product_price','$product_size')";
            $run_query = mysqli_query($db, $query);
            echo "<script>window.open('details.php?pro_id=$p_id','_self')</script>";
        }
        $update_sanpham = "update products set amount='$soluong_update' where product_id='$p_id'";
        $run_update_sanpham = mysqli_query($db, $update_sanpham);
    }
}

///ket thuc add cart///
///ket thuc getRealIpUser function///

///bat dau getRealIpUser function///
/// bat dau getPro functions ///

function getPro()
{

    global $db;

    $get_products = "select * from products order by 1 DESC LIMIT 0,8";

    $run_products = mysqli_query($db, $get_products);

    while ($row_products = mysqli_fetch_array($run_products)) {

        $pro_id = $row_products['product_id'];

        $pro_title = $row_products['product_title'];

        $pro_price = $row_products['product_price'];
        $product_price_format = number_format($pro_price, 0, ',', '.');
        $pro_sale_price = $row_products['product_sale'];
        $product_sale_format = number_format($pro_sale_price, 0, ',', '.');

        $pro_img1 = $row_products['product_img1'];
        $pro_label = $row_products['product_label'];
        if ($pro_label == "Giảm Giá") {
            $product_price = " <del> $product_price_format VND </del>";
            $product_sale_price = "/ $product_sale_format VND";
        } else {
            $product_price = " $product_price_format VND ";
            $product_sale_price = " ";
        }

        if ($pro_label == "") {
        } else {
            $product_label = "

                <a href='#' class='label $pro_label'>

                    <div class='theLabel'> $pro_label </div>
                    <div class='labelBackground'> </div>

                </a>

            ";
        }

        echo "
        
        <div class='col-md-4 col-sm-6 single'>
        
            <div class='product'>
            
                <a href='details.php?pro_id=$pro_id'>
                
                    <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                
                </a>
                
                <div class='text'>
                
                    <h3>
            
                        <a href='details.php?pro_id=$pro_id'>

                            $pro_title

                        </a>
                    
                    </h3>
                    
                    <p class='price'>
                    
                   $product_price &nbsp;$product_sale_price
                    
                    </p>
                    
                    <p class='button'>
                    
                        <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                            Xem chi tiết

                        </a>
                    
                        <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                            <i class='fa fa-shopping-cart'></i> Thêm vào giỏ

                        </a>
                    
                    </p>
                
                </div>

                $product_label
            
            </div>
        
        </div>
        
        ";
    }
}

/// ket thuc getPro functions ///

/// bat dau getPCats functions ///

function getPCats()
{

    global $db;

    $get_p_cats = "select * from product_categories";

    $run_p_cats = mysqli_query($db, $get_p_cats);

    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

        $p_cat_id = $row_p_cats['p_cat_id'];

        $p_cat_title = $row_p_cats['p_cat_title'];

        echo "
        
            <li>
            
                <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a>
            
            </li>
        
        ";
    }
}

/// ket thuc getPCats functions ///

/// bat dau getCats functions ///

function getCats()
{

    global $db;

    $get_cats = "select * from categories";

    $run_cats = mysqli_query($db, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {

        $cat_id = $row_cats['cat_id'];

        $cat_title = $row_cats['cat_title'];

        echo "
        
            <li>
            
                <a href='shop.php?cat=$cat_id'> $cat_title </a>
            
            </li>
        
        ";
    }
}

/// ket thuc getCats functions ///

/// bat dau getpcatpro functions ///

function getpcatpro()
{

    global $db;

    if (isset($_GET['p_cat'])) {

        $p_cat_id = $_GET['p_cat'];

        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";

        $run_p_cat = mysqli_query($db, $get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['p_cat_title'];

        $p_cat_desc = $row_p_cat['p_cat_desc'];

        $get_products = "select * from products where p_cat_id='$p_cat_id' LIMIT 0,6";

        $run_products = mysqli_query($db, $get_products);

        $count = mysqli_num_rows($run_products);

        if ($count == 0) {

            echo "
            
                <div class='box'>
                
                    <h1> Không tìm thấy sản phẩm nào trong danh mục này </h1>
                
                </div>
            
            ";
        } else {

            echo "
            
                <div class='box'>
                
                    <h1> $p_cat_title </h1>
                    
                    <p> $p_cat_desc </p>
                
                </div>
            
            ";
        }

        while ($row_products = mysqli_fetch_array($run_products)) {

            $pro_id = $row_products['product_id'];

            $pro_title = $row_products['product_title'];

            $pro_price = $row_products['product_price'];
            $product_price_format = number_format($pro_price, 0, ',', '.');


            $pro_sale_price = $row_products['product_sale'];
            $product_sale_format = number_format($pro_sale_price, 0, ',', '.');
            $pro_img1 = $row_products['product_img1'];
            $pro_label = $row_products['product_label'];
            if ($pro_label == "Giảm Giá") {
                $product_price = " <del> $product_price_format VND </del>";
                $product_sale_price = "/  $product_sale_format VND";
            } else {
                $product_price = " $product_price_format VND ";
                $product_sale_price = " ";
            }

            if ($pro_label == "") {
            } else {
                $product_label = "

                        <a href='#' class='label $pro_label'>

                            <div class='theLabel'> $pro_label </div>
                            <div class='labelBackground'> </div>

                        </a>

                    ";
            }

            echo "
                
                <div class='col-md-4 col-sm-6 center-responsive'>
                
                    <div class='product'>
                    
                        <a href='details.php?pro_id=$pro_id'>
                        
                            <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                        
                        </a>
                        
                        <div class='text'>
                        
                            <h3>
                    
                                <a href='details.php?pro_id=$pro_id'>

                                    $pro_title

                                </a>
                            
                            </h3>
                            
                            <p class='price'>
                            
                        $product_price &nbsp;$product_sale_price
                            
                            </p>
                            
                            <p class='button'>
                            
                                <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                                Chi tiết

                                </a>
                            
                                <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                                    <i class='fa fa-shopping-cart'></i> Thêm vào giỏ

                                </a>
                            
                            </p>
                        
                        </div>

                        $product_label
                    
                    </div>
                
                </div>
                
                ";
        }
    }
}

/// ket thuc getpcatpro functions ///
///bat dau getcatpro///


function getcatpro()
{
    global $db;
    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $get_cat = "select * from categories where cat_id='$cat_id'";
        $run_cat = mysqli_query($db, $get_cat);
        $row_cat = mysqli_fetch_array($run_cat);
        $cat_title = $row_cat['cat_title'];
        $cat_desc = $row_cat['cat_desc'];
        $get_cat = "select * from products where cat_id='$cat_id'";
        $run_products = mysqli_query($db, $get_cat);
        $count = mysqli_num_rows($run_products);
        if ($count == 0) {
            echo "
                    <div class='box'>
                        <h1> Không tìm thấy sản phẩm nào trong danh mục này </h1>
                    </div>
                ";
        } else {
            echo "
                    <div class='box'>
                        <h1> $cat_title </h1>
                        <p> $cat_desc </p>
                    </div>
                ";
        }
        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];

            $pro_title = $row_products['product_title'];

            $pro_price = $row_products['product_price'];
            $pro_sale_price = $row_products['product_sale'];
            $product_price_format = number_format($pro_price, 0, ',', '.');



            $product_sale_format = number_format($pro_sale_price, 0, ',', '.');
            $pro_img1 = $row_products['product_img1'];
            $pro_label = $row_products['product_label'];
            if ($pro_label == "Giảm Giá") {
                $product_price = " <del> $product_price_format VND </del>";
                $product_sale_price = "/ $product_sale_format VND";
            } else {
                $product_price = " $pro_sale_price VND ";
                $product_sale_price = " ";
            }

            if ($pro_label == "") {
            } else {
                $product_label = "

                        <a href='#' class='label $pro_label'>

                            <div class='theLabel'> $pro_label </div>
                            <div class='labelBackground'> </div>

                        </a>

                    ";
            }

            echo "
                
                <div class='col-md-4 col-sm-6 center-responsive'>
                
                    <div class='product'>
                    
                        <a href='details.php?pro_id=$pro_id'>
                        
                            <img class='img-responsive' src='admin_area/product_images/$pro_img1'>
                        
                        </a>
                        
                        <div class='text'>
                        
                            <h3>
                    
                                <a href='details.php?pro_id=$pro_id'>

                                    $pro_title

                                </a>
                            
                            </h3>
                            
                            <p class='price'>
                            
                        $product_price &nbsp;$product_sale_price
                            
                            </p>
                            
                            <p class='button'>
                            
                                <a class='btn btn-default' href='details.php?pro_id=$pro_id'>

                                Chi tiết

                                </a>
                            
                                <a class='btn btn-primary' href='details.php?pro_id=$pro_id'>

                                    <i class='fa fa-shopping-cart'></i> Thêm vào giỏ

                                </a>
                            
                            </p>
                        
                        </div>

                        $product_label
                    
                    </div>
                
                </div>
                
                ";
        }
    }
}
///ket thuc getcatpro///
///bat dau item///
function items()
{
    global $db;
    $ip_add = getRealIpUser();
    $get_items = "select * from cart where ip_add='$ip_add'";
    $run_items = mysqli_query($db, $get_items);
    $count_items = mysqli_num_rows($run_items);
    echo $count_items;
}

///ket thuc item///
///bat dau total_price ///
function total_price()
{
    global $db;
    $ip_add = getRealIpUser();
    $total = 0;
    $select_cart = "select * from cart where ip_add='$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);
    while ($record = mysqli_fetch_array($run_cart)) {
        $pro_id = $record['p_id'];
        $pro_qty = $record['qty'];
        $sub_total = $record['p_price'] * $pro_qty;
        $total += $sub_total;
    }
    echo  $total . ".000 VNĐ";
}
///ket thuc total_price///

function getsearch()
{
    global $db;
    $i = 0;
    if (isset($_GET['search'])) {
        $find = "%{$_GET['user_query']}%";

        $get_products = "SELECT lv.level_name, u.*, sc.time_in,sc.time_out,ps.position_name
            FROM users as u, levels as lv, schedule as sc, position as ps
            WHERE lv.id = u.id_level 
            AND sc.id = u.id_schedule
            AND ps.id = u.id_position	
            AND ( u.full_name like '$find' or u.email like'$find' or u.employee_id like'$find' or u.phone like'$find') ";

        $run_products = mysqli_query($db, $get_products);

        $count = mysqli_num_rows($run_products);
        echo $count;
        if ($count > 0) {
            while ($row_c = mysqli_fetch_array($run_products)) {
                $i++;
                $id = $row_c['id'];
                $c_id = $row_c['employee_id'];
                $name = $row_c['full_name'];
                $p_name = $row_c['position_name'];
                $lv_name = $row_c['level_name'];
                $in = $row_c['time_in'];
                $out = $row_c['time_out'];
                $c_email = $row_c['email'];
                //Đổi kiểu time lịch làm việc
                $t_in = strtotime($in);
                $t_out = strtotime($out);

                $ab = date('h:i A', $t_in)  . ' - ' .  date('h:i A', $t_out);
                echo "
                        <tbody>
                            <tr>
                                <td> $i </td>
                                <td> $c_id </td>
                                <td> $name </td>
                                <td> $p_name </td>
                                <td> $lv_name </td>
                                <td> $ab </td>
                                <td> $c_email </td>
                                <td> 
                                    <a href='index.php?edit_employee= $id 'class='btn btn-success btn-sm btn-flat edit'>
                                        <i class='fa fa-edit'></i> Edit
                                    </a>
                                </td>
                                <td> 
                                    <a href='index.php?delete_employee= $id ' class='btn btn-danger btn-sm btn-flat delete'>
                                        <i class='fa fa-trash'></i> Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>";
            }
        } else {
            echo "<script>alert('Không tìm thấy nhân viên nào')</script>";
            echo "<script>window.open('index.php?view_employee','_self')</script>";
        }
    }
}

function getatt_search()
{
    global $db;
    $i = 0;
    if (isset($_GET['attendance_search'])) {
        $find = "%{$_GET['att_query']}%";
        $get_att = "SELECT  u.*, sc.*, att.*
                                FROM users as u, schedule as sc, attendance as att
                                WHERE u.id = att.employ_id 
                                AND   u.id_schedule = sc.id
                                AND ( u.full_name like '$find' or u.employee_id like'$find' or u.phone like'$find') ";

        $run_products = mysqli_query($db, $get_att);

        $count = mysqli_num_rows($run_products);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($run_products)) {
                $i++;
                $a_id = $row['id'];
                $emp_id = $row['employee_id'];
                $name = $row['full_name'];
                $work = $row['work_day'];
                $sc_name = $row['schedule_name'];
                $start = $row['start_time'];
                $finish = $row['finish_time'];
                $status = ($row['status']);
                if ($status == 1) {
                    $status = '<span class="label label-warning pull-right">ontime</span>';
                } else if ($status == 0) {
                    $status = '<span class="label label-danger pull-right">late</span>';
                } else {
                    $status = '<span class="label label-default pull-right">absent</span>';
                }

                echo "
                    <tbody>
                        <tr>
                            <td> $i </td>
                            <td> $emp_id </td>
                            <td> $name </td>
                            <td> $work </td>
                            <td> $sc_name </td>
                            <td> $start . $status </td>
                            <td> $finish </td>
                            <td> 
                                <a href='index.php?edit_employee= $a_id 'class='btn btn-success btn-sm btn-flat edit'>
                                    <i class='fa fa-edit'></i> Edit
                                </a>
                            </td>
                            <td> 
                                <a href='index.php?delete_employee= $a_id ' class='btn btn-danger btn-sm btn-flat delete'>
                                    <i class='fa fa-trash'></i> Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>";
            }
        } else {
            echo "<script>alert('Không tìm thấy thông tin nào')</script>";
            echo "<script>window.open('index.php?view_attendance','_self')</script>";
        }
    }
}
