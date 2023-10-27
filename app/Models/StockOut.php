<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stock_out';

    protected $fillable = [
        'buyer_id',
        'furniture_id',
        'code',
        'furniture_code',
        'furniture_name',
        'furniture_price',
        'amount',
        'initial_stock',
        'final_stock',
        'total',
    ];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['buyer'] ?? false, function ($query, $buyer) {
            return $query->whereHas('buyer', function ($query) use ($buyer) {
                $query->where('name', $buyer);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('furniture_name', 'like', '%' . $search . '%')->orWhere('furniture_code', 'like', '%' . $search . '%');
        });
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
