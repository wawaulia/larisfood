<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'cost_price',
        'selling_price',
        'stock',
        'image',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function productReturnItems()
    {
        return $this->hasMany(ProductReturnItem::class);
    }

    public function getProfitPerItemAttribute()
    {
        return $this->selling_price - $this->cost_price;
    }

    public function isAvailable()
    {
        return $this->status === 'aktif' && $this->stock > 0;
    }
}