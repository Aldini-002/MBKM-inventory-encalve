<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $table = 'buyer';

    protected $fillable = ['name', 'description'];

    protected $with = ['stock_outs'];

    public function stock_outs()
    {
        return $this->hasMany(StockOut::class);
    }
}
