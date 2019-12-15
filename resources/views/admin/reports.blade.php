@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="col-xl-12 col-lg-12">

        <!-- nhập thông tin -->
        <div class="card mb-2">
            <div class="card-header py-1">
                <h6 class="m-0 font-weight-bold text-primary">Chọn thống kê</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="input-group mb-3 col-4 col-xl-4 col-sm-6">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Thống kê</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                            <option value="doanh-thu" selected>Doanh thu</option>
                            <option value="khach-hang">Khách hàng</option>
                            <option value="san-pham">Sản phẩm</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-4 col-4 col-xl-4 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="ngay-bat-dau">Ngày bắt đầu</span>
                        </div>
                        <input type="date" class="form-control" placeholder="Username" aria-label="Username"
                            aria-describedby="ngay-bat-dau">
                    </div>
                    <div class="input-group mb-4 col-4 col-xl-4 col-sm-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="ngay-ket-thuc">Ngày kết thúc</span>
                        </div>
                        <input type="date" class="form-control"  aria-label="Username"
                            aria-describedby="ngay-ket-thuc">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-4 col-4 col-xl-4 col-sm-6">
                        <input type="button" class="btn btn-primary" placeholder="Username" aria-label="Username"
                            aria-describedby="ngay-bat-dau" value="Submit">
                    </div>
                </div>
            </div>
        </div>

        <!-- Show biểu đồ -->
        <div class="card shadow">
            <div class="card-header py-1">
                <h6 class="m-0 font-weight-bold text-primary">Biểu đồ</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myBarChart"></canvas>
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
<!-- Page level custom scripts -->
<script src="{{asset('/public/backend/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('/public/backend/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{asset('/public/backend/js/demo/chart-bar-demo.js')}}"></script>
<script>

</script>
@endsection