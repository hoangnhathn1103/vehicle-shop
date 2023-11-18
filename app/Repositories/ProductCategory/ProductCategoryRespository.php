<?php

namespace App\Repositories\ProductCategory;


use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductCategoryRespository extends BaseRepository implements  ProductCategoryRespositoryInterface
{

    public function getModel()
    {
        return ProductCategory::class;
    }
}
