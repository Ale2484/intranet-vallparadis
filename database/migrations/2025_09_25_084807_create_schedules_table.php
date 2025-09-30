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
            $table->unsignedBigInteger('center');
            $table->integer('hours');
            $table->string('type');
            $table->string('in_person'); 
            $table->string('name');
            $table->string('assistant');
            $table->timestamp('start')->nullable(); 
            $table->timestamp('end')->nullable();   
            $table->boolean('certificate');
            $table->unsignedBigInteger('course');
            $table->timestamps();

            $table->foreign("course")->references("id")->on("courses");
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
