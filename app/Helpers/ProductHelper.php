<?php

namespace App\Helpers;

use App\AssessmentDetail;
use App\AssessmentDetailUser;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductVariant;
use App\Permission;
use App\Role;
use App\StudentDetails;
use App\Tenant;
use App\Todo;
use App\TodoAccess;
use App\TodoTask;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use App\Yoyaku;
use App\Settings;
use App\Students;
use App\Schedules;
use Carbon\Carbon;
use App\ClassUsage;
use App\Attendances;
use App\ClassesOffDays;
use App\Helpers\ScheduleHelper;
use App\Jobs\SendMail;
use App\NumberOfLesson;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Response;

class ProductHelper
{

    public static function isItemAvailable($product_id, $product_variant_id)
    {

        $variant = ProductVariant::where('product_id', $product_id)->where('id', $product_variant_id)->first();
        if ($variant) {
            $product = Product::where('id', $product_id)->where('status', 1)->first();
            return !empty($product);
        } else {
            return false;
        }
    }

    public static function isItemAvailableInUserCart($user_id, $product_variant_id = "")
    {
        $cart = Cart::where('user_id', $user_id);
        if ($product_variant_id != '') {
            $cart->where('product_variant_id', $product_variant_id);
        }
        return $cart->exists();
    }

    public static function getOldTaxableAmount($product_variant_id)
    {
        /*$sql = "SELECT pv.id,pv.discounted_price,t.percentage,pv.price,
                CASE when pv.discounted_price !=0
                    THEN pv.discounted_price+(pv.discounted_price*t.percentage)/100
                    ELSE pv.price+(pv.price*t.percentage)/100 END as taxable_amount
                from product_variant pv left JOIN products p on pv.product_id=p.id LEFT JOIN taxes t on t.id=p.tax_id where pv.id=$product_variant_id";*/

        $sql = "SELECT pv.id,pv.discounted_price,t.percentage,pv.price,
        CASE when pv.discounted_price !=0 THEN pv.discounted_price+(pv.discounted_price*t.percentage)/100
                                        ELSE pv.price+(pv.price*t.percentage)/100 END as taxable_amount,

        CASE when pv.discounted_price !=0 THEN pv.discounted_price+(pv.discounted_price*t.percentage)/100
                                        ELSE pv.discounted_price END as taxable_discounted_price,
        CASE when pv.price !=0 THEN pv.price+(pv.price*t.percentage)/100
                                        ELSE pv.price END as taxable_price
        from product_variants pv left JOIN products p on pv.product_id=p.id LEFT JOIN taxes t on t.id=p.tax_id where pv.id=$product_variant_id";

        $result = DB::select(DB::raw($sql));

        $result = !empty($result) ? $result[0] : array();

        //$result = $result[0];

        /*$result->discounted_price = floatval($result->discounted_price);
        $result->percentage = floatval($result->percentage);
        $result->price = floatval($result->price);
        $result->taxable_amount = floatval($result->taxable_amount);
        $result->taxable_discounted_price = floatval($result->taxable_discounted_price);
        $result->taxable_price = floatval($result->taxable_price);*/

        if (empty($result->percentage) && $result->discounted_price != 0) {
            $result->taxable_amount = $result->discounted_price;
        } else if (empty($result->percentage && $result->price != 0)) {
            $result->taxable_amount = $result->price;
        } else if (!(empty($result->percentage)) && $result->discounted_price != 0) {
            $result->taxable_amount = $result->discounted_price + $result->discounted_price * ($result->percentage / 100);
        } else if (!(empty($result->percentage)) && $result->price != 0) {
            $result->taxable_amount = $result->price + $result->price * ($result->percentage / 100);
        }

        // dd($result->taxable_price, gettype($result->taxable_price), $result->taxable_discounted_price, gettype($result->taxable_discounted_price), $result->taxable_amount, gettype($result->taxable_amount), $result->price, gettype($result->price), $result->percentage, gettype($result->percentage), $result->discounted_price, gettype($result->discounted_price));

        return $result;


        /*$sql = "SELECT pv.id,pv.discounted_price,t.percentage,pv.price, p.tax_included_in_price,
        CASE when pv.discounted_price !=0 THEN pv.discounted_price+(pv.discounted_price*t.percentage)/100
                                        ELSE pv.price+(pv.price*t.percentage)/100 END as taxable_amount
        from product_variants pv left JOIN products p on pv.product_id=p.id LEFT JOIN taxes t on t.id=p.tax_id where pv.id=$product_variant_id";
        $result = DB::select(\DB::raw($sql));

        $result = !empty($result) ? $result[0] : array();
        if ($result->tax_included_in_price == 1 || empty($result->percentage)) {
            $result->taxable_amount = 0;
        }

        $result->percentage = $result->percentage??0;
        $result->taxable_amount = $result->taxable_amount??"";
        //    dd($result);
        return $result;*/
    }

    public static function getTaxableAmount($product_variant_id, ?string  $salesChannelKey = 'discounted_price')
    {
        $sql = "SELECT pv.id,pv.{$salesChannelKey}, pv.{$salesChannelKey} as discounted_price,t.percentage,pv.mrp, pv.mrp as price,
           CASE when pv.{$salesChannelKey} !=0 THEN pv.{$salesChannelKey}+(pv.{$salesChannelKey}*t.percentage)/100
                                           ELSE pv.mrp+(pv.mrp*t.percentage)/100 END as taxable_amount,
           CASE when pv.{$salesChannelKey} !=0 THEN pv.{$salesChannelKey}+(pv.{$salesChannelKey}*t.percentage)/100
                                           ELSE pv.mrp+(pv.mrp*t.percentage)/100 END as taxable_discounted_price,
           CASE when pv.mrp !=0 THEN pv.mrp+(pv.mrp*t.percentage)/100
                                           ELSE pv.mrp END as taxable_price
           from product_variants pv left JOIN products p on pv.product_id=p.id LEFT JOIN taxes t on t.id=p.tax_id where pv.id=$product_variant_id";
        // Log::info($sql);
        $result = DB::select(DB::raw($sql));

        $result = !empty($result) ? $result[0] ?? [] : [];
        $result =  (object)  $result;
        if (!empty($result)) {
            if (empty($result->percentage ?? null) && ($result->{$salesChannelKey} ?? null) != 0) {
                $result->taxable_amount = $result->{$salesChannelKey};
            } else if (empty($result->percentage && $result->mrp != 0)) {
                $result->taxable_amount = $result->mrp;
            } else if (!(empty($result->percentage)) && $result->{$salesChannelKey} != 0) {
                $result->taxable_amount = $result->{$salesChannelKey} + $result->{$salesChannelKey} * ($result->percentage / 100);
            } else if (!(empty($result->percentage)) && $result->mrp != 0) {
                $result->taxable_amount = $result->mrp + $result->mrp * ($result->percentage / 100);
            }
            if (empty($result->taxable_discounted_price))
                $result->taxable_discounted_price = $result->discounted_price;
            if (empty($result->taxable_price))
                $result->taxable_price = $result->taxable_amount;
        } else {
            $result->taxable_discounted_price = 0;
            $result->taxable_price = 0;
            $result->percentage = 0;
            $result->mrp = 0;
            $result->price = 0;
            $result->taxable_amount = 0;
        }
        return $result;
    }
}
