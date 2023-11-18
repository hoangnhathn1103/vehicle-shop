@extends('admin.layout.master')

@section('title','User')
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
                                Người dùng
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
                            <div class="card-body">
                                <form method="post" action="admin/user" enctype="multipart/form-data">
                                    @csrf

                                    @include('admin.components.notification')

                                    <div class="position-relative row form-group">
                                        <label for="image"
                                               class="col-md-3 text-md-right col-form-label">Avatar</label>
                                        <div class="col-md-9 col-xl-8">
                                            <img style="height: 200px; cursor: pointer;"
                                                 class="thumbnail rounded-circle" data-toggle="tooltip"
                                                 title="Click to change the image" data-placement="bottom"
                                                 src="dashboard/assets/images/add-image-icon.jpg" alt="Avatar">
                                            <input name="image" type="file" onchange="changeImg(this)"
                                                   class="image form-control-file" style="display: none;" value="">
                                            <input type="hidden" name="image_old" value="">
                                            <small class="form-text text-muted">
                                                Click vào ảnh để thay đổi
                                            </small>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="name" id="name" placeholder="Tên" type="text"
                                                   class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="email"
                                               class="col-md-3 text-md-right col-form-label">Email</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="email" id="email" placeholder="Email" type="email"
                                                   class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="password"
                                               class="col-md-3 text-md-right col-form-label">Mật khẩu</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="password" id="password" placeholder="Mật khẩu" type="password"
                                                   class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="password_confirmation"
                                               class="col-md-3 text-md-right col-form-label">Xác nhận mật khẩu</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="password_confirmation" id="password_confirmation" placeholder="Xác nhận mật khẩu" type="password"
                                                   class="form-control" value="">
                                        </div>
                                    </div>


                                    <div class="position-relative row form-group">
                                        <label for="country"
                                               class="col-md-3 text-md-right col-form-label">Quốc gia</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="country" id="country" placeholder="Quốc gia"
                                                   type="text" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="street_address" class="col-md-3 text-md-right col-form-label">
                                            Địa chỉ
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="street_address" id="street_address"
                                                   placeholder="Địa chỉ" type="text" class="form-control"
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="postcode_zip" class="col-md-3 text-md-right col-form-label">
                                            Postcode Zip
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="postcode_zip" id="postcode_zip"
                                                   placeholder="Postcode Zip" type="text" class="form-control"
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="town_city" class="col-md-3 text-md-right col-form-label">
                                            Thành phố
                                        </label>
                                        <div class="col-md-9 col-xl-8">
                                            <input name="town_city" id="town_city" placeholder="Thành phố"
                                                   type="text" class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="phone"
                                               class="col-md-3 text-md-right col-form-label">Điện thoại</label>
                                        <div class="col-md-9 col-xl-8">
                                            <input required name="phone" id="phone" placeholder="Điên thoại" type="tel"
                                                   class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="level"
                                               class="col-md-3 text-md-right col-form-label">Level</label>
                                        <div class="col-md-9 col-xl-8">
                                            <select required name="level" id="level" class="form-control">
                                                <option value="">-- Level --</option>

                                                @foreach(\App\Ultilities\Constant::$user_level as $key=>$value)
                                                <option value={{$key}}>
                                                    {{$value}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group">
                                        <label for="description"
                                               class="col-md-3 text-md-right col-form-label">Mô tả</label>
                                        <div class="col-md-9 col-xl-8">
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="position-relative row form-group mb-1">
                                        <div class="col-md-9 col-xl-8 offset-md-2">
                                            <a href="./admin/user" class="border-0 btn btn-outline-danger mr-1">
                                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                                        <i class="fa fa-times fa-w-20"></i>
                                                    </span>
                                                <span>Trở lại</span>
                                            </a>

                                            <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                                <span>Lưu</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Main -->
@endsection
