<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Ultilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    private $productCategoryService;
    private $userService;
    private $orderService;
    private $brandService;

    public function __construct(
        ProductCategoryServiceInterface $productCategoryService,
        UserServiceInterface $userService,
        OrderServiceInterface $orderService,
        BrandServiceInterface $brandService
    ) {
        $this->productCategoryService = $productCategoryService;
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->brandService = $brandService;
    }

    public function login()
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        return view('client.account.login', compact('categories', 'brands'));
    }

    public function register()
    {
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        return view('client.account.register', compact('categories', 'brands'));
    }

    public function checkLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => Constant::user_level_client,
        ];
        $remember = $request->remember;
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended('');
        } else {
            return back()->with('notification', 'Email hoặc mật khẩu sai!!!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function postRegister(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with('notification', 'Mật khẩu xác nhận không đúng!!!');
        }

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return back()->with('notification', 'Địa chỉ email đã tồn tại!!!');
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 2,
        ];

        $this->userService->create($data);

        return redirect('account/login')
            ->with('notification', 'Đăng ký thành công.');
    }

    public function myOrderIndex()
    {
        $orders = $this->orderService->getOrderByUserId(Auth::id());
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        return view('client.account.my-order.my_order', compact('categories', 'orders', 'brands'));
    }

    public function myOrderShow($id)
    {
        $order = $this->orderService->find($id);
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        return view('client.account.my-order.orderDetail', compact('categories', 'order', 'brands'));
    }
}
