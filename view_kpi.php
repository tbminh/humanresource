<?php include 'includes/header.php'; ?>
<?php

if (!isset($_SESSION['admin_email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {
?>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="color: blue;">
            Quản lý KPI
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản ký KPI</li>
          </ol>
        </section>
        <style>
          .topnav .search-container {
            float: right;
          }

          .topnav input[type=text] {
            padding: 6px;
            font-size: 17px;
            border: none;
          }

          .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
          }

          .topnav .search-container button:hover {
            background: #ccc;
          }
        </style>

        <div class="topnav">
          <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Thêm mới</a>
          <div class="search-container">
            <form method="get" action="index.php?kpi_search">
              <div class="search-container">
                <input type="text" placeholder="Search.." name="kpi_query" required>
                <button type="submit" name="kpi_search"><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div><br>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>STT</th>
                    <th>Mã KPI</th>
                    <th>Mã Nhân Viên</th>
                    <th>Tên KPI</th>
                    <th>Tháng giao</th>
                    <th>Tỉ trọng</th>
                    <th>Đơn vị tính</th>
                    <th>Đánh giá </th>
                    <th scope="col" colspan="2">Tùy chọn</th>
                  </thead>
                  <tbody>
                    <?php
                    $i = 0;
                    //Thực hiện truy vấn SQL show ra toàn bộ kpi
                    $query = "SELECT * from kpi ";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      //Gán các giá trị lấy được tự lệnh SQL vào các biến
                      $id = $row['id'];
                      $id_kpi = $row['id_kpi'];
                      $emp_id = $row['employ_id'];
                      $kpi_name = $row['kpi_name'];
                      $name = $row['full_name'];
                      $percent = $row['percent'];
                      $time = $row['time'];
                      $unit = $row['unit'];
                      $target = $row['target'];
                      $status = $row['status_kpi'];
                      $i++;

                      $date = strtotime($time);
                    ?>
                      <tr>
                        <!-- Show các biến ra ngoài -->
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $id_kpi; ?> </td>
                        <td> <?php echo $emp_id; ?> </td>
                        <td> <?php echo $kpi_name ?> </td>

                        <td> <?php echo date('m', $date) ?> </td>
                        <td><?php echo $percent; ?></td>
                        <td> <?php echo $unit; ?> </td>


                        <td>
                          <?php
                          $ab = '0';
                          $bc = '1';
                          if ($status == $bc) : ?>
                            <a href="index.php?hoanthanh=<?php echo $id; ?>" class="btn btn-warning">
                              <i class="fa fa-times-circle" aria-hidden="true"></i> Huỷ
                            </a>
                          <?php elseif ($status == $ab) : ?>
                            <a href="index.php?chuahoanthanh=<?php echo $id; ?>" class="btn btn-primary">
                              <i class="fa fa-check" aria-hidden="true"></i> Duyệt
                            </a>
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="index.php?edit_kpi=<?php echo $id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>
                        </td>

                        <td>
                          <a class='btn btn-danger btn-sm btn-flat delete' href="index.php?delete_kpi=<?php echo $id ?>" onclick="return confirm('Xác nhận xóa?')">
                            <i class="fa fa-trash"></i> Delete
                          </a>
                        </td>

                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    </div>
    <!-- Bảng thêm chức vụ mới -->
    <div class="modal fade" id="addnew">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Thêm mới KPI</b></h4>
          </div>
          <div class="modal-body">
            <form action="" method="POST" class="form-horizontal">
              <div class="form-group">
                <label for="employee" class="col-sm-3 control-label">Mã Nhân Viên</label>
                <div class="col-md-6">
                  <select name="employ_id" class="form-control">
                    <option>----- Chọn nhân viên -----</option>
                    <?php
                    //Truy vấn SQL hiển thị ra danh sách nhân viên
                    $get_emp = "SELECT * FROM users";
                    $run_emp = mysqli_query($conn, $get_emp);
                    while ($row_emp = mysqli_fetch_array($run_emp)) {
                      $emp_id = $row_emp['id'];
                      $employ_id = $row_emp['employee_id'];
                      $emp_name = $row_emp['full_name'];
                      echo "<option>  $emp_id - $employ_id - $emp_name</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>



              <div class="form-group">
                <label for="position-id" class="col-sm-3 control-label" required>Mã KPI </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="id_kpi">
                </div>
              </div>

              <div class="form-group">
                <label for="kpi-id" class="col-sm-3 control-label" required>Tên KPI</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="kpi_name">
                </div>
              </div>
              <div class="form-group">
                <label for="kpi-id" class="col-sm-3 control-label" require>Đơn Vị Tính</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="unit">
                </div>
              </div>
              <div class="form-group">
                <label for="kpi-id" class="col-sm-3 control-label" required>Tỉ Trọng</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="percent">
                </div>
              </div>

              <div class="form-group">
                <label for="kpi-id" class="col-sm-3 control-label" required>Thời gian giao </label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="time">
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Lưu</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

  <?php
  //Nhận sự kiện 'add' từ nút thêm của modal
  if (isset($_POST['add'])) {
    // Gán giá trị đã nhập vào các biến
    $emp_id = $_POST['employ_id'];
    $emp_name = $_POST['employ_id'];
    $id_kpi = $_POST['id_kpi'];
    $kpi_name = $_POST['kpi_name'];
    $unit = $_POST['unit'];
    $percent = $_POST['percent'];
    $target = 0;
    $time = $_POST['time'];

    //Thực hiện thêm dữ liệu từ các biến 
    $insert_p = "insert into kpi (id_kpi,kpi_name,employ_id,full_name,unit,percent,target,time ) VALUES ('$id_kpi','$kpi_name','$emp_id','$emp_name','$unit','$percent','$target','$time')";
    $run_p = mysqli_query($conn, $insert_p);
    //Báo lỗi khi nhập trùng mã nhân viên và email
    if ($run_p) {
      echo "<script>alert('Bạn đã thêm kpi thành công')</script>";
      echo "<script>window.open('index.php?view_kpi','_self')</script>";
    }
  }
  ?>