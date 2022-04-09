<?php 
    
    if(!isset($_SESSION['email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<style>
  @import "bootstrap-social.less";
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
    }
    .main-body {
        padding: 15px;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
</style>

<div class="container">
    <div class="main-body"> 
          <div class="row gutters-sm" style="width: 60%; margin-left: 500px; ">
            <!-- Cập Nhật Thông Tin -->
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <a class="btn btn-primary btn-lg" role="button" href="#" style="margin-left:0px ;">ĐỔI MẬT KHẨU</a></li>
                    <form action="" method="post" enctype="multipart/form-data"><br/>
                        <div class="form-group">
                            <label for="employ_id">Mật Khẩu Cũ:</label>
                            <input type="password" class="form-control form-control-lg" name="old" placeholder="Nhập Mật Khẩu Cũ....." require>
                        </div>
                        <div class="form-group">
                            <label for="employ_id">Mật Khẩu Mới:</label>
                            <input type="password" class="form-control form-control-lg" name="new" placeholder="Nhập Mật Khẩu Mới....." require>
                        </div>
                        <div class="form-group">
                            <label for="employ_id">Xác Nhận Mật Khẩu:</label>
                            <input type="password" class="form-control form-control-lg" name="confirm" placeholder="Xác Nhận Mật Khẩu....." require>
                        </div>
                        <div class="form-group text-right">
                            <button button type="submit" class="btn btn-primary btn-flat" name="update"><i class="fa fa-save"></i> Lưu</button>
                        </div>
                    </form>
                </div>
              </div>

            </div>
          </div>

        </div>
    </div>
    
<?php } 
?>
<?php
    if(isset($_POST['update'])){
        $old = $_POST['old'];
        $new = $_POST['new'];
        $confirm = $_POST['confirm'];

        if ($old == "" || $new =="" || $confirm==""){
            echo "<script>alert('Hãy Điền đầy đủ thông tin!')</script>";
        }
        else if($old != $pass){
            echo "<script>alert('Mật khẩu cũ nhập không chính xác, đảm bảo đã tắt caps lock!')</script>";
        }
        
        else if (strlen($new) < 6)
        {
            echo "<script>alert('Mật khẩu quá ngắn, hãy thử với mật khẩu khác an toàn hơn!')</script>";
        }
        else if($new != $confirm){
            echo "<script>alert('Xác nhận mật khẩu không đúng!')</script>";
        }
        else{
            $update_ship = "update employee set pass='$new' where id='$id'";
            $run_ship = mysqli_query($conn,$update_ship);
            if($run_ship){
                echo "<script>alert('Đổi mật khẩu thành công')</script>";
                echo "<script>window.open('index.php?employee_profile','_self')</script>";
            }
        }
    }
?>