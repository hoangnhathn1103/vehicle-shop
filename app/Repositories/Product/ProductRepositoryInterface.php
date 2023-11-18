<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product, $limit=3);
    public function getFeaturedProduct();
    public function getProductsByCat(int $categoryId);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
    public function getProductsByBrand($brandName, $request);
}
