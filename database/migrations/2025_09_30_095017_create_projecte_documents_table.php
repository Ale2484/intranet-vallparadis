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
        Schema::create('projecte_documents', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("project");
            $table->string("path");
            $table->timestamps();

            $table->foreign("project")->references("id")->on("projects");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
