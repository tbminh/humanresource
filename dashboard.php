<?php
if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Di Động', 'Truyền Hình', 'Dịch Vụ Số', 'Chính Phủ Điện Tử', 'Du Lịch Thông Minh', 'Trung Bình'],
                ['2018', 1002, 938, 522, 998, 450, 1006],
                ['2019', 1120, 1120, 599, 1268, 288, 1158],
                ['2020', 650, 1167, 587, 807, 397, 1305],
                ['2021', 750, 1110, 615, 968, 215, 321],
                ['2022', 136, 691, 629, 1026, 366, 569.6]
            ]);

            var options = {
                title: 'BIỂU ĐỒ THỐNG KÊ DOANH THU CÔNG TY TRONG 5 NĂM GẦN NHẤT',
                vAxis: {
                    title: 'Tỷ Đồng'
                },
                hAxis: {
                    title: 'Tháng'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Bảng điều khiển </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Bảng điều khiển
                </li>
            </ol>
        </div>
    </div>
    <div id="chart_div" style="width: 1100px; height: 500px;"></div>
    <!-- <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo 8; ?> </div>
                            <div> Nhân viên </div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_customers">
                <div class="panel-footer">
                    <span class="pull-left">
                         Xem chi tiết
                    </span>
                    <span class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo 10; ?> </div>
                            <div> Phòng ban </div>
                        
                    </div>
                </div>
            </div>
                <a href="index.php?view_p_cats">
                <div class="panel-footer">
                    <span class="pull-left"> 
                        Xem chi tiết
                    </span>
                    <span class="pull-right"> 
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-orange">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tags fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo 10; ?> </div>
                            <div> Chức vụ </div>
                    </div>
                </div>
            </div>
            <a href="index.php?view_cats">
                <div class="panel-footer">
                    <span class="pull-left"> 
                        Xem chi tiết
                    </span>
                    <span class="pull-right"> 
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo 6; ?> </div>
                            <div> Chuyên môn </div>
                        
                    </div>
                </div>
            </div>
            <a href="index.php?view_slides">
                <div class="panel-footer">
                    <span class="pull-left"> 
                        Xem chi tiết
                    </span>
                    <span class="pull-right"> 
                        <i class="fa fa-arrow-circle-right"></i> 
                    </span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div> -->
<?php
}
?>