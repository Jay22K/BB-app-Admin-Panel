<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_id
 * @property string $delivery_address
 * @property string $city
 * @property string $pincode
 * @property string $state
 * @property string $preferred_devivery_time
 */
class B2CDetail extends Model
{
    use HasFactory;

    protected $table = 'b2c_details';
    protected $fillable = [];
    protected $gurded = [];
}
