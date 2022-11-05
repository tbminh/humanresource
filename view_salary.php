<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tính lương
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
          <li class="active">Tính lương</li>
        </ol>
      </section>
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
                    <th>Tổng tỷ trọng</th>
                    <th>Lương chức vụ</th>
                    <th>Khen thưởng - Kỷ luật</th>
                    <th>Tổng kết</th>
                    <th>Tổng Lương</th>

                  </thead>
                  <tbody>
                    <?php
                    //Hiển thị thông tin lương theo thông tin nhân viên, mức lương, tỷ trọng, khen thưởng kỉ luật
                    $get_c = "SELECT lv.level_name,u.*,sc.time_in,sc.time_out,ps.position_name, ps.basic_salary
                                FROM users as u, levels as lv, schedule as sc, position as ps
                                WHERE lv.id = u.id_level 
                                
                                AND sc.id = u.id_schedule
                                AND ps.id = u.id_position";

                    $run_c = mysqli_query($conn, $get_c);
                    $i = 0;
                    while ($row_c = mysqli_fetch_array($run_c)) {
                      $id = $row_c['id'];
                      $c_id = $row_c['employee_id'];
                      $name = $row_c['full_name'];
                      $luong = $row_c['basic_salary'];
                      //Đổi kiểu time lịch làm việc
                      $i++;
                    ?>
                      <tr>
                        <td> <?php echo $i; ?></td>
                        <td> <?php echo $c_id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td>
                          <?php
                          $ab = 0;
                          $u = 1;
                          $tl = 0;
                          $tlt = 0;
                          $get_sold = "select * from kpi where employ_id='$id' AND status_kpi ='$u'";
                          $run_sold = mysqli_query($conn, $get_sold);
                          while ($row_sold = mysqli_fetch_array($run_sold)) {
                            $percent = $row_sold['percent'];
                            $b = 0;
                            $bc = $percent + $b;
                            $ab += $bc; //Tổng % KPI hoàn thành
                            $v = 10;
                            $tl = $ab - $v; //Lương phạt
                            $tlt = $ab + $v; //Lương thưởng
                          }
                          echo  $ab . ' %';
                          ?>

                        </td>
                        <td>
                          <!-- Lương chức vụ -->
                          <?php echo number_format($luong) . ' VNĐ'; ?>
                        </td>
                        <td>
                          <!-- Khen thưởng kỉ luật -->
                          <?php
                          $aa = 'Chuyên cần tốt (+10%)';
                          $bb = 'Chuyên cần không tốt(-10%)';
                          $ba = 'Bình thương (+-0%)';
                          $cc = 0;
                          $sta = 0; //Vắng
                          $sta1 = 2; //Đi trễ
                          $get_s = "select * from attendance where employ_id='$id' AND (status ='$cc' or status = '$sta1')";
                          $run_s = mysqli_query($conn, $get_s);
                          $count = mysqli_num_rows($run_s);

                          if ($count >= '3') { //Nếu vắng trễ trên 3 lần thì chuyên cần không tốt
                            echo $bb;
                          } else if ($count == '0') { //Nếu không vắng trễ ngày nào thì chuyên cần tốt
                            echo $aa;
                          } else {
                            echo $ba; //Vắng trễ dưới 3 lần thì bình thường
                          }
                          ?>

                        </td>
                        <td>
                          <!-- Tổng kết -->
                          <?php
                          $cc = 0;
                          $sta = 0;
                          $sta1 = 2;
                          $b = 100;
                          $get_s = "select * from attendance where employ_id='$id' AND (status ='$cc' or status = '$sta1')";
                          $run_s = mysqli_query($conn, $get_s);
                          $count = mysqli_num_rows($run_s);

                          if ($count >= '3') {
                            echo $tl . ' %';
                          } else if ($count == '0') {
                            echo $tlt . ' %';
                          } else {
                            echo $ab . ' %';
                          }
                          ?>

                        </td>
                        <td>
                          <!-- Tổng Lương -->
                          <?php
                          $cc = 0;
                          $sta = 0;
                          $sta1 = 2;
                          $b = 100;
                          $get_s = "select * from attendance where employ_id='$id' AND (status ='$cc' or status = '$sta1')";
                          $run_s = mysqli_query($conn, $get_s);
                          $count = mysqli_num_rows($run_s);

                          if ($count >= '3') {
                            $abc =  ($luong * $tl) / $b;
                            echo number_format($abc) . ' VNĐ';
                          } else if ($count == '0') {
                            $abc =  ($luong * $tlt) / $b;
                            echo number_format($abc) . ' VNĐ';
                          } else {
                            $abc =  ($luong * $ab) / $b;
                            echo number_format($abc) . ' VNĐ';
                          }




                          ?>

                        </td>

                      </tr>
                    <?php  } ?>
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


</body>

</html>