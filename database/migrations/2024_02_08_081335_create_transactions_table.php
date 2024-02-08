<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tourist_site_facilities_id')->index();
            $table->bigInteger('tickets_id')->index();
            $table->bigInteger('coupons_id')->index()->nullable();
            $table->bigInteger('customers_id')->index();
            $table->bigInteger('tour_guides_id')->index()->nullable();
            $table->bigInteger('staffs_id')->index()->nullable();
            $table->string('proof_of_payment');
            $table->date('checkout_date');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->integer('total_pay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
