@extends('client.layout.master2')
@section('title','Login')
@section('content')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    @if(session('notification'))
                        <div class="alert alert-warning" role="alert">
                            {{session('notification')}}
                        </div>
                    @endif
                    <form action="" method="post">
                        {{@csrf_field()}}
                        <input name="email" type="email" placeholder="Email" />
                        <input name="password" type="password" placeholder="Mật khẩu" />
                        <span>
								<input name="remember" type="checkbox" class="checkbox">
								Duy trì đăng nhập
							</span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
                <a href="./account/register">Đăng ký tài khoản mới</a>
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection
