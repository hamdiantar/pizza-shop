<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends Repository
{
    public function model(): string
    {
        return Order::class;
    }
}
