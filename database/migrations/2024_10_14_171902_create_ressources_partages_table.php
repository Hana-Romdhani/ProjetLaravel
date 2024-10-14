<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ressources_partages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_emprunteur_id')->constrained('users'); // emprunteur
            $table->foreignId('user_preteur_id')->constrained('users'); // prêteur
            $table->foreignId('ressource_id')->constrained('ressources'); // id de la ressource partagée
            $table->integer('quantite'); // quantité partagée
            $table->date('date_partage'); // date de partage
            $table->enum('statut', ['en attente', 'accepté', 'refusé'])->default('en attente'); // statut du partage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ressources_partages');
    }
};
