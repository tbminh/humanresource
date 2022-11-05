<?php 

    
    if(!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<?php
    if(isset($_GET['delete_ktkl'])){
        $delete_cat_id = $_GET['delete_ktkl'];
        $delete_cat = "delete from ktkl where id='$delete_cat_id'";
        $run_delete = mysqli_query($conn,$delete_cat);
        if($run_delete){
            echo "<script>alert('Một trong những danh mục kỷ luật của bạn đã bị xóa')</script>";
            echo "<script>window.open('index.php?view_ktkl','_self')</script>";
        }
    }
?>

<?php } ?>