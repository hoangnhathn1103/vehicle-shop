@extends('client.layout.master2')
@section('title','Cart')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
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
                        <a href=""><img src="client/images/product/{{$cart->options->image ?? ''}}" width="90" alt=""></a>
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
                            <input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$cart->qty}}" size="3">
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

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{$subtotal}}</span></li>
                        <li>Thuế <span>0 VND</span></li>
                        <li>Phí vận chuyển <span>Miễn phí</span></li>
                        <li>Thành tiền <span>{{$total}}</span></li>
                    </ul>
                    <a class="btn btn-default check_out" href="./checkout">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection
