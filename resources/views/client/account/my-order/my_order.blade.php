@extends('client.layout.master2')
@section('title','Cart')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Đơn hàng của tôi</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="id">ID</td>
                        <td class="image">Ảnh</td>
                        <td class="description">Tên</td>
                        <td class="price">Thành tiền</td>
                        <td class="total">Thông tin</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td class="cart_product">
                            <a href=""><img src="client/images/product/{{$order->orderDetails[0]->product->productImages[0]->path ?? ''}}" width="100" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$order->orderDetails[0]->product->product_name}}
                                    @if(count($order->orderDetails)>1)
                                    và {{count($order->orderDetails) -1}} sản phẩm khác</a></h4>
                                    @endif
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{array_sum(array_column($order->orderDetails->toArray(),'total'))}} VND</p>
                        </td>
                        <td class="cart_price">
                            <a href="./account/my-order/{{$order->id}}">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

@endsection
