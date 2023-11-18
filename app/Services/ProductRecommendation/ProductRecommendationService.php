<?php

namespace App\Services\ProductRecommendation;

use App\Repositories\ProductRecommendation\ProductRecommendationRepositoryInterface;
use App\Services\BaseService;

class ProductRecommendationService extends  BaseService implements ProductRecommendationServiceInterface
{
    public $repository;

    public function __construct(ProductRecommendationRepositoryInterface $productRecommendationRepository)
    {
        $this -> repository= $productRecommendationRepository;
    }

    public function recommendItems($userId, $k=6){
        return $this->repository->recommendItems($userId, $k);
    }

    public function getProductRecommen($userId){
        return $this->repository->getProductRecommen($userId);
    }

}
