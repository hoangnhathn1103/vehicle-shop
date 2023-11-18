
@extends('client.layout.master2')
@section('title','Checkout')
@section('content')
    <section id="cart_items">
        <div class="container">

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Chi tiết đơn hàng</li>
                </ol>
            </div><!--/breadcrums-->

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                            <div class="bill-to">
                                <p>Mã đơn hàng: {{$order->id}}</p>
                                <div class="form-one">
                                    <form action="" method="">
                                        <input type="text" disabled value="{{$order->email}}" name="email" placeholder="Email*">
                                        <input type="text" disabled value="{{$order->first_name}}" name="first_name" placeholder="First Name *">
                                        <input type="text" disabled value="{{$order->last_name}}" name="last_name" placeholder="Last Name *">
                                        <input type="text" disabled value="{{$order->street_address}}" name="street_address" placeholder="Address *">
                                        <input type="text" disabled value="{{$order->country}}" name="country" placeholder="Quốc gia *">
                                        <input type="text" disabled value="{{$order->postcode_zip}}" name="postcode_zip" placeholder="Postcode Zip *">
                                        <input type="text" disabled value="{{$order->town_city}}" name="town_city" placeholder="Thành Phố *">
                                        <input type="text" disabled value="{{$order->phone}}" name="phone" placeholder="Điện thoại *">
                                        <textarea disabled value="{{$order->messages}}" name="messages"  placeholder="Ghi chú" rows="10"></textarea>

                                        <div class="payment-options">
                                    <span>
                                        <label><input disabled type="radio" name="payment_type" value="pay_later" {{$order->payment_type == 'pay_later' ? 'checked':''}}> Thanh toán sau</label>
                                    </span>
                                            <span>
                                        <label><input disabled type="radio" name="payment_type" value="online_payment" {{$order->payment_type == 'online_payment' ? 'checked':''}}> Thanh toán online</label>
                                    </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="client/images/product/{{$orderDetail->product->productImages[0]->path ?? ''}}" width="50" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$orderDetail->product->product_name}}</a></h4>
                            </td>

                            <td class="cart_quantity">
                                <p>{{$orderDetail->qty}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{$orderDetail->total}} VND</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tổng</td>
                                    <td>{{array_sum(array_column($order->orderDetails->toArray(),'total'))}} VND</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection
