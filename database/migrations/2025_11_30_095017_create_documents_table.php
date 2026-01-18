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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->enum("type", ['Organitzacio_del_Centre', 'Documents_del_Departament', 'Memories_i_Seguiment_anual', 'PRL', 'Comite_d_Empresa', 'Informes_professionals', 'Informes_persones_usuaries', 'Qualitat_i_ISO', 'Projectes', 'Comissions', 'Families', 'Comunicacio_i_Reunions', 'Altres'])->nullable();
            $table->string("description")->nullable();
            $table->string("path");
            
            $table->unsignedBigInteger("user")->nullable();

            $table->morphs("documentstable");
            
            $table->timestamps();
            
            $table->foreign("user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
