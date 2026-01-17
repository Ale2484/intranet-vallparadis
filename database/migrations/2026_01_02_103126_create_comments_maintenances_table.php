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
        Schema::create('comments_maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("maintenance");
            $table->timestamps();
            $table->unsignedBigInteger("user");
            $table->string("description");

            $table->foreign("maintenance")->references("id")->on("monitorings_maintenances");
            $table->foreign("user")->references("id")->on("users");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_maintenances');
    }
};
