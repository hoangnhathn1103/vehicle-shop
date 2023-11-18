<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public  $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository=$productRepository;
    }

    public function find(int $id)
    {
        $product = $this->repository->find($id);

        //rating
        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(),'rating'));
        $countRating = count($product->productComments);
        if($countRating != 0){
            $avgRating = $sumRating/$countRating;
        }

        $product -> avgRating = $avgRating;

        //color
        $arrColor = array_unique(array_column($product->productDetails->toArray(),'color'));
        $color = implode(', ',$arrColor);
        $product->productColor = $color;

        //size
        $arrSize = array_unique(array_column($product->productDetails->toArray(),'size'));
        $size = implode(', ',$arrSize);
        $product->productSize = $size;

        return $product;
    }

    public function getRelatedProducts($product, $limit=3)
    {
        return $this->repository->getRelatedProducts($product,$limit);
    }

    public function getFeaturedProduct()
    {
        return $this->repository->getFeaturedProduct();
    }

    public function getProductsByCate()
    {
        return [
            "kid"=>$this->repository->getProductsByCat(1),
            "adult"=>$this->repository->getProductsByCat(2),
            "motorbike"=>$this->repository->getProductsByCat(4),
            "scooter"=>$this->repository->getProductsByCat(5),
            "manualclutch"=>$this->repository->getProductsByCat(6),
        ];
    }

    public function getProductOnIndex($request)
    {
        return $this->repository->getProductOnIndex($request);
    }

    public function getProductsByCategory($categoryName, $request)
    {
        return $this->repository->getProductsByCategory($categoryName,$request);
    }

    public function getProductsByBrand($brandName, $request)
    {
        return $this->repository->getProductsByBrand($brandName,$request);
    }

}
