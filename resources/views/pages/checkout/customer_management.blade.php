@extends('layout_update')
@section('content_update')
<div id="contact-page" class="container" style="width:100%">
    <meta name="_token" content="{{csrf_token()}}" />
    <div class="bg">
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Quản lý thông tin</h2>
                    <?php
                        $message = Session::get('message_change_detail_customer');
                        if($message){
                        echo '<div class="status-change alert alert-success">'.$message.'</div>';
                        Session::put('message_change_detail_customer',null);
                        }
                     ?>

                    <div class="form-group col-md-12">
                        <label for="customer_email" style="font-size: 15px">Email:</label>
                        <input type="text" name="customer_email" id="customer_email" class="form-control"
                            required="required" readonly placeholder="Email" value="{{$view_customer->customer_email}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_name" style="font-size: 15px">Tên:</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control"
                            required="required" placeholder="Tên" value="{{$view_customer->customer_name}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="customer_phone" style="font-size: 15px">Số điện thoại:</label>
                        <input type="text" name="customer_phone" id="customer_phone" class="form-control"
                            required="required" placeholder="Số điện thoại" value="{{$view_customer->customer_phone}}">
                    </div>
                    <div class="show-change-password"></div>
                    <div class="form-group col-md-12">
                        <a class="change-password">Thay đổi mật khẩu!</a>
                    </div>
                    <div class="form-group col-md-12">
                        <a class="dischange-password">Hủy thay đổi!</a>
                    </div>
                    <div class="row pull-right">
                        <div class="form-group col-md-6">
                            <input type="button" class="btn btn-primary btn-change-detail" value="Cập nhật">
                        </div>
                        <div class="form-group col-md-6">
                            <a href="{{URL::to('/trang-chu')}}" style="background-color: crimson"
                                class="btn btn-primary"> Hủy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script>
    var changePassword = "no";
    $('.search_box').hide();
    $('.dischange-password').hide();
    $('.change-password').on('click', function () {
        let html = `<div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Mật khẩu cũ:</label>
                        <input type="password" name="customer_ex_password" id="customer_ex_password" class="form-control" required="required"
                            placeholder="Mật Khẩu cũ" value="">
                    </div>
                    <div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Mật khẩu mới:</label>
                        <input type="password" name="customer_new_password" id="customer_new_password" class="form-control" required="required"
                            placeholder="Mật Khẩu mới" value="">
                    </div>

                    <div class="form-group col-md-12 password-field">
                        <label for="customer_password" style="font-size: 15px">Nhập lại mật khẩu:<span style="font-size: 10px" class="text-danger not_the_same"></span></label>
                        <input type="password" name="customer_retype_password" id="customer_retype_password" class="form-control customer_retype_password" required="required"
                            placeholder="Nhập lại mật Khẩu" value="">
                    </div>`;
        $('.password-field').remove();
        $('.change-password').hide();
        $('.show-change-password').append(html);
        $('.dischange-password').show();
        changePassword = "yes";
    });
    $('.dischange-password').on('click', function () {
        changePassword = "no";
        $('.password-field').remove();
        $('.change-password').show();
        $('.dischange-password').hide();
    });

    $('.btn-change-detail').click(function (e) {
        var email = $('#customer_email').val();
        var name = $('#customer_name').val();
        var phone = $('#customer_phone').val();
        var ex_password = $('#customer_ex_password').val();
        var new_password = $('#customer_new_password').val();
        var retype_password = $('#customer_retype_password').val();
        if (new_password != retype_password) {
            $('.not_the_same').text(' Mật khẩu không khớp, vui lòng nhập lại!');
        } else {
            $('.not_the_same').text('');
            if (changePassword === "no") {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/update-customer') }}",
                    method: 'post',
                    data: {
                        customer_email: email,
                        customer_name: name,
                        customer_phone: phone,
                        change_password: 'no',
                        customer_ex_password: 'no',
                        customer_new_password: 'no'
                    },
                    success: function (result) {
                        location.reload();
                        
                    },
                    error: function (result) {
                        alert("Không thành công!");
                    }
                });
            }
            if (changePassword === "yes") {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/update-customer') }}",
                    method: 'post',
                    data: {
                        customer_email: email,
                        customer_name: name,
                        customer_phone: phone,
                        change_password: 'yes',
                        customer_ex_password: ex_password,
                        customer_new_password: new_password
                    },
                    success: function (result) {
                        location.reload();
                    },
                    error: function (result) {
                        alert("Không thành công!");
                    }
                });
            }
        }

    });

</script>
@endsection
