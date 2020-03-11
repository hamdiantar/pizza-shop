<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['customer_id', 'pizza_id', 'status', 'quantity', 'size'];
}
