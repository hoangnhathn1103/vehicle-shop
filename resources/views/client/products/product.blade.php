@extends('client.layout.master')
@section('title', 'Product')
@section('content')
    <div class="col-sm-12 padding-right">
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-8">
                <div class="view-product">
                    <img src="client/images/product/{{ $product->productImages[0]->path ?? '' }}" alt="" />
                    <h3>ZOOM</h3>
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach ($product->productImages as $productImage)
                                <a href=""><img width="95"
                                        src="client/images/product/{{ $productImage->path ?? '' }}" alt=""></a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Controls -->
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="product-information">
                    <!--/product-information-->
                    <img src="client/images/home/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $product->product_name }}</h2>
                    <p><b>Xếp hạng:</b> {{ $product->avgRating }}/5</p>
                    @if ($product->qty != 0)
                        <p><b>Tình trạng:</b> Còn hàng({{ $product->qty }}) </p>
                    @else
                        <p><b>Tình trạng:</b> Hết hàng </p>
                    @endif
                    <p><b>Màu sắc:</b> {{ $product->productColor }}</p>
                    <p><b>Kích thước:</b> {{ $product->productSize }} inches</p>
                    <p><b>Cân nặng:</b> {{ $product->weight }}kg</p>
                    <p><b>Category:</b> {{ $product->productCategory->category_name }}</p>
                    <p><b>Tag:</b> {{ $product->tag }}</p>
                    <span>
                        @if ($product->discount != null)
                            <span>Sale: {{ $product->discount }} VND</span>
                            <span>Giá gốc: {{ $product->price }} VND</span>
                        @else
                            <span>{{ $product->price }} VND</span>
                        @endif
                    </span>
                    @if (Auth::check())
                        <form action="./cart/add" method="post">
                            {{ csrf_field() }}
                            <span>
                                <label>Số lượng:</label>
                                <input name="qty" type="text" value="1" />
                                <input name="productId_hiden" type="hidden" value="{{ $product->id }}" />
                                <button type="submit" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm vào giỏ
                                </button>
                            </span>
                        </form>
                    @else
                        <form action="./account/login" method="">
                            <span>
                                <label>Số lượng:</label>
                                <input name="qty" type="text" value="1" />
                                <input name="productId_hiden" type="hidden" value="{{ $product->id }}" />
                                <button type="submit" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Thêm vào giỏ
                                </button>
                            </span>
                        </form>
                    @endif
                    <a href=""><img src="client/images/share.png" class="share img-responsive" alt="" /></a>
                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->

        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh giá ({{ count($product->productComments) }})</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    {{ $product->description }}
                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        @foreach ($product->productComments as $productComment)
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>{{ $productComment->name }}</a></li>
                                <li><a href=""><i
                                            class="fa fa-calendar-o"></i>{{ date('M d, Y', strtotime($productComment->created_at)) }}</a>
                                </li>
                            </ul>
                            <p>{{ $productComment->messages }}</p>
                        @endforeach
                        <p><b>Write Your Review</b></p>
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id"
                                value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                            <span>
                                <input type="text" name="name" placeholder="Tên của bạn" />
                                <input type="email" name="email" placeholder="Email" />
                            </span>
                            <textarea name="messages"></textarea>
                            <b>Rating: </b>
                            <div class="personal-rating">
                                <h6>Your Rating</h6>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5" title="text">5 sao</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="text">4 sao</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="text">3 sao</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="text">2 sao</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="text">1 sao</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default pull-right">
                                Gửi
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--/category-tab-->

        <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Sản phẩm liên quan</h2>
            @foreach ($relatedProduct as $relatedProduct)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="client/images/product/{{ $relatedProduct->productImages[0]->path ?? '' }}"
                                    alt="" />
                                @if ($relatedProduct->discount != null)
                                    <h2>{{ $relatedProduct->discount }} VND</h2>
                                @else
                                    <h2>{{ $relatedProduct->price }} VND</h2>
                                @endif
                                <p>{{ $relatedProduct->product_name }}</p>
                                <a href="products/product/{{ $relatedProduct->id }}"
                                    class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                    giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
