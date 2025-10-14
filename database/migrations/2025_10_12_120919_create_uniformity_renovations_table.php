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
        Schema::create('uniformity_renovations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("uniformity_id");
            $table->date("renewal_date");
            $table->unsignedBigInteger("delivered_by");
            $table->string("file");
            $table->timestamps();

            $table->foreign("uniformity_id")->references("id")->on("uniformities");
            $table->foreign("delivered_by")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uniformity_renovations');
    }
};
