<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $product_id
 * @property int $variant_id
 * @property int $seles_channel
 * @property double $price 
 */
class ProductPrice extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
}
