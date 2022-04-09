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
          <div class="row gutters-sm" style="width: 60%; margin-left: 300px;">
            <div class="col-md-4 col-md-6" style="padding-top:10px;">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $name;?></h4>
                      <p class="text-secondary mb-1"><?php echo $email;?></p>
                      <p class="text-muted font-size-sm"><?php echo $name_p;?></p>
                      <a href="index.php?change_pass=<?php echo $id; ?>" data-toggle="modal" class="btn btn-primary btn-block" style="width: 80%; margin-left:30px;"><i class="fa fa-key"></i><b>&nbsp; Đổi mật khẩu</b></a><br>  
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">github.com</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">instagram.com</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">facebook.com</span>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Cập Nhật Thông Tin -->
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <ul class="nav nav-pills" >
                              <li class="nav-item" style="background-color: #007BFF; border-radius: 5px;"><a class="nav-link active" href="#" style="color: cornsilk;">Thông tin cập nhật</a></li>
                    </ul>
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <br/><label for="">Họ và tên:</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên" value="<?php echo $name;?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="birthday">Trình Độ</label>
                                <input type="text" class="form-control" value="<?php echo $name_l;?>" disabled>
                            </div>

                            <div class="form-group ">
                                <label for="inputPhone">Chức Vụ</label>
                                <input type="text" class="form-control" value="<?php echo $name_p;?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="birthday">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                            </div>

                            <div class="form-group">
                                <label for="birthday">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                            </div>

                            <div class="form-group">
                                <label for="inputSex">Số Điện Thoại</label>
                                <input type="number" class="form-control" name="phone" value="<?php echo '0'.$phone;?>">
                            </div>

                            <div class="form-group">
                                <label for="inputSex">Ngày Sinh</label>
                                <input type="date" class="form-control" name="birthday" value="<?php echo $birthday;?>">
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-info" name="update">Cập nhật</button>
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
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];

    // Cập nhật thông tin
    $update = "update employee set email = '$email', address = '$address', phone='$phone', phone = '$phone'
                where id='$id'";
    $run = mysqli_query($conn,$update);
    if($run){
        echo "<script>alert('Cập nhật thông tin thành công!')</script>";
        echo "<script>window.open('index.php?employee_profile','_self')</script>";
    }
}
?>