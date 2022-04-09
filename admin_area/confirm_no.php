<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php

    if (isset($_GET['confirm_no'])) {
        
        $confirm_product_id = $_GET['confirm_no'];
      
        $get_b = "select * from customer_orders where order_id = '$confirm_product_id'";
        $run_b = mysqli_query($con,$get_b);
        while($row_b=mysqli_fetch_array($run_b)){
        $invoice = $row_b['invoice_no'];
        $order_status = "huy";
        $get_d = "select * from customer_orders where invoice_no='$invoice'";
        $run_d = mysqli_query($con,$get_d);
        while($row_d=mysqli_fetch_array($run_d)){
        $product_id = $row_d['product_id'];
        $qty = $row_d['qty'];
        $qti  = $qty- $qty;
        $get_c = "select * from products where product_id = '$product_id'";
        $run_c = mysqli_query($con,$get_c);
        $row_c=mysqli_fetch_array($run_c);
        $qtyi = $row_c['amount'];
        $soluong_update = $qtyi + $qty;
        $update_sanpham = "update products set amount='$soluong_update' where product_id='$product_id'";
        $run_update_sanpham= mysqli_query($con,$update_sanpham);
        }

       
        $update_customer_order = "update customer_orders set order_status='$order_status' where invoice_no='$invoice'";
        $row_update_customer_order = mysqli_query($con, $update_customer_order);

        $update_sanpham1 = "update pending_orders set qty='$qti' where invoice_no='$invoice'";
        $run_update_sanpham1= mysqli_query($con,$update_sanpham1);

        if ($row_update_customer_order) {
            echo "<script>alert('Bạn đã huỷ xác nhận sản phẩm này')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
            
           
        
        }
        
        
    }
    
}
?>

<?php } ?>
