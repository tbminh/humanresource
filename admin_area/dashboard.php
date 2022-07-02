
<?php
    if(!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";
    }
    else{
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Năm', 'Bán Hàng', 'Chi Phí', 'Lợi Nhuận'],
            ['2018', 1000, 400, 200],
            ['2019', 1170, 460, 250],
            ['2020', 660, 1120, 300],
            ['2021', 1030, 540, 350]
        ]);

        var options = {
            chart: {
            title: 'Hiệu Suất Làm Việc Của Công Ty',
            subtitle: 'Sales, Chi Phí, and Lợi Nhuận: 2018-2021',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
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

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <?php echo 8;?> </div>
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
</div>
<div id="columnchart_material" style="width: 1200px; height: 500px;"></div>
<?php 
}
?>
