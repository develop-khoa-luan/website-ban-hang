@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- Page Heading -->

    <div class="col-xl-12 col-lg-12">
        <!-- nhập thông tin -->
        <form action="{{URL::to('/reports-detail')}}" method="POST">
            {{ csrf_field() }}
            <div class="card mb-2">
                <div class="card-header py-1">
                    <h6 class="m-0 font-weight-bold text-primary">Chọn thống kê</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="input-group mb-3 col-4 col-xl-4 col-sm-6">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="report_type">Thống kê</label>
                            </div>
                            <select class="report_type" id="report_type" name="report_type">
                                <option value="doanh-thu" selected>Doanh thu</option>
                                <option value="san-pham">Sản phẩm</option>
                                <option value="hoa-don">Hóa đơn</option>
                                <option value="khach-hang">Khách hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="row show-option-detail">
                        <div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="report_detail_1">Chọn</label>
                            </div>
                            <select class="report_detail_1" id="report_detail_1" name="report_detail_1">
                                <option value="theo-ngay">Thống kê trong tháng</option>
                                <option value="theo-thang">Thống kê trong năm</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group mb-4 col-4 col-xl-4 col-sm-6">
                            <input type="button" class="btn btn-primary btn-submit-report" placeholder="Username"
                                aria-label="Username" aria-describedby="" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Show biểu đồ -->
        <div class="card shadow">
            <div class="card-header py-1">
                <h6 class="m-0 font-weight-bold text-primary">Thống kê</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
                </div>
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <div class="table-responsive table-product">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng kho</th>
                                <th>Tổng số bán được</th>
                            </tr>
                        </thead>
                        <tbody class="text-center table_body_data">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{asset('/public/backend/vendor/jquery/jquery.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<!-- Page level plugins -->
<script src="{{asset('/public/backend/vendor/chart.js/Chart.min.js')}}"></script>
{{-- bar chart --}}
<script>
    $('.chart-bar').hide();
    $('.chart-area').hide();
    $('.table-product').hide();
    $('.report_type').change(function(){
        if($('.report_type').val() == 'khach-hang'){
            $('.detail-option').remove();
            var option =    `<div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_1">Chọn</label>
                                </div>
                                <select class="report_detail_1" id="report_detail_1" name="report_detail_1">
                                    <option value="theo-ngay" selected>Thống kê trong tháng</option>
                                    <option value="theo-thang">Thống kê trong năm</option>
                                </select>
                            </div>`;
            $('.show-option-detail').append(option);
        }
        if($('.report_type').val() == 'doanh-thu'){
            $('.detail-option').remove();
            var option =    `<div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_1">Chọn</label>
                                </div>
                                <select class="report_detail_1" id="report_detail_1" name="report_detail_1">
                                    <option value="theo-ngay" selected>Thống kê trong tháng</option>
                                    <option value="theo-thang">Thống kê trong năm</option>
                                </select>
                            </div>`;
            $('.show-option-detail').append(option);
        }
        if($('.report_type').val() == 'san-pham'){
            $('.detail-option').remove();
            var option =    `<div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_1">Chọn</label>
                                </div>
                                <select class="report_detail_1" id="report_detail_1" name="report_detail_1">
                                    <option value="san-pham-ban-chay" selected>Sản phẩm bán chạy</option>
                                    <option value="san-pham-sap-het-hang">Sản phẩm sắp hết hàng</option>
                                </select>
                            </div>
                                <div class="input-group mb-3 col-5 col-xl-5 col-sm-6 detail-option">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text label_report_detail_2" for="report_detail_2">Top: </label>
                                    </div>
                                    <input type="number" class="form-control report_detail_2" aria-label="report_detail_2" value="3" aria-describedby="inputGroup-sizing-default">
                                </div>
                                <div class="row col-12 show-detail-option-3-4"></div>
                                <div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option detail-option-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_3">Ngày bắt đầu</label>
                                </div>
                                <input type="date" class="form-control report_detail_3" name="report_detail_3" id="report_detail_4" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option  detail-option-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_4">Ngày kết thúc</label>
                                </div>
                                <input type="date" class="form-control report_detail_4" name="report_detail_4" id="report_detail_4" aria-describedby="inputGroup-sizing-default">
                            </div>`;
            $('.show-option-detail').append(option);
        }
        if($('.report_type').val() == 'hoa-don'){
            $('.detail-option').remove();
            var option =    `<div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_1">Chọn</label>
                                </div>
                                <select class="report_detail_1" id="report_detail_1" name="report_detail_1">
                                    <option value="theo-ngay" selected>Thống kê trong tháng</option>
                                    <option value="theo-thang">Thống kê trong năm</option>
                                </select>
                            </div>`;
            $('.show-option-detail').append(option);
        }
    })

    $('.show-option-detail').on('change', '.report_detail_1',function(){
        if($('.report_detail_1').val() == 'san-pham-sap-het-hang'){
            $('.label_report_detail_2').text("Sản phẩm dưới: ");
            $('.detail-option-3').remove();
            $('.detail-option-4').remove();
        }
        if($('.report_detail_1').val() == 'san-pham-ban-chay'){
            $('.label_report_detail_2').text("Top: ");
            $('.show-detail-option-3-4').append(`<div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option detail-option-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_3">Ngày bắt đầu</label>
                                </div>
                                <input type="date" class="form-control report_detail_3" name="report_detail_3" id="report_detail_3" aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="input-group mb-3 col-4 col-xl-4 col-sm-6 detail-option  detail-option-4">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="report_detail_4">Ngày kết thúc</label>
                                </div>
                                <input type="date" class="form-control report_detail_4" name="report_detail_4" id="report_detail_4" aria-describedby="inputGroup-sizing-default">
                            </div>`);
        }
    })

</script>

<script>
    $('.btn-submit-report').click(function(e){
                var report_detail_2 = null;
                var report_detail_3 = null;
                var report_detail_4 = null;
                if($('.report_detail_2').val() != null){
                    report_detail_2 = $('.report_detail_2').val();
                }
                if($('.report_detail_3').val() != null){
                    report_detail_3 = $('.report_detail_3').val();
                }
                if($('.report_detail_4').val() != null){
                    report_detail_4 = $('.report_detail_4').val();
                }
                e.preventDefault();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });
                $.ajax({
                url: "{{ url('/reports-detail') }}",
                method: 'post',
                data: {
                        report_type: $('.report_type').val(),
                        report_detail_1: $('.report_detail_1').val(),
                        report_detail_2: report_detail_2,
                        report_detail_3: report_detail_3,
                        report_detail_4: report_detail_4
                    },
                    success: function(result){
                        if(result.status == 'doanh-thu'){
                            $('.chart-bar').show();
                            $('.chart-area').hide();
                            $('.table-product').hide();
                            $('#myBarChart').remove();
                            $('.chart-bar').append(`<canvas id="myBarChart"></canvas>`);
                            show_bar_chart(result.data, result.message); 
                        }
                        if(result.status == 'khach-hang'){
                            $('.chart-bar').hide();
                            $('.table-product').hide();
                            $('.chart-area').show();
                            $('#myAreaChart').remove();
                            $('.chart-area').append(`<canvas id="myAreaChart"></canvas>`);
                            show_area_chart(result.data, result.message); 
                        }
                        if(result.status == 'san-pham-ban-chay'){
                            $('.chart-bar').hide();
                            $('.table-product').show();
                            $('.chart-area').hide();
                            $('.row-date-table').remove();
                            $('.dataTables_empty').remove();
                            result.data.forEach(element => {
                                var data_table = `<tr class="row-date-table">
                                    <td>`+element.product_id+`</td>
                                    <td>`+element.product_name+`</td>
                                    <td><img src="public/uploads/product/`+element.product_image+`" width="100" height="100"></td>
                                    <td>--</td>
                                    <td>`+element.count_product+`</td>
                                </tr>`
                                $('.table_body_data').append(data_table);
                            });
                        }
                        if(result.status == 'san-pham-het-hang'){
                            console.log(result.data);
                            $('.chart-bar').hide();
                            $('.table-product').show();
                            $('.chart-area').hide();
                            $('.row-date-table').remove();
                            $('.dataTables_empty').remove();
                            result.data.forEach(element => {
                                    var data_table = `<tr class="row-date-table">
                                        <td>`+element.product_id+`</td>
                                        <td>`+element.product_name+`</td>
                                        <td><img src="public/uploads/product/`+element.product_image+`" width="100" height="100"></td>
                                        <td>`+element.count_quantity+`</td>
                                        <td>--</td>
                                    </tr>`
                                    $('.table_body_data').append(data_table);
                            });
                        } 
                        if(result.status == 'hoa-don'){
                            $('.chart-bar').hide();
                            $('.table-product').hide();
                            $('.chart-area').show();
                            $('#myAreaChart').remove();
                            $('.chart-area').append(`<canvas id="myAreaChart"></canvas>`);
                            show_area_chart(result.data, result.message); 
                        }       
                    },
                    error: function(result){
                        alert("Không thành công!");
                    }});
            });

    function show_bar_chart(data, message){
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
        }

        // Bar Chart 
        var dataAvgOrder = data;
        const arrayMonth = [];
        const arrayAvgTotal = [];
        if(message == 'doanh-thu-thang'){
            for(var i = 1; i <= 12; i++){
            var check = 'false';
            data.forEach(element => {
                if(element.time == i){
                    check = "true";
                    arrayMonth.push('Tháng '+element.time);
                    arrayAvgTotal.push(element.sum_total/1000000);
                    
                }
            });
            if(check == 'false'){
                arrayMonth.push('Tháng '+ i);
                arrayAvgTotal.push(0);
            }
        }
        }

        if(message == 'doanh-thu-ngay'){
            for(var i = 1; i <= 31; i++){
            var check = 'false';
            data.forEach(element => {
                if(element.time == i){
                    check = "true";
                    arrayMonth.push('Ngày '+element.time);
                    arrayAvgTotal.push(element.sum_total/1000000);
                    
                }
            });
            if(check == 'false'){
                arrayMonth.push('Ngày '+ i);
                arrayAvgTotal.push(0);
            }
        }
        }
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arrayMonth,
            datasets: [{
            label: "Lợi nhuận: ",
            backgroundColor: "#4e73df",
            hoverBackgroundColor: "#2e59d9",
            borderColor: "#4e73df",
            data: arrayAvgTotal,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'month'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 6
                },
                maxBarThickness: 25,
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                    return number_format(value)+' (triệu)';
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ':' + number_format(tooltipItem.yLabel)+' (triệu)';
                }
            }
            },
        }
    });
    };

    function show_area_chart(data, message){
    const arrayTime = [];
    const arraySumTimes = [];
    if(message == 'Khách hàng đăng kí theo năm' || message == 'Thống kê hóa đơn trong năm'){
        for(var i = 1; i <= 12; i++){
            var check = 'false';
            data.forEach(element => {
                if(element.time == i){
                    check = "true";
                    arrayTime.push('Tháng ' + element.time);
                    arraySumTimes.push(element.sum_times);
                    
                }
            });
            if(check == 'false'){
                arrayTime.push('Tháng ' + i);
                arraySumTimes.push(0);
            }
        }
    }
    if(message == 'Khách hàng đăng kí theo tháng' || message == 'Thống kê hóa đơn trong tháng'){
        for(var i = 1; i <= 31; i++){
            var check = 'false';
            data.forEach(element => {
                if(element.time == i){
                    check = "true";
                    arrayTime.push('Ngày ' + element.time);
                    arraySumTimes.push(element.sum_times);
                    
                }
            });
            if(check == 'false'){
                arrayTime.push('Ngày ' + i);
                arraySumTimes.push(0);
            }
        }
    }

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: arrayTime,
        datasets: [{
            label: "Lượt: ",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: arraySumTimes,
        }],
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
        },
        scales: {
            xAxes: [{
                time: {
                    unit: 'date'
                },
                gridLines: {
                    display: false,
                    drawBorder: false
                },
                scaleLabel: {
                    display: true,
                    labelString: message
                },
                ticks: {
                    maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                    maxTicksLimit: 5,
                    padding: 10,
                    // Include a dollar sign in the ticks
                    callback: function(value, index, values) {
                        return number_format(value, 0) + " (Lượt)";
                    }
                },
                scaleLabel: {
                    display: true,
                    labelString: '(Lượt)'
                },
                gridLines: {
                    color: "rgb(234, 236, 244)",
                    zeroLineColor: "rgb(234, 236, 244)",
                    drawBorder: false,
                    borderDash: [2],
                    zeroLineBorderDash: [2]
                }
            }],
        },
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                    var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                    return datasetLabel + ': ' + number_format(tooltipItem.yLabel, 0) + ' lượt';
                }
            }
        }
    }
});
}

</script>
@endsection