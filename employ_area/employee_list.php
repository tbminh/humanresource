<?php 
    
    if(!isset($_SESSION['email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    }else{

?>
<!-- Main content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="margin-left: 220px; width: 85%;">
                        <thread>
                            <tr style="background-color: #2A3F54; color: white; ">
                                <th style="height: 50px;">Mã Nhân Viên</th>
                                <th>Tên Nhân Viên </th>
                                <th>Chức Vụ </th>
                                <th>Trình Độ</th>
                                <th> Lịch Làm Việc</th>
                                <th> Thư Điện Tử </th>
                                <th> Ngày Sinh </th>
                                <th> Giới Tính </th>
                            </tr>
                        </thread>
                        <tbody>
                            <?php
                                $get_c = "SELECT lv.level_name,emp.*,sc.*,ps.position_name
                                            FROM employee as emp, levels as lv, schedule as sc, position as ps
                                            WHERE lv.id = emp.id_level 
                                            AND sc.id = emp.id_schedule
                                            AND ps.id = emp.id_position	";
    
                                $run_c = mysqli_query($conn,$get_c);
                                while($row_c=mysqli_fetch_array($run_c)){
                                    $c_id = $row_c['employee_id'];
                                    $name = $row_c['full_name'];
                                    $p_name = $row_c['position_name'];
                                    $lv_name = $row_c['level_name'];
                                    $in = $row_c['time_in'];
                                    $out = $row_c['time_out'];
                                    $c_email = $row_c['email'];
                                    $birth = $row_c['birthday'];
                                    $sex = $row_c['sex'];

                                    //Đổi kiểu time lịch làm việc
                                    $t_in = strtotime($in);
                                    $t_out = strtotime($out);
                                    
                            ?>
                            <tr>
                                    <td> <?php echo $c_id; ?> </td>
                                    <td> <?php echo $name; ?> </td>
                                    <td> <?php echo $p_name; ?> </td>
                                    <td> <?php echo $lv_name; ?> </td>
                                    <td> <?php echo  date('h:i A',$t_in)  .' - '.  date('h:i A',$t_out); ?> </td>
                                    <td> <?php echo $c_email; ?> </td>
                                    <td> <?php echo $birth; ?> </td>
                                    <td> <?php echo $sex; ?> </td>
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