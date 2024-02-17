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
        Schema::create('tour_guides', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->index();
            $table->string('languages_id')->index()->nullable();
            $table->string('name', 255);
            $table->string('phone_number', 13);
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_guides');
    }
};
