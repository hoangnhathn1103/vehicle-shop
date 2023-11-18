<?php

namespace App\Services\ProductCategory;

use App\Repositories\ProductCategory\ProductCategoryRespositoryInterface;
use App\Services\BaseService;

class ProductCategoryService extends BaseService implements ProductCategoryServiceInterface
{
    public $repository;

    public function __construct(ProductCategoryRespositoryInterface $productCategoryRespository)
    {
        $this->repository=$productCategoryRespository;
    }
}
