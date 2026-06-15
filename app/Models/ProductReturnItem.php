<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReturnItem extends Model
{
    protected $fillable = [
        'product_return_id',
        'product_id',
        'product_name',
        'qty',
        'selling_price',
        'subtotal',
        'back_to_stock',
        'reason',
    ];

    protected $casts = [
        'back_to_stock' => 'boolean',
    ];

    public function productReturn()
    {
        return $this->belongsTo(ProductReturn::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}