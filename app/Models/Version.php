<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    protected $guarded = [];

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_version');
    }
}
