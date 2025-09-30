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
        Schema::create('resources_renewal', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("userDelivery");
            $table->unsignedBigInteger("user");
            $table->unsignedBigInteger("resources");


            $table->foreign("userDelivery")->references("id")->on("users");
            $table->foreign("user")->references("id")->on("users");
            $table->foreign("resources")->references("id")->on("resources");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_renewal');
    }
};
