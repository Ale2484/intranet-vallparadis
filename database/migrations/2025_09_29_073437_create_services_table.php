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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center");
            $table->string("type");
            $table->timestamps("start");
            $table->unsignedBigInteger("external_contact");
            $table->string("observations");
            $table->string("doc");
            $table->timestamps();

            $table->foreign("center")->references("id")->on("center");
            $table->foreign("external_contact")->references("id")->on("external_contact");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
