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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center_id");
            $table->string("codiForcem");
            $table->decimal("hours", 3, 1);
            $table->string("type");
            $table->string("modality");
            $table->string("name");
            $table->boolean("is_active")->default(true);
            
            $table->date("start_date");
            $table->date("end_date");

            $table->timestamps();

            $table->foreign("center_id")->references("id")->on("centers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
