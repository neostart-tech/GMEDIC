<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->engine = 'MyISAM'; 

            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('etablissement')->nullable();
            $table->string('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('telephone');
            $table->text('notes_livraison')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adresses');
    }
};
