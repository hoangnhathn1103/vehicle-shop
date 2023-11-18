<?php

namespace App\Services\ProductRecommendation;

use App\Services\ServiceInterface;

interface ProductRecommendationServiceInterface extends ServiceInterface
{
    public function recommendItems($userId, $k=6);

    public function getProductRecommen($userId);
}
