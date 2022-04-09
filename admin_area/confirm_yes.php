<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php

    if (isset($_GET['confirm_yes'])) {
        $confirm_product_id = $_GET['confirm_yes'];
        $get_a = "select * from customer_orders where order_id = '$confirm_product_id'";
        $run_a = mysqli_query($con,$get_a);
        while($row_a=mysqli_fetch_array($run_a)){
        $invoice = $row_a['invoice_no'];
        $order_status = "Complete";
        }
        $update_customer_order = "update customer_orders set order_status='$order_status' where invoice_no='$invoice'";
        $row_update_customer_order = mysqli_query($con, $update_customer_order);

        if ($row_update_customer_order) {
            echo "<script>alert('Bạn đã xác nhận sản phẩm này đã thanh toán')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
        }
    
        
    }
?>


<?php } ?>
