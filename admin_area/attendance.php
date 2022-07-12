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
          <h1>
            Điểm danh
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Điểm danh</li>
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
            <form method="get" action="index.php?attendance_search">
              <input type="text" placeholder="Search.." name="att_query">
              <button type="submit" name="attendance_search"><i class="fa fa-search"></i></button>
            </form>
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
                      <th>Mã Nhân Viên</th>
                      <th>Họ Tên</th>
                      <th>Ngày</th>
                      <th>Ca làm</th>
                      <th>Giờ vào ca</th>
                      <th>Giờ tan ca</th>
                      <th scope="col" colspan="2">Tùy chọn</th>
                    </thead>

                    <tbody>
                      <?php
                      $i = 0;
                      //Truy vấn lấy thông tin chấm công theo từng nhân viên
                      $query = "SELECT u.*, att.*, sc.schedule_name
                              FROM users as u, attendance as att, schedule as sc
                              WHERE u.id = att.employ_id
                                    AND u.id_schedule = sc.id
                              ORDER BY att.id DESC";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        //Gán thông tin lấy được vào các biến
                        $a_id = $row['id'];
                        $emp_id = $row['employee_id'];
                        $name = $row['full_name'];
                        $work = $row['work_day'];
                        $sc_name = $row['schedule_name'];
                        $start = $row['start_time'];
                        $finish = $row['finish_time'];
                        $status = ($row['status']);
                        // ?'<span class="label label-warning pull-right">ontime</span>':'<span class="label label-danger pull-right">late</span>';   
                        if ($status == 1) {
                          $status = '<span class="label label-warning pull-right">ontime</span>';
                        } else if ($status == 0) {
                          $status = '<span class="label label-danger pull-right">late</span>';
                        } else {
                          $status = '<span class="label label-default pull-right">absent</span>';
                        }
                        $i++;
                      ?>
                        <tr>
                          <!-- In ra thông tin -->
                          <td> <?php echo $i; ?> </td>
                          <td> <?php echo $emp_id ?> </td>
                          <td> <?php echo $name ?> </td>
                          <td> <?php echo $work ?> </td>
                          <td> <?php echo $sc_name ?> </td>
                          <td> <?php echo $start . $status ?> </td>
                          <td> <?php echo $finish ?> </td>

                          <td>
                            <a href="index.php?edit_attendance=<?php echo $a_id; ?>" data-toggle="modal" class='btn btn-success btn-sm btn-flat edit'><i class='fa fa-edit'></i> Edit</a>
                          </td>
                          <td>
                            <a href="index.php?delete_attendance=<?php echo $a_id; ?>" onclick="return confirm('Xác nhận xóa?')" class='btn btn-danger btn-sm btn-flat delete'>
                              <i class='fa fa-trash'></i> Delete
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

    <!-- TẠO MODAL -->
    <div class="modal fade" id="addnew">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Tạo điểm danh</b></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="">
              <div class="form-group">
                <label for="employee" class="col-sm-3 control-label">Mã Nhân Viên</label>
                <div class="col-md-6">
                  <select name="employ" class="form-control">
                    <option>----- Chọn nhân viên -----</option>
                    <?php
                    $get_emp = "SELECT * FROM users";
                    $run_emp = mysqli_query($conn, $get_emp);
                    while ($row_emp = mysqli_fetch_array($run_emp)) {
                      $id = $row_emp['id'];
                      $emp_id = $row_emp['employee_id'];
                      $emp_name = $row_emp['full_name'];
                      echo "<option> $id - $emp_id - $emp_name </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="datepicker_add" class="col-sm-3 control-label">Ngày</label>
                <div class="col-sm-9">
                  <div class="date">
                    <input type="date" class="form-control" id="date" name="date" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="time_in" class="col-sm-3 control-label">Giờ vào làm</label>
                <div class="col-sm-9">
                  <div class="bootstrap-timepicker">
                    <input type="time" class="form-control timepicker" id="time_in" name="time_in">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="time_out" class="col-sm-3 control-label">Giờ tan ca</label>
                <div class="col-sm-9">
                  <div class="bootstrap-timepicker">
                    <input type="time" class="form-control timepicker" id="time_out" name="time_out" value="<?php echo date('Y-m-d\TH:i:s'); ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <!--38-->
                <label class="col-sm-3 control-label">Trạng Thái</label>
                <div class="col-md-7">
                  <!--39-->
                  <select name="status" class="form-control" required>
                    <!--40-->
                    <option>---Chọn trạng thái---</option>
                    <?php
                    $st1 = "Đúng giờ";
                    $st0 = "Đi trễ";
                    $st2 = "Vắng";

                    echo "<option> $st1  </option>
                          <option> $st0  </option>
                          <option> $st2 </option>";
                    ?>
                  </select>
                  <!--40e-->
                </div>
                <!--39e-->
              </div>
              <!--38e-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Lưu</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <?php
    if (isset($_POST['add'])) {
      $id = $_POST['employ'];
      $date = $_POST['date'];
      $time_in = $_POST['time_in'];
      $time_out = $_POST['time_out'];
      $get = $_POST['status'];
      if ($get == "Đúng giờ") {
        $status = 1;
      } else if ($get == "Đi trễ") {
        $status = 0;
      } else {
        $status = 2;
      }

      $insert_a = "insert into attendance (employ_id,work_day,start_time,finish_time,status) values ('$id','$date','$time_in','$time_out','$status')";
      $run_a = mysqli_query($conn, $insert_a);
      if ($run_a) {
        echo "<script>alert('Bạn đã thêm điểm danh mới thành công')</script>";
        echo "<script>window.open('index.php?view_attendance','_self')</script>";
      }
    }
    ?>

    <script>
      $(function() {
        $('.edit').click(function(e) {
          e.preventDefault();
          $('#edit').modal('show');
          var id = $(this).data('id');
          getRow(id);
        });

        $('.delete').click(function(e) {
          e.preventDefault();
          $('#delete').modal('show');
          var id = $(this).data('id');
          getRow(id);
        });
      });
    </script>
  </body>

  </html>
<?php } ?>