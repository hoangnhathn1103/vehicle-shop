<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

session_start();


class CartController extends Controller
{
    private $productService;
    private $productCategoryService;
    private $brandService;
    public function __construct(ProductServiceInterface $productService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService)
    {
        $this->productService = $productService;
        $this->productCategoryService=$productCategoryService;
        $this->brandService=$brandService;
    }

    public function index()
    {
        $carts = Cart::content();
        $total =Cart::total();
        $subtotal =Cart::subtotal();
        $brands=$this->brandService->all();
        $categories=$this->productCategoryService->all();

        return view('client.cart.cart',compact('carts','total','subtotal','categories','brands'));
    }

    /*public function add(Request $request)
    {

        if($request -> ajax()){
            $product = $this->productService->find($request->productId);
            $response['cart']=Cart::add([
                'id'=>$product->id,
                'name'=>$product->product_name,
                'qty'=>1,
                'price'=>$product->discount ?? $product->price,
                'weight'=>$product->weight ?? 0,
                'options'=>[
                    'images'=>$product->productImages,
                ],
            ]);

            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            return $response;
        }


        return back();
    }*/



    public function add(Request $request)
    {
        $productId = $request->productId_hiden;
        $quantity = $request->qty;

        $product_info =  $this->productService->find($productId);
        $data['id']=$product_info->id;
        $data['name']=$product_info->product_name;
        $data['qty']=$quantity;
        if($product_info->discount != null)
            $data['price']=$product_info->discount;
        else
            $data['price']=$product_info->price;
        $data['weight']=$product_info->weight;
        $data['options']['image']=$product_info->productImages[0]->path;
        Cart::add($data);

        return Redirect::to('/cart/');
    }

    public function delete($rowId)
    {
        Cart::update($rowId,0);
        return Redirect::to('/cart/');
    }

    public function update(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/cart/');
    }
}
