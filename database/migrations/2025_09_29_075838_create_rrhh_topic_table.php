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
        Schema::create('rrhh_topic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center");
            $table->timestamps("opening");
            $table->unsignedBigInteger("user_affected");
            $table->string("description", 255);
            $table->unsignedBigInteger("user_register");
            $table->string("derivative", 255);
            $table->string("docs", 255);
            $table->timestamps();

            $table->foreign("center")->references("id")->on("center");
            $table->foreign("user")->references("id")->on("user_affected");
            $table->foreign("user")->references("id")->on("user_register");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rrhh_topic');
    }
};
