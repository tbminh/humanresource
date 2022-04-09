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
                                <th>STT</th>
                                <th style="height: 50px">Mã KPI</th>
                                <th>Tên KPI</th>
                                <th>Đơn vị tính</th>
                                <th>Tỷ trọng (%)</th>
                                <th>Tháng giao việc</th>
                                <th>Trạng thái</th>
                                
                            </tr>
                        </thread>
                        <tbody>
                        <?php
                            $i=0;
                            $run_kpi = mysqli_query($conn,$get_kpi);
                            while($row_kpi=mysqli_fetch_array($run_kpi)){
                                $id_kpi = $row_kpi['id_kpi'];
                                $kpi_name = $row_kpi['kpi_name'];
                                $percent = $row_kpi['percent'];
                                $unit = $row_kpi['unit'];
                                $target = $row_kpi['target'];
                                $status = $row_kpi['status_kpi'];
                                $time = $row_kpi['time'];
                                $date = strtotime($time);
                                $i++;
                  ?>
                             <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo $id_kpi; ?> </td>
                                <td> <?php echo $kpi_name ?> </td>
                                <td> <?php echo $unit ?> </td>
                                <td> <?php echo $percent ?> </td>
                                <td > <?php echo date('m',$date)?> </td>
                                <td>
                                    <?php
                                            $u = 1;
                                           
                                            
                                            if($status == $u){
                                                echo "Đã hoàn thành";
                                            }else{
                                                echo "Chưa hoàn thành";
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
<?php } 
?>