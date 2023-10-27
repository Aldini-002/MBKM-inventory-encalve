<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stock_in';

    protected $fillable = [
        'suplier_id',
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

        $query->when($filters['suplier'] ?? false, function ($query, $suplier) {
            return $query->whereHas('suplier', function ($query) use ($suplier) {
                $query->where('name', $suplier);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('furniture_name', 'like', '%' . $search . '%')->orWhere('furniture_code', 'like', '%' . $search . '%');
        });
    }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }
}
