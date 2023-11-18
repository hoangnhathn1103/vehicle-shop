<?php

namespace App\Repositories\ProductRecommendation;

use App\Repositories\RepositoryInterface;

interface ProductRecommendationRepositoryInterface extends RepositoryInterface
{
    public function getProductRecommen($userId);
}
