<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [];

    public function productSeller() {
        return $this->hasMany('App\Models\ProductSeller');
    }
}
