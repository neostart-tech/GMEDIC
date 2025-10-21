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
        // Schema::table('categories', fn (Blueprint $table) => $table->string('slug'));
        // Schema::table('blogs', fn (Blueprint $table) => $table->string('slug'));
        // Schema::table('articles', fn (Blueprint $table) => $table->string('slug'));
        // Schema::table('messages', fn (Blueprint $table) => $table->string('slug'));
        // Schema::table('sliders', fn (Blueprint $table) => $table->string('slug'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('blogs', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('articles', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('messages', fn (Blueprint $table) => $table->dropColumn('slug'));
        Schema::table('sliders', fn (Blueprint $table) => $table->dropColumn('slug'));
    }
};
