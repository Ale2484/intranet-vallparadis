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
            $table->unsignedBigInteger("center_Id");
            $table->string("type");
            // $table->date("start_date");
            $table->string("manager_name");
            $table->string("manager_email");
            $table->string("manager_phone")->nullable();
            $table->text("schedules")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();

            $table->foreign("center_id")->references("id")->on("centers");
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
