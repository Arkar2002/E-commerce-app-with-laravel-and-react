<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRemoveTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "description",
        "qty",
        "supplier_id",
        "buy_price",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
