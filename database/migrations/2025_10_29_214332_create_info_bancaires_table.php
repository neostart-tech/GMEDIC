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
        Schema::create('info_bancaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_banque');
            $table->string('titulaire_compte');
            $table->string('numero_compte');
            $table->string('code_iban')->nullable();
            $table->string('code_bic')->nullable();
            $table->text('instructions')->nullable();
            $table->decimal('montant_minimum', 10, 2)->default(0);
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_bancaires');
    }
};
