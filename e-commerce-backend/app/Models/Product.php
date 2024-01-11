<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'category_id',
        'brand_id',
        'supplier_id',
        'qty',
        'buy_price',
        'sale_price',
        'discount_price',
        'view_count',
        'like_count',
        'description',
    ];

    protected $appends = ["image_url"];

    public function getImageUrlAttribute()
    {
        return asset("/storage/products/" . $this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, "product_colors");
    }
}
