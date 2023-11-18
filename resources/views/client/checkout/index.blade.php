
@extends('client.layout.master2')
@section('title','Checkout')
@section('content')
<section id="cart_items">
    <div class="container">

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    @if(Cart::count() >0)
                    <div class="bill-to">
                        <p>Hóa đơn</p>
                        <div class="form-one">
                            <form action="./checkout" method="post">
                                {{csrf_field()}}
                                <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id ?? ''}}">
                                <input type="text" value="{{Auth::user()->email ?? ''}}" name="email" placeholder="Email*">
                                <input type="text" value="{{Auth::user()->name ?? ''}}" name="first_name" placeholder="Tên *">
                                <input type="text" name="last_name" placeholder="Họ  *">
                                <input type="text" value="{{Auth::user()->street_address ?? ''}}" name="street_address" placeholder="Địa chỉ *">
                                <input type="text" value="{{Auth::user()->country ?? ''}}" name="country" placeholder="Quốc gia *">
                                <input type="text" value="{{Auth::user()->postcode_zip ?? ''}}" name="postcode_zip" placeholder="Postcode Zip *">
                                <input type="text" value="{{Auth::user()->town_city ?? ''}}" name="town_city" placeholder="Thành Phố *">
                                <input type="text" value="{{Auth::user()->phone ?? ''}}" name="phone" placeholder="Điện thoại *">
                                <textarea name="messages"  placeholder="Ghi chú" rows="10"></textarea>

                                <div class="payment-options">
                                    <span>
                                        <label><input type="radio" name="payment_type" value="pay_later"> Thanh toán sau</label>
                                    </span>
                                    <span>
                                        <label><input type="radio" name="payment_type" value="online_payment"> Thanh toán online</label>
                                    </span>
                                </div>

                                <input type="submit" value="Gửi" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </div>
                    @else
                        <div class="col-sm-12 clearfix">
                            <h4>Giỏ hàng trống!</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Kiểm tra và thanh toán</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Sản phẩm</td>
                    <td class="description"></td>
                    <td class="price">Đơn giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr data-row="{{$cart->rowId}}">
                        <td class="cart_product">
                            <a href=""><img src="client/images/product/{{$cart->options->image ?? ''}}" width="80" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cart->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart->price,2)}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="./cart/update_cart" method="post">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$cart->qty}}" size="2">
                                    <input type="hidden" value="{{$cart->rowId}}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($cart->price * $cart->qty,2)}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="cart/delete/{{$cart->rowId}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
                            <tr>
                                <td>Tổng</td>
                                <td>{{$subtotal}}</td>
                            </tr>
                            <tr>
                                <td>Thuế</td>
                                <td>0 VND</td>
                            </tr>
                            <tr class="shipping-cost">
                                <td>Phí vận chuyển</td>
                                <td>Miễn phí</td>
                            </tr>
                            <tr>
                                <td>Tổng</td>
                                <td><span>{{$total}}</span></td>
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
