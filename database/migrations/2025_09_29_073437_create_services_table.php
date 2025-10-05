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
            $table->timestamp("start")->nullable();
            $table->unsignedBigInteger("external_contact");
            $table->string("observations");
            $table->string("doc");

            // created_at y updated_at
            $table->timestamps();

            // Claves foráneas (ajusta nombres de tabla según tu proyecto real)
            $table->foreign("center")->references("id")->on("centers");
            $table->foreign("external_contact")->references("id")->on("external_contacts");
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
