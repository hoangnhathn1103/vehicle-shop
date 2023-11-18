<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductRecommendation\ProductRecommendationServiceInterface;

class HomeController extends Controller
{
    private $productService;
    private $blogService;
    private $productCategoryService;
    private $brandService;
    private $productRecommendationService;

    public function __construct(ProductServiceInterface $productService,
                                BlogServiceInterface $blogService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService,
                                ProductRecommendationServiceInterface $productRecommendationService)
    {
        $this->productService=$productService;
        $this->blogService=$blogService;
        $this->productCategoryService=$productCategoryService;
        $this->brandService=$brandService;
        $this->productRecommendationService=$productRecommendationService;
    }

    public function index(){

        $allProducts = $this->productService->all();
        $featuredProducts=$this->productService->getFeaturedProduct();
        $productsByCat=$this->productService->getProductsByCate();
        $blogs = $this->blogService->getLatestBlogs();
        $categories=$this->productCategoryService->all();
        $brands=$this->brandService->all();
        $categories1=$this->productCategoryService->all();
        if (auth()->check()) {
            // Lấy user_id của người dùng đang đăng nhập
            $userId = auth()->user()->id;

            if($productRecomment = $this->productRecommendationService->getProductRecommen($userId)==null)
            {
                $productRecomment = $this->productService->getFeaturedProduct();
            }
            else
                $productRecomment = $this->productRecommendationService->getProductRecommen($userId);
        } else {
            $productRecomment=$this->productService->getFeaturedProduct();
        }
        $slider = Slider::all();
        return view('client.home.home', compact('allProducts','blogs','featuredProducts','productsByCat','categories','categories1','slider','brands','productRecomment'));
    }

}
