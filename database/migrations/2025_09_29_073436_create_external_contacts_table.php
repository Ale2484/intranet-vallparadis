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
        Schema::create('external_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("center_id");
            $table->enum("category", ["assistencial ", "serveis generals"]);
            $table->string("reason")->nullable();
            $table->string("company_or_department");
            $table->string("contact_person");
            $table->string("phone")->nullable();
            $table->string("email");
            $table->boolean("is_active")->default(true);
            $table->text("observations")->nullable();
            $table->timestamps();

            $table->foreign("center_id")->references("id")->on("centers");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_contacts');
    }
};
