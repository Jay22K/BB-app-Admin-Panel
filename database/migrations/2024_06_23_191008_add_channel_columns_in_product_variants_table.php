<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChannelColumnsInProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->float('freezer_cost')->default(0);
            $table->float('secondry_trp')->default(0);
            $table->float('company_margin')->default(0);
            $table->float('total_freezer_trp_margin')->default(0);
            $table->float('distributor_franchise_rate')->default(0);
            $table->float('e_commerce_rate')->default(0);
            $table->float('subdistributor_outlet_rate')->default(0);
            $table->float('horika_cantin_rate')->default(0);
            $table->float('gt_market_retailer_vikreta_rate')->default(0);
            $table->float('pick_up_the_franchiser_point_rate')->default(0);
            $table->float('consumer_home_delivery_customer_price')->default(0);
            $table->float('total_distributor_franchise_rate')->default(0);
            $table->float('total_e_commerce_rate')->default(0);
            $table->float('total_subdistributor_outlet_rate')->default(0);
            $table->float('total_horika_cantin_rate')->default(0);
            $table->float('total_gt_market_retailer_vikreta_rate')->default(0);
            $table->float('total_pick_up_the_franchiser_point_rate')->default(0);
            $table->float('total_consumer_home_delivery_customer_price')->default(0);
            $table->float('mrp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->removeColumn('freezer_cost');
            $table->removeColumn('secondry_trp');
            $table->removeColumn('company_margin');
            $table->removeColumn('total_freezer_trp_margin');
            $table->removeColumn('distributor_franchise_rate');
            $table->removeColumn('e_commerce_rate');
            $table->removeColumn('subdistributor_outlet_rate');
            $table->removeColumn('horika_cantin_rate');
            $table->removeColumn('gt_market_retailer_vikreta_rate');
            $table->removeColumn('pick_up_the_franchiser_point_rate');
            $table->removeColumn('consumer_home_delivery_customer_price');
            $table->removeColumn('total_distributor_franchise_rate');
            $table->removeColumn('total_e_commerce_rate');
            $table->removeColumn('total_subdistributor_outlet_rate');
            $table->removeColumn('total_horika_cantin_rate');
            $table->removeColumn('total_gt_market_retailer_vikreta_rate');
            $table->removeColumn('total_pick_up_the_franchiser_point_rate');
            $table->removeColumn('total_consumer_home_delivery_customer_price');
            $table->removeColumn('mrp');
        });
    }
}
