<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
<?php
    if (isset($_GET['delete_qltd'])) {
        $delete_cat_id = $_GET['delete_qltd'];
        $delete_cat = "delete from recruit_manage where id = '$delete_cat_id'";
        $run_delete = mysqli_query($conn, $delete_cat);
        if ($run_delete) {
            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>window.open('index.php?view_qltd','_self')</script>";
        }
    }
?>
<?php } ?>