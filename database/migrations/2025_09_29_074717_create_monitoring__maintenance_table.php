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
        Schema::create('monitoring__maintenance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("maintenance");
            $table->timestamps();
            $table->unsignedBigInteger("user");
            $table->string("description", 255);
            $table->string("doc");

            $table->foreign("maintenance")->references("id")->on("maintenance");
            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring__maintenance');
    }
};
