<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;

    protected $table = 'stock_out';

    protected $fillable = [
        'furniture_id',
        'buyer_id',
        'code',
        'name',
        'price',
        'amount',
        'initial_stock',
        'final_stock'
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
