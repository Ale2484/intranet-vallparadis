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
        Schema::create('uniformities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_delivery");
            $table->unsignedBigInteger("user");

            $table->enum("shirt",["XS","S", "M", "L", "XL", "XXL"]);
            $table->enum("pants",["XS","S", "M", "L", "XL", "XXL"]);
            $table->decimal('shoes', 3, 1);

            $table->foreign("user_delivery")->references("id")->on("users");
            $table->foreign("user")->references("id")->on("users");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_renewal');
    }
};
