@extends('admin.layout.master')

@section('title','Order')
@section('content')

            <!-- Main -->
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                            </div>
                            <div>
                                Đơn hàng
                                <div class="page-title-subheading">
                                    Xem, tạo, cập nhật, xóa và quản lý.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body display_data">

                                <div class="table-responsive">
                                    <h2 class="text-center">Danh sách sản phẩm</h2>
                                    <hr>
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($order->orderDetails as $orderDetail)
                                        <tr>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img style="height: 60px;"
                                                                     data-toggle="tooltip" title="Image"
                                                                     data-placement="bottom"
                                                                     src="client/images/product/{{$orderDetail->product->productImages[0]->path}}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{$orderDetail->product->product_name}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{$orderDetail->qty}}
                                            </td>
                                            @if($orderDetail->product->discount != null)
                                                <td class="text-center">{{$orderDetail->product->discount}} VND</td>
                                            @else
                                            <td class="text-center">{{$orderDetail->product->price}} VND</td>
                                            @endif
                                            <td class="text-center">
                                                {{$orderDetail->total}}
                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>



                                <h2 class="text-center mt-5">Thông tin đơn hàng</h2>
                                <hr>
                                <div class="position-relative row form-group">
                                    <label for="name" class="col-md-3 text-md-right col-form-label">
                                        Họ và tên
                                    </label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->first_name.' '.$order->last_name}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="email" class="col-md-3 text-md-right col-form-label">Email</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->email}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="phone" class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->phone}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                        Địa chỉ</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->street_address}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="town_city" class="col-md-3 text-md-right col-form-label">
                                        Thành phố</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->town_city}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="country"
                                           class="col-md-3 text-md-right col-form-label">Quốc gia</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->country}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
                                        Postcode Zip</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->postcode_zip}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="payment_type" class="col-md-3 text-md-right col-form-label">Phương thức thanh toán</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->payment_type}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="status" class="col-md-3 text-md-right col-form-label">Trạng thái</label>
                                    <div class="col-md-9 col-xl-8">
                                        <div class="badge badge-dark mt-2">
                                            {{\App\Ultilities\Constant::$order_status[$order->status]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="description"
                                           class="col-md-3 text-md-right col-form-label">Ghi chú</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$order->messages}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main -->

@endsection
