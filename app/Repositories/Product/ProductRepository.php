<?php

namespace App\Repositories\Product;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }

    public function getRelatedProducts($product, $limit=3)
    {
        return $this->model->where('category_id',$product->category_id)
            ->where('tag',$product->tag)
            ->limit($limit)
            ->get();
    }

    public function getFeaturedProduct()
    {
        return $this->model->where('featured',true)->limit(6)
            ->get();
    }

    public function getProductsByCat(int $categoryId)
    {
        return $this->model->where('category_id',$categoryId)
                ->limit(6)
                ->get();
    }

    public function getProductOnIndex($request)
    {
        $search = $request->search ?? '';
        $products = $this->model->where('product_name','like','%'.$search.'%');
        $products = $products->paginate(9);
        return $products;
    }

    public function getProductsByCategory($categoryName, $request)
    {
       $products = ProductCategory::where('category_name', $categoryName)->first()->products->toQuery();
       $products=$products->paginate(9);
       return $products;
    }

    public function getProductsByBrand($brandName, $request)
    {
       $products = Brand::where('name', $brandName)->first()->products->toQuery();
       $products=$products->paginate(9);
       return $products;
    }
}
