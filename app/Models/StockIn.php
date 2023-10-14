<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stock_in';

    protected $fillable = [
        'furniture_id',
        'suplier_id',
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

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
}
