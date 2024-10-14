<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $user_id
 * @property string $outlet_name
 * @property string $legal_name
 * @property string $business_person_name
 * @property string $business_phone_number
 * @property string $delivery_address
 * @property string $city
 * @property string $pincode
 * @property string $state
 * @property string $preferred_delivery_time
 * @property string $pan_number
 * @property string $pan_card_image
 * @property string $gst_certificate_image
 * @property string $fssai_number
 * @property string $fssai_certificate_image
 * @property string $monthly_turnover
 */
class B2BDetail extends Model
{
    use HasFactory;

    protected $table = 'b2b_details';
    protected $fillable = [];
    protected $guarded = [];

    public function getFssaiCertificateImageAttribute($value)
    {
        return asset($value);
    }
    public function getPanCardImageAttribute($value)
    {
        return asset($value);
    }
    public function getGstCertificateImageAttribute($value)
    {
        return asset($value);
    }
}
