@extends('layout_update')
@section('content_update')

    <!--form-->
    <div class="" >
        
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2 style="font-weight:bold">Đăng nhập</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST" >
                        {{@csrf_field()}}
                        <input type="text" name="email_account" required="required" placeholder="Nhập tài khoản" />
                        <input type="password" name="password_account" required="required" placeholder="Nhập mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ tài khoản
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <?php
                            $message = Session::get('message1');
                            if($message){
                                echo '<span style="color:red">' .$message. '</span>';
                                Session::put('message1',null);
                            }
                        ?>
                    <h2 style="font-weight:bold">Đăng kí tài khoản</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{ csrf_field()}}
                        
                        <input type="text" name="customer_name"  required="required" placeholder="Nhập họ tên" />
                        <input type="email" name="customer_email" required="required" placeholder="Nhập email" />
                        <input type="password" name="customer_password" id="password" required="required" placeholder="Nhập mật khẩu" />
                        <input type="password" name="customer_password_confirm" id="password_confirm" required="required" placeholder="Nhập lại mật khẩu" oninput="check(this)" />
                        <input type="text" name="customer_phone" required="required" placeholder="Nhập số điện thoại" />
                        <button type="submit" class="btn btn-default">Đăng kí</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>


@endsection


<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Mật khẩu không khớp. Xin vui lòng nhập lại.');
        } else {

            input.setCustomValidity('');
        }
    }
</script>