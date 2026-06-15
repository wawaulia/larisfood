<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    protected $fillable = [
        'return_number',
        'sale_id',
        'customer_name',
        'return_date',
        'total_return',
        'reason',
        'user_id',
    ];

    protected $casts = [
        'return_date' => 'date',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function items()
    {
        return $this->hasMany(ProductReturnItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}