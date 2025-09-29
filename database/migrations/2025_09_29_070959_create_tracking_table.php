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
        Schema::create('tracking', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("register");
            $table->string("topic");
            $table->string("comments");
            $table->unsignedBigInteger("user");
            $table->boolean('open');
            $table->timestamps("origin");
            $table->timestamps("end_link");


            $table->foreign("user")->references("id")->on("register");
            $table->foreign("user")->references("id")->on("user");
            
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
