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
        Schema::create('tracking__issues_rrhh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("issue");
            $table->timestamps();
            $table->unsignedBigInteger("user");
            $table->string("description");
            $table->string("docs");

            $table->foreign("rrhh_topic")->references("id")->on("issue");
            $table->foreign("user")->references("id")->on("user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking__issues_rrhh');
    }
};
