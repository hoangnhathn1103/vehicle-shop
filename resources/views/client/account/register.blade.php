@extends('client.layout.master2')
@section('title','Login')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký tài khoản mới!</h2>
                    @if(session('notification'))
                        <div class="alert alert-warning" role="alert">
                            {{session('notification')}}
                        </div>
                    @endif
                    <form action="" method="post">
                        {{@csrf_field()}}
                        <input type="text" name="name" placeholder="Họ và tên *"/>
                        <input type="email" name="email" placeholder="Email *"/>
                        <input type="password" name="password" placeholder="Mật khẩu *"/>
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu *"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
                <a href="./account/login">Đăng nhập</a>
            </div>

        </div>
    </div>
</section><!--/form-->
@endsection
