<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';

    protected $fillable = ['name'];

    protected $with = ['furnitures'];

    public function furnitures()
    {
        return $this->belongsToMany(Furniture::class, 'furniture_material', 'furniture_id', 'material_id');
    }
}
