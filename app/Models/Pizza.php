<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pizza extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['flavor', 'price'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'pizza_sizes');
    }
}
