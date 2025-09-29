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
        Schema::create('docs_management', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("center");
            $table->string("type");
            $table->string("description");
            $table->unsignedBigInteger("user");
            $table->string("doc");


            $table->foreign("user")->references("id")->on("user");
            $table->foreign("center")->references("id")->on("center");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_management');
    }
};
