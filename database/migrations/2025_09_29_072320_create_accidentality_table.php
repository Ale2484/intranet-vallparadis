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
        Schema::create('accidentality', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("low");
            $table->timestamp("start")->nullable();
            $table->timestamp("end")->nullable();
            $table->string("context", 255);
            $table->string("description", 255);
            $table->unsignedBigInteger("evaluate");
            $table->string("type", 255);

            $table->timestamps();

            $table->foreign("low")->references("id")->on("users");
            $table->foreign("evaluate")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidentality');
    }
};
