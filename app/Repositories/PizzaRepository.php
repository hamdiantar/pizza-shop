<?php

namespace App\Repositories;

use App\Models\Pizza;

class PizzaRepository extends Repository
{
    public function model(): string
    {
        return Pizza::class;
    }
}
