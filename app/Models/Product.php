<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $casts = [
    //     'id' => 'integer',
    //     'category_id' => 'integer',
    // ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function versions()
    {
        return $this->belongsToMany(Version::class, 'product_version');
    }

    public function availableBalance()
    {
        return $this->belongsToMany(AvailableBalance::class, 'product_aviable_balance');
    }
}
