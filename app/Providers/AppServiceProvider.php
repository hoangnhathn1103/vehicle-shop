<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRespository;
use App\Repositories\ProductCategory\ProductCategoryRespositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\ProductRecommendation\ProductRecommendationRepository;
use App\Repositories\ProductRecommendation\ProductRecommendationRepositoryInterface;
use App\Services\Blog\BlogService;
use App\Services\Blog\BlogServiceInterface;
use App\Services\Order\OrderService;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailService;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryService;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentService;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Services\Brand\BrandService;
use App\Services\Brand\BrandServiceInterface;
use App\Services\ProductRecommendation\ProductRecommendationService;
use App\Services\ProductRecommendation\ProductRecommendationServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );

        //ProductComment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );

        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );

        //Blog
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );

        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );

        //ProductCategory
        $this->app->singleton(
            ProductCategoryRespositoryInterface::class,
            ProductCategoryRespository::class
        );

        $this->app->singleton(
            ProductCategoryServiceInterface::class,
            ProductCategoryService::class
        );

        //Brand
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );

        //Order
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );

        //OrderDetail
        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );

        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );

        //OrderDetail
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );

        //ProductRecommendation
        $this->app->singleton(
            ProductRecommendationRepositoryInterface::class,
            ProductRecommendationRepository::class
        );

        $this->app->singleton(
            ProductRecommendationServiceInterface::class,
            ProductRecommendationService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
