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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center");
            $table->string("name");
            $table->date("start")->nullable();
            $table->unsignedBigInteger("user");

            $table->text("description");
            $table->text("observations");
            $table->boolean("is_active", 9)->default(true);

            $table->string("type", 255);

            $table->timestamps();

            $table->foreign("user")->references("id")->on("users");
            $table->foreign("center")->references("id")->on("centers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
