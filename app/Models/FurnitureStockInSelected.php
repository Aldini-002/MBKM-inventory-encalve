<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureStockInSelected extends Model
{
    use HasFactory;

    protected $table = 'furniture_stock_in_selected';

    protected $fillable = [
        'furniture_id',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
