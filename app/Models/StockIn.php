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
        'code',
        'qty',
        'suplier',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
