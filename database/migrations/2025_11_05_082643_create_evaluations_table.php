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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user");
            $table->unsignedBigInteger("evaluator");
            $table->text("comment");

            $table->enum("p1",["0","1","2","3"]);
            $table->enum("p2",["0","1","2","3"]);
            $table->enum("p3",["0","1","2","3"]);
            $table->enum("p4",["0","1","2","3"]);
            $table->enum("p5",["0","1","2","3"]);
            $table->enum("p6",["0","1","2","3"]);
            $table->enum("p7",["0","1","2","3"]);
            $table->enum("p8",["0","1","2","3"]);
            $table->enum("p9",["0","1","2","3"]);
            $table->enum("p10",["0","1","2","3"]);
            $table->enum("p11",["0","1","2","3"]);
            $table->enum("p12",["0","1","2","3"]);
            $table->enum("p13",["0","1","2","3"]);
            $table->enum("p14",["0","1","2","3"]);
            $table->enum("p15",["0","1","2","3"]);
            $table->enum("p16",["0","1","2","3"]);
            $table->enum("p17",["0","1","2","3"]);
            $table->enum("p18",["0","1","2","3"]);
            $table->enum("p19",["0","1","2","3"]);
            $table->enum("p20",["0","1","2","3"]);

            $table->timestamps();

            $table->foreign("user")->references("id")->on("users");
            $table->foreign("evaluator")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
