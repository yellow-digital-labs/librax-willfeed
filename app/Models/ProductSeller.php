<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class ProductSeller extends Model
{
    use HasFactory;
    protected $table = 'product_sellers';

    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function seller() {
        return $this->belongsTo('App\Models\User');
    }
}
