@extends('admin_layout')
@section('admin_content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dữ liệu apriori</h1>
    <?php
    $message = Session::get('message');
    if ($message) {
        echo '<span style="color:red">' . $message . '</span>';
        Session::put('message', null);
    }
    ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Apriori Algorithm</h6>
                <a href="{{URL::to('/run-apriori')}}" class="ml-3 btn btn-primary btn-sm">
                    <i class="fas fa-calculator"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center">
                        <th>Apriori</th>
                        <th>Support</th>
                        <th>Confidence</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach ($data_apriori as $item)
                        <tr>
                            <td class="text-dark text-left">
                            <span
                                class="text-primary">{{$item->product_1}}{{$item->product_2}}{{$item->product_3}}{{$item->product_4}}</span>
                                =>
                                <span
                                    class="text-danger">{{$item->recommend_1}}{{$item->recommend_2}}{{$item->recommend_3}}{{$item->recommend_4}}</span>
                            </td>
                            <td>{{$item->support}}%</td>
                            <td>{{$item->Confidence}}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
