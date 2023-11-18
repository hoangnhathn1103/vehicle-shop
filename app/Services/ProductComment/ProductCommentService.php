<?php

namespace App\Services\ProductComment;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\BaseService;

class ProductCommentService extends  BaseService implements ProductCommentServiceInterface
{
    public $repository;

    public function __construct(ProductRepositoryInterface $productCommentRepository)
    {
        $this -> repository= $productCommentRepository;
    }

}
