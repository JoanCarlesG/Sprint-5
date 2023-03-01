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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('player_id');
            $table->enum('throw1', ['1', '2', '3', '4', '5', '6'])->nullable();
            $table->enum('throw2', ['1', '2', '3', '4', '5', '6'])->nullable();
            $table->enum('win', ['1', '2'])->nullable();
            
            $table->foreign('player_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
