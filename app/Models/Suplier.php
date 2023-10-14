<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'suplier';

    protected $fillable = ['name', 'description'];

    protected $with = ['stock_ins'];

    public function stock_ins()
    {
        return $this->hasMany(StockIn::class);
    }
}
