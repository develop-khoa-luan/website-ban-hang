@extends('admin_layout')
@section('admin_content')

@foreach ($view_each_customer as $it)
    

<div class="row">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
                <div class="card border border-primary mb-3">
                    <div class="card-header p-2 text-primary border-botton border-primary text-center">
                        Thông tin khách hàng
                    </div>
                    <div class="card-body">
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Tên khách hàng:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$it->customer_name}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Email:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$it->customer_email}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Số điện thoại:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$it->customer_phone}}
                                </div>
                            </div>
                        </div>
                        <div class="card-form p-2">
                            <div class="row border-bottom">
                                <div class="col-12 col-sm-6 col-md-6 text-danger">
                                    Ngày tạo:
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 text-dark">
                                    {{$it->created_at}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
</div>

@endforeach

<div class="card-body">

        <div class="card-header" style="margin-top: -30px; text-align:center">
            <h5 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr style="text-align:center">
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>Tình trạng</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_order as $key => $order)
                    <tr style="text-align:center">
                        <td>{{ $order -> order_id }}</td>
                        <td>{{ $order -> created_at }}</td>
                        <td>{{number_format($order -> order_total, 0) }} VND</td>
                        <td>{{ $order -> order_status }}</td>
                        <td >
                            <a href="{{URL::to('/view-customer-order-detail/'.$order->order_id)}}}" class="active" ui-toggle-class="">
                                <i class="fa fa-edit text-success text-active"></i>
                            </a>
                            
                          

                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>





<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script>

</script>
@endsection