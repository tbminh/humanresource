<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
<?php
    if (isset($_GET['delete_list'])) {
        $delete_id = $_GET['delete_list'];
        $delete_d = "DELETE from recruit_list where id='$delete_id'";
        $run_delete = mysqli_query($conn, $delete_d);
        if ($run_delete) {
            echo "<script>alert('Đã xóa thành công!')</script>";
            echo "<script>window.open('index.php?view_list','_self')</script>";
        }
    }
?>
<?php } ?>