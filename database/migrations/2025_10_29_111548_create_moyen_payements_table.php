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
        Schema::create('moyen_payements', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->id();
            $table->unsignedBigInteger('commande_id');
            $table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade');
            $table->enum('methode', ['carte_bancaire', 'virement_bancaire', 'cheque']);
            $table->string('numero_carte')->nullable();
            $table->string('date_expiration')->nullable();
            $table->string('titulaire_carte')->nullable();
            $table->string('cvv')->nullable();
            $table->enum('statut', ['en_attente', 'payé', 'échoué'])->default('en_attente');
            $table->timestamp('date_paiement')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moyen_payements');
    }
};
