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
        Schema::create('external_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center");
            $table->string("name");
            $table->integer("phone")->nullable();
            $table->string("mail");
            $table->string("observations");
            $table->timestamps();

            $table->foreign("center")->references("id")->on("centers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_contact');
    }
};
