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
        Schema::create('rrhh_topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center_id");
            $table->unsignedBigInteger("user_affected");
            $table->string("description", 255);
            $table->unsignedBigInteger("user_register");
            $table->unsignedBigInteger("derivative");
            $table->boolean("is_active")->default(true);

            $table->timestamps();

            $table->foreign("center_id")->references("id")->on("centers");
            $table->foreign("user_affected")->references("id")->on("users");
            $table->foreign("user_register")->references("id")->on("users");
            $table->foreign("derivative")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rrhh_topic');
    }
};
