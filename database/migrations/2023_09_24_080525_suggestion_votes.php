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
        Schema::create('suggestion_votes', static function (Blueprint $table) {
            $table->id();
            $table->integer('suggestion_id');
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->integer('vote');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('suggestion_votes');
    }
};
