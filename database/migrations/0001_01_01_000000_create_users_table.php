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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string("phone", 9)->nullable();
            // technical team --> equipo tecnico / magnament team --> equipo directivo / administration --> Administracion / professional --> usuario normal
            $table->enum("role",["technical_team","management_team", "administration", "professional"])->default("professional");
            $table->unsignedBigInteger("center");
            $table->enum("status", ["active", "inactive", "substitute"]);
            //$table->string("cv", 255);
            
            $table->integer("locker");
            $table->string("locker_password");

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // FK
            $table->foreign("center")->references("id")->on("centers");
            $table->boolean("is_active", 9)->default(true);

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
