<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php
    if(isset($_GET['delete_schedule'])){
        $delete_id = $_GET['delete_schedule'];
        $delete_cat = "delete from schedule where id='$delete_id'";
        $run_delete = mysqli_query($conn,$delete_cat);
        if($run_delete){
            echo "<script>alert('Một trong những danh mục lịch làm việc của bạn đã bị xóa')</script>";
            echo "<script>window.open('index.php?view_schedule','_self')</script>";
        }
    }
?>

<?php } ?>