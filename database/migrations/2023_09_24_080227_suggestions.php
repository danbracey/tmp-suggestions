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
        Schema::create('suggestions', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->string('long_description');
            $table->integer('created_by')->nullable();
            $table->integer('status')->default(0); //Default to 0, new suggestions
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('suggestions');
    }
};
