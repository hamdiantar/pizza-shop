<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends Repository
{
    public function model(): string
    {
       return Customer::class;
    }
}
