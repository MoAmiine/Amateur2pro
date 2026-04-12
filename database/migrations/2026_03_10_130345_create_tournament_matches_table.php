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
    Schema::create('matches', function (Blueprint $table) {
        $table->id();

        $table->foreignId('tournament_id')
            ->constrained();

        $table->foreignId('team1_id')
            ->constrained('teams');

        $table->foreignId('team2_id')
            ->constrained('teams');

        $table->integer('score1')->nullable();
        $table->integer('score2')->nullable();

        $table->foreignId('winner_id')
            ->nullable()
            ->constrained('teams');

        $table->integer('round');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_matches');
    }
};
