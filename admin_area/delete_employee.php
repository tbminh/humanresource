<?php


if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
<?php
    if (isset($_GET['delete_employee'])) {
        $delete_cat_id = $_GET['delete_employee'];
        $delete_cat = "delete from users where id='$delete_cat_id'";
        $run_delete = mysqli_query($conn, $delete_cat);
        if ($run_delete) {
            echo "<script>alert('Một trong những nhân viên đã bị xóa')</script>";
            echo "<script>window.open('index.php?view_employee','_self')</script>";
        }
    }
?>

<?php } ?>