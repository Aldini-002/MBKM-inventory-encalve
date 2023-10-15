<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureStockOutSelected extends Model
{
    use HasFactory;

    protected $table = 'furniture_stock_out_selected';

    protected $fillable = [
        'furniture_id',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
