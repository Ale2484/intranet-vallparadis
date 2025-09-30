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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->integer("key");
            $table->unsignedBigInteger("user");
            $table->enum("shirt",["XS","S", "M", "L", "XL", "XXL"]);
            $table->enum("pants",["XS","S", "M", "L", "XL", "XXL"]);
            $table->decimal('shoe', 3, 2);
            $table->timestamps();

            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
