<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureStockIn extends Model
{
    use HasFactory;

    protected $table = 'furniture_stock_in';

    protected $fillable = [
        'stock_in_id',
        'furniture_id',
        'furniture_code',
        'furniture_name',
        'furniture_price',
        'amount',
        'initial_stock',
        'final_stock',
    ];
}
