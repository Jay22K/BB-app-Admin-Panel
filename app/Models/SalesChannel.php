<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $status
 * @property string $type
 */
class SalesChannel extends Model
{
    use HasFactory;
    protected $table = 'sales_channels';
    protected $fillable = [];
    protected $gurded = [];
}
