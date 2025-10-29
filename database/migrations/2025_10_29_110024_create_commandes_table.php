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
        Schema::create('commandes', function (Blueprint $table) {
                        $table->engine = 'MyISAM'; 

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('adresse_id');
            $table->foreign('adresse_id')->references('id')->on('adresses')->onDelete('cascade');
            $table->dateTime('date_commande')->useCurrent();
            $table->enum('statut', ['en_attente', 'livrée', 'annulée'])->default('en_attente');
            $table->decimal('total', 10, 2);
            $table->text('commentaires')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
