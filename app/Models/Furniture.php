<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'description',
        'length',
        'width',
        'height',
        'tag',
        'size',
        'keyword',
        'price',
        'payment_options',
        'payment_terms',
        'delivery_terms',
        'delivery_time',
        'lead_time',
        'packing',
        'port',
        'certification',
        'qty_per_month',
        'moq',
        'stock',
        'convertible',
        'adjustable',
        'folded',
        'extendable',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->where('tag', 'like', '%' . $category . '%');
        });

        $query->when($filters['name'] ?? false, function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        });

        $query->when($filters['code'] ?? false, function ($query, $code) {
            return $query->where('code', 'like', '%' . $code . '%');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'furniture_material', 'furniture_id', 'material_id');
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'furniture_application', 'furniture_id', 'application_id');
    }

    public function finishings()
    {
        return $this->belongsToMany(Finishing::class, 'furniture_finishing', 'furniture_id', 'finishing_id');
    }

    public function stock_ins()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stock_outs()
    {
        return $this->hasMany(StockOut::class);
    }

    public function furniture_images()
    {
        return $this->hasMany(FurnitureImage::class);
    }
}
