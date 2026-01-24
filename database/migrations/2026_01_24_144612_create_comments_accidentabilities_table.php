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
        Schema::create('comments_accidentabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("accidentabilitie");
            $table->timestamps();
            $table->unsignedBigInteger("user");
            $table->string("description");

            $table->foreign("accidentabilitie")->references("id")->on("accidentabilites");
            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_accidentabilities');
    }
};
