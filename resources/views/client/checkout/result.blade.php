
@extends('client.layout.master2')
@section('title','Result')
@section('content')
    <section id="cart_items">
        <div class="container">

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Kết quả</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                            <div class="col-sm-12 clearfix">
                                <h4>{{$notification}}</h4>
                            </div>
                        <a href="./" class="btn btn-primary btn-sm">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>

        </div>
    </section> <!--/#cart_items-->
@endsection
