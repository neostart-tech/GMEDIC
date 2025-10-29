<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moyen_payements', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->id();
            
            $table->unsignedBigInteger('commande_id');
            $table->enum('methode', ['carte_bancaire', 'virement_bancaire', 'cheque']);
            $table->decimal('montant', 15, 2)->nullable();
            $table->enum('statut', ['en_attente', 'payé', 'échoué'])->default('en_attente');
            $table->timestamp('date_paiement')->nullable();
            $table->timestamp('date_encaissement')->nullable();

            $table->string('numero_carte')->nullable();
            $table->string('titulaire_carte')->nullable();
            $table->string('date_expiration')->nullable();
            $table->string('cvv')->nullable();

            $table->unsignedBigInteger('info_bancaire_id')->nullable();
            $table->string('reference_paiement')->nullable();
            $table->string('banque')->nullable();

            $table->string('numero_cheque')->nullable();

            $table->string('preuve_paiement')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moyen_payements');
    }
};
