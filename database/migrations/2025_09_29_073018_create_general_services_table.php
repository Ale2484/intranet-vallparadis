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
        Schema::create('general_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center_id");
            $table->string("name");
            //$table->unsignedBigInteger("external_contact");
            $table->enum("type", ["cleaning", "laundry", "cook"]);
            $table->string("manager_name");
            $table->text("description");
            $table->string("manager_email");
            $table->string("manager_phone")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();

            $table->foreign("center_id")->references("id")->on("centers");
            //$table->foreign("external_contact")->references("id")->on("external_contacts");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_services');
    }
};
