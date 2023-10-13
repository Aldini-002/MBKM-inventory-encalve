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
        'code',
        'qty',
        'buyer',
    ];

    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }
}
