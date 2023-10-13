<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'application';

    protected $fillable = ['name'];

    protected $with = ['furnitures'];

    public function furnitures()
    {
        return $this->belongsToMany(Furniture::class, 'furniture_application', 'furniture_id', 'application_id');
    }
}
