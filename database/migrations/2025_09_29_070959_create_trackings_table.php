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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("register");
            $table->string("topic");
            $table->string("comments");
            $table->unsignedBigInteger("user");
            $table->boolean("open");

            $table->timestamp("origin")->nullable();
            $table->timestamp("end_link")->nullable();

            $table->timestamps();

            $table->foreign("register")->references("id")->on("users");
            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
