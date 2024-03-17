<?php

use Composer\IO\NullIO;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateB2BDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b2b_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('outlet_name');
            $table->string('legal_name');
            $table->string('business_person_name');
            $table->string('business_phone_number');
            $table->text('delivery_address')->nullable();
            $table->string('city', 255);
            $table->string('pincode', 10);
            $table->string('state', 255);
            $table->string('prefered_devivery_time', 20)->nullable();
            $table->string('pan_number', 10);
            $table->string('pan_card_image');
            $table->string('gst_certificate_image', 255);
            $table->string('fssai_number', 20)->nullable();
            $table->string('fssai_certificate_image', 255)->nullable();
            $table->double('monthly_turnover')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b2b_details');
    }
}
