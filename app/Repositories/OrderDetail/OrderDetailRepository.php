<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetails;
use App\Repositories\BaseRepository;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{

    public function getModel()
    {
        return OrderDetails::class;
    }
}
