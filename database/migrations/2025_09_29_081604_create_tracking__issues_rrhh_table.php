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
        Schema::create('tracking_issues_rrhh', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("issue");
            $table->unsignedBigInteger("user");
            $table->string("description");
            $table->string("docs");

            $table->timestamps();

            $table->foreign("issue")->references("id")->on("rrhh_topic");
            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking_issues_rrhh');
    }
};
