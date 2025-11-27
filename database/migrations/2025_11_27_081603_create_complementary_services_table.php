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
        Schema::create('complementary_services', function (Blueprint $table) {
            $table->id();
            $table->string("type");
            $table->date("start_date");
            $table->date("end_date");
            $table->string("manager_name");
            $table->string("manager_phone")->nullable();
            $table->string("manager_email");
            $table->text("staff_and_schedules")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complementary_services');
    }
};
