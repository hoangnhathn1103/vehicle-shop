<?php

namespace App\Services\Product;

use App\Services\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface
{
    public function getRelatedProducts($product, $limit=3);
    public function getFeaturedProduct();
    public function getProductsByCate();
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
    public function getProductsByBrand($brandName, $request);
}
