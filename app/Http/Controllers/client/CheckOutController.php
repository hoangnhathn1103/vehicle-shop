<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Ultilities\Constant;
use App\Ultilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    private $productService;
    private $productCategoryService;
    private $orderService;
    private $orderDetailService;
    private $brandService;
    public function __construct(
        ProductServiceInterface $productService,
        ProductCategoryServiceInterface $productCategoryService,
        OrderServiceInterface $orderService,
        OrderDetailServiceInterface $orderDetailService,
        BrandServiceInterface $brandService
    ) {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->brandService = $brandService;
    }
    public  function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        $brands = $this->brandService->all();
        $categories = $this->productCategoryService->all();

        return view('client.checkout.index', compact('carts', 'total', 'subtotal', 'categories', 'brands'));
    }

    public function addOrder(Request $request)
    {
        $data = $request->all();
        if ($request->payment_type == 'pay_later') {
            $data['status'] = Constant::order_status_ReceiveOrders;
        }
        if ($request->payment_type == 'online_payment') {
            $data['status'] = Constant::order_status_Finish;
        }
        $order = $this->orderService->create($data);

        $carts = Cart::content();

        foreach ($carts as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'total' => $cart->qty * $cart->price,

            ];
            $this->orderDetailService->create($data);
        }

        if ($request->payment_type == 'pay_later') {

            // đường dẫn đến tệp tin CSV
            $file_path = 'C:/DATN/DATN/DataCSV/data.csv';
            // mở tệp tin CSV
            $file = fopen($file_path, 'a');

            foreach ($carts as $cart) {

                // dữ liệu muốn thêm vào
                $data = array($request->user_id, $cart->id, $cart->qty);

                // ghi dữ liệu vào tệp tin
                fputcsv($file, $data);
            }
            // đóng tệp tin
            fclose($file);

            //Gửi email:
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $total, $subtotal);

            Cart::destroy();

            return redirect('checkout/result')->with('notification', 'Đặt hàng thành công!');
        }

        if ($request->payment_type == 'online_payment') {
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Mô tả',
                'vnp_Amount' => Cart::total(0, '', ''), //Tổng giá đơn hàng
            ]);

            return redirect()->to($data_url);
        }
    }

    public function vnPayCheck(Request $request)
    {
        //Lấy data từ URL (do VNPay gửi về qua $vnd_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //mã phản hồi kết quả thanh toán 00 = Thành công
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //order_id
        $vnp_Amount = $request->get('vnp_Amount'); //Số tiền thanh toán

        //Kiểm tra data, xem kết quả giao dịch trả về từ VNPay hợp lệ ko
        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 00) {

                //Gửi email:
                $order = $this->orderService->find($vnp_TxnRef); //$vnp_TnxRef chính là order_id
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $this->sendEmail($order, $total, $subtotal);

                Cart::destroy();

                return redirect('checkout/result')->with('notification', 'Đặt hàng thành công!');
            } else {
                $this->orderService->delete($vnp_TxnRef);

                return redirect('checkout/result')->with('notification', 'Đặt hàng không thành công!');
            }
        }
    }

    public function result()
    {
        $notification = session('notification');
        $brands = $this->brandService->all();
        $categories = $this->productCategoryService->all();
        return view('client.checkout.result', compact('notification', 'categories', 'brands'));
    }

    public function sendEmail($order, $total, $subtotal)
    {
        $email_to = $order->email;

        Mail::send(
            'client.checkout.email',
            compact('order', 'total', 'subtotal'),
            function ($message) use ($email_to) {
                $message->from('hoangnhat@gmail.com', 'Hoang Nhat Shop');
                $message->to($email_to, $email_to);
                $message->subject('Order Notification');
            }
        );
    }
}
