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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center");
            // $table->string('forcem', 255); // esto no se lo que es
            $table->integer('hours');
            $table->string('type', 255);
            $table->string('in person', 255);
            $table->string('name', 255);
            $table->string('assistant', 255);
            $table->timestamps("start");
            $table->timestamps("end");
            table->bolean("certificate");
            $table->unsignedBigInteger("course");

            $table->foreign("courses")->references("id")->on("course");
            $table->foreign("center")->references("id")->on("center");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
