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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id')->index();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 100);
            $table->string('image');
            $table->string('phone_number', 13);
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
