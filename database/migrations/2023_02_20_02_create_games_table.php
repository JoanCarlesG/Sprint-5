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
            $table->unsignedBigInteger('player1_id');
            $table->unsignedBigInteger('player2_id');
            $table->enum('player1_throw1', ['1', '2', '3', '4', '5', '6']);
            $table->enum('player1_throw2', ['1', '2', '3', '4', '5', '6']);
            $table->enum('player2_throw1', ['1', '2', '3', '4', '5', '6']);
            $table->enum('player2_throw2', ['1', '2', '3', '4', '5', '6']);
            $table->enum('win', ['0', '1', '2']);
            
            $table->foreign('player1_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('player2_id')->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

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
