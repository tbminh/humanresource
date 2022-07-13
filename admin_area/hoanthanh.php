<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php
    if (isset($_GET['hoanthanh'])) {
        $confirm_product_id = $_GET['hoanthanh'];
        $order_status = '0';
        $update_customer_order = "update kpi set status_kpi='$order_status' where id='$confirm_product_id'";
        $row_update_customer_order = mysqli_query($conn, $update_customer_order);

        if ($row_update_customer_order) {
           
            echo "<script>window.open('index.php?view_kpi','_self')</script>";
        }
    }
?>

<?php } ?>

