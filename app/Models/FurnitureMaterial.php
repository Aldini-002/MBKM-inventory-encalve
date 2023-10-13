<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnitureMaterial extends Model
{
    use HasFactory;

    protected $table = 'furniture_material';

    protected $fillable = ['furniture_id', 'material_id'];
}
