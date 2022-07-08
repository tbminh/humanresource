<?php

if (!isset($_SESSION['email'])) {

  echo "<script>window.open('login.php','_self')</script>";
} else {

?>
  <!-- Main content -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" style="margin-left: 220px; width: 85%;">
            <thread>
              <tr style="background-color: #2A3F54; color: white; ">
                <th>Mã Nhân Viên</th>
                <th>Họ Tên</th>
                <th>Tổng tỷ trọng</th>
                <th>Lương chức vụ</th>
                <th>Khen thưởng - Kỷ luật</th>
                <th>Tổng kết</th>
                <th>Tổng Lương</th>
              </tr>
            </thread>
            <tbody>
              <?php
              $get_c = "SELECT lv.level_name,u.*,sc.time_in,sc.time_out,ps.position_name, ps.basic_salary
                                FROM users as u, levels as lv, schedule as sc, position as ps
                                WHERE lv.id = u.id_level 
                                
                                AND sc.id = u.id_schedule
                                AND ps.id = u.id_position
                                AND u.id = '$id';		";

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
                      $ab += $bc;
                      $v = 10;
                      $tl = $ab - $v;
                      $tlt = $ab + $v;
                    }
                    echo  $ab . ' %';
                    ?>

                  </td>
                  <td> <?php echo number_format($luong) . ' VNĐ'; ?> </td>
                  <td>
                    <?php
                    $aa = 'Chuyên cần tốt (+10%)';
                    $bb = 'Chuyên cần không tốt(-10%)';
                    $ba = 'Bình thương (+-0%)';
                    $cc = 0;
                    $sta = 0;
                    $sta1 = 2;
                    $get_s = "select * from attendance where employ_id='$id' AND (status ='$cc' or status = '$sta1')";
                    $run_s = mysqli_query($conn, $get_s);
                    $count = mysqli_num_rows($run_s);

                    if ($count >= '3') {
                      echo $bb;
                    } else if ($count == '0') {
                      echo $aa;
                    } else {
                      echo $ba;
                    }

                    ?>

                  </td>
                  <td>
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
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" style="margin-left: 220px; width: 85%;">
            <thread>
              <tr style="background-color: #2A3F54; color: white; ">
                <th>Đi trễ</th>
                <th>Vắng</th>
              </tr>
            </thread>
            <tbody>
              <?php
              $get_c = "SELECT lv.level_name,u.*,sc.time_in,sc.time_out,ps.position_name, ps.basic_salary
                                FROM users as u, levels as lv, schedule as sc, position as ps
                                WHERE lv.id = u.id_level 
                                AND sc.id = u.id_schedule
                                AND ps.id = u.id_position
                                AND u.id = '$id';		";

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
                  <td>
                    <?php
                    $kl = 0;
                    $get_sold = "select * from attendance where employ_id='$id' AND status ='$kl'";
                    $run_sold = mysqli_query($conn, $get_sold);
                    $count = mysqli_num_rows($run_sold);
                    echo $count . ' Ngày';

                    ?>
                  </td>
                  <td>
                    <?php
                    $kl = 2;
                    $get_sold = "select * from attendance where employ_id='$id' AND status ='$kl'";
                    $run_sold = mysqli_query($conn, $get_sold);
                    $count = mysqli_num_rows($run_sold);
                    echo $count . ' Ngày';

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
<?php }
?>