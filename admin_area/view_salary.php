
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
                                $get_c = "SELECT lv.level_name,emp.*,sc.time_in,sc.time_out,ps.position_name, ps.basic_salary
                                FROM employee as emp, levels as lv, schedule as sc, position as ps
                                WHERE lv.id = emp.id_level 
                                
                                AND sc.id = emp.id_schedule
                                AND ps.id = emp.id_position		";
    
                                $run_c = mysqli_query($conn,$get_c);
                                $i=0;
                                while($row_c=mysqli_fetch_array($run_c)){
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
                                      
                                      $ab =0;
                                      $u =1;
                                      $tl=0;
                                      $tlt = 0;
                                        $get_sold = "select * from kpi where employ_id='$id' AND status_kpi ='$u'";
                                        $run_sold = mysqli_query($conn,$get_sold);
                                        while($row_sold = mysqli_fetch_array($run_sold)){
                                          $percent = $row_sold['percent'];
                                          $b = 0;
                                          $bc = $percent + $b;
                                          $ab += $bc;
                                          $v = 10;
                                          $tl = $ab - $v;
                                          $tlt = $ab + $v;
                                         
                                        }echo  $ab . ' %';
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
                                            $run_s = mysqli_query($conn,$get_s);
                                            $count = mysqli_num_rows($run_s);
                                              
                                             if($count >= '3' ){
                                              echo $bb;
                                            }else if($count == '0'){
                                              echo $aa;
                                            }else{
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
                                                    $run_s = mysqli_query($conn,$get_s);
                                                    $count = mysqli_num_rows($run_s);
                                                      
                                                   
                                                    if($count >= '3' ){
                                                      echo $tl . ' %';
                                                    }else if($count == '0'){
                                                      echo $tlt . ' %';
                                                    }else{
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
                                          $run_s = mysqli_query($conn,$get_s);
                                          $count = mysqli_num_rows($run_s);
                                            
                                           if($count >= '3' ){
                                            $abc =  ($luong * $tl) / $b;
                                            echo number_format($abc) . ' VNĐ';
                                          }else if($count == '0'){
                                            $abc =  ($luong * $tlt) / $b;
                                            echo number_format($abc) . ' VNĐ';
                                          }else{
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
