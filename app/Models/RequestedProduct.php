<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getProductImageAttribute($value)
    {
        return asset($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
