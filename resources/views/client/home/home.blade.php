@extends('client.layout.master')
@section('title', 'Product')
@section('content')
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Sản phẩm</h2>
        @foreach ($featuredProducts as $Product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="client/images/product/{{ $Product->productImages[0]->path ?? '' }}" alt=""
                                width="50" />
                            @if ($Product->discount != null)
                                <h2>{{ $Product->discount }} VND</h2>
                            @else
                                <h2>{{ $Product->price }} VND</h2>
                            @endif
                            <p>{{ $Product->product_name }}</p>
                            <a href="products/product/{{ $Product->id }}" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <!--features_items-->

    <div class="category-tab">
        <!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#kid" data-toggle="tab">Xe đạp trẻ em</a></li>
                <li><a href="#adult" data-toggle="tab">Xe đạp người lớn</a></li>
                <li><a href="#motorbike" data-toggle="tab">Xe máy</a></li>
                <li><a href="#scooter" data-toggle="tab">Xe ga</a></li>
                <li><a href="#manualclutch" data-toggle="tab">Xe côn tay</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="kid">
                @foreach ($productsByCat['kid'] as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="client/images/product/{{ $product->productImages[0]->path ?? '' }}"
                                        alt="" />
                                    @if ($product->discount != null)
                                        <h2>{{ $product->discount }} VND</h2>
                                    @else
                                        <h2>{{ $product->price }} VND</h2>
                                    @endif
                                    <p>{{ $product->product_name }}</p>
                                    <a href="products/product/{{ $product->id }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="adult">
                @foreach ($productsByCat['adult'] as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="client/images/product/{{ $product->productImages[0]->path ?? '' }}"
                                        alt="" />
                                    @if ($product->discount != null)
                                        <h2>{{ $product->discount }} VND</h2>
                                    @else
                                        <h2>{{ $product->price }} VND</h2>
                                    @endif
                                    <p>{{ $product->product_name }}</p>
                                    <a href="products/product/{{ $product->id }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="motorbike">
                @foreach ($productsByCat['motorbike'] as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="client/images/product/{{ $product->productImages[0]->path ?? '' }}"
                                        alt="" />
                                    @if ($product->discount != null)
                                        <h2>{{ $product->discount }} VND</h2>
                                    @else
                                        <h2>{{ $product->price }} VND</h2>
                                    @endif
                                    <p>{{ $product->product_name }}</p>
                                    <a href="products/product/{{ $product->id }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="scooter">
                @foreach ($productsByCat['scooter'] as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="client/images/product/{{ $product->productImages[0]->path }}"
                                        alt="" />
                                    @if ($product->discount != null)
                                        <h2>{{ $product->discount }} VND</h2>
                                    @else
                                        <h2>{{ $product->price }} VND</h2>
                                    @endif
                                    <p>{{ $product->product_name }}</p>
                                    <a href="products/product/{{ $product->id }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="tab-pane fade" id="manualclutch">
                @foreach ($productsByCat['manualclutch'] as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="client/images/product/{{ $product->productImages[0]->path ?? '' }}"
                                        alt="" />
                                    @if ($product->discount != null)
                                        <h2>{{ $product->discount }} VND</h2>
                                    @else
                                        <h2>{{ $product->price }} VND</h2>
                                    @endif
                                    <p>{{ $product->product_name }}</p>
                                    <a href="products/product/{{ $product->id }}" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--/category-tab-->

    <div class="recommended_items">
        <!--hit_items-->
        <h2 class="title text-center">Sản phẩm hot</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($featuredProducts as $Product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="client/images/product/{{ $Product->productImages[0]->path ?? '' }}"
                                            alt="" />
                                        @if ($Product->discount != null)
                                            <h2>{{ $Product->discount }} VND</h2>
                                        @else
                                            <h2>{{ $Product->price }} VND</h2>
                                        @endif
                                        <p>{{ $Product->product_name }}</p>
                                        <a href="products/product/{{ $Product->id }}"
                                            class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào
                                            giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--/recommended_items-->
    @if (Auth::check())
        <h2 class="title text-center">Dành cho bạn</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($productRecomment as $Product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="client/images/product/{{ $Product->productImages[0]->path ?? '' }}"
                                            alt="" />
                                        @if ($Product->discount != null)
                                            <h2>{{ $Product->discount }} VND</h2>
                                        @else
                                            <h2>{{ $Product->price }} VND</h2>
                                        @endif
                                        <p>{{ $Product->product_name }}</p>
                                        <a href="products/product/{{ $Product->id }}"
                                            class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                            vào
                                            giỏ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    @else
    @endif

@endsection

@section('top_footer')
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span></span>Hoàng Nhất</h2>
                        <p>Hoàng Nhất chuyên cung cấp các sản phẩm Xe đạp trẻ em,
                            người lớn, mini, Xe đạp Nam, Xe đạp Nữ ,Xe đạp địa hình, Xe đạp đường phố, Xe đạp thể thao</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    @foreach ($blogs as $blogs)
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="client/images/blog/{{ $blogs->image }}" alt="" />
                                    </div>
                                </a>
                                <p>{{ $blogs->title }}</p>
                                <h2>{{ date('M d, Y', strtotime($blogs->created_at)) }}</h2>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-sm-3">
                    <div class="address">
                        <img src="client/images/home/map.png" alt="" />
                        <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
