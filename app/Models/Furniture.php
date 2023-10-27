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
        // $query->when($filters['category'] ?? false, function ($query, $category) {
        //     $query->where('tag', 'like', '%' . $category . '%');
        // });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        });

        $query->when($filters['material'] ?? false, function ($query, $material) {
            return $query->whereHas('materials', function ($query) use ($material) {
                $query->where('name', $material);
            });
        });

        $query->when($filters['finishing'] ?? false, function ($query, $finishing) {
            return $query->whereHas('finishings', function ($query) use ($finishing) {
                $query->where('name', $finishing);
            });
        });

        $query->when($filters['application'] ?? false, function ($query, $application) {
            return $query->whereHas('applications', function ($query) use ($application) {
                $query->where('name', $application);
            });
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')->orWhere('code', 'like', '%' . $search . '%');
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

    public function furniture_images()
    {
        return $this->hasMany(FurnitureImage::class);
    }

    public function stock_in_select()
    {
        return $this->hasOne(StockInSelect::class);
    }

    public function stock_out_select()
    {
        return $this->hasOne(StockOutSelect::class);
    }
}
