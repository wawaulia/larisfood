<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_phone',
        'sale_date',
        'total_amount',
        'total_cost',
        'profit',
        'status',
        'note',
        'user_id',
    ];

    protected $casts = [
        'sale_date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productReturns()
    {
        return $this->hasMany(ProductReturn::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'diproses' => 'Diproses',
            'dikemas' => 'Dikemas',
            'dikirim' => 'Dikirim',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            'return' => 'Return',
            default => 'Tidak diketahui',
        };
    }
}