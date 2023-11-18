@extends('admin.layout.master')

@section('title','Product')
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
                                Sản phẩm
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

                                <div class="position-relative row form-group">
                                    <label for="" class="col-md-3 text-md-right col-form-label">Images</label>
                                    <div class="col-md-9 col-xl-8">
                                        <ul class="text-nowrap overflow-auto" id="images">
                                            @foreach($product->productImages as $productImage)
                                            <li class="d-inline-block mr-1" style="position: relative;">
                                                <img style="height: 150px;" src="./client/images/product/{{$productImage->path}}"
                                                     alt="Image">
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="brand_id"
                                           class="col-md-3 text-md-right col-form-label">Ảnh sản phẩm</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p><a href="./admin/product/{{$product->id}}/image">Quản lý ảnh</a></p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="brand_id"
                                           class="col-md-3 text-md-right col-form-label">Thông tin sản phẩm</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p><a href="./admin/product/{{$product->id}}/detail">Quản lý thông tin</a></p>
                                    </div>
                                </div>


                                <div class="position-relative row form-group">
                                    <label for="product_category_id"
                                           class="col-md-3 text-md-right col-form-label">Loại</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->productCategory->category_name}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->product_name}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="content"
                                           class="col-md-3 text-md-right col-form-label">Nội dung</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->content}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="price"
                                           class="col-md-3 text-md-right col-form-label">Đơn giá</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->price}} VND</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="discount"
                                           class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->discount}} VND</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="qty"
                                           class="col-md-3 text-md-right col-form-label">Số lượng</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->qty}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="weight"
                                           class="col-md-3 text-md-right col-form-label">Trọng lượng</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->weight}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="sku"
                                           class="col-md-3 text-md-right col-form-label">SKU</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->sku}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="tag"
                                           class="col-md-3 text-md-right col-form-label">Tag</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->tag}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="featured"
                                           class="col-md-3 text-md-right col-form-label">Hot</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{{$product->featured ? 'Yes':'No'}}</p>
                                    </div>
                                </div>

                                <div class="position-relative row form-group">
                                    <label for="description"
                                           class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                    <div class="col-md-9 col-xl-8">
                                        <p>{!! $product->description  !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main -->
@endsection
