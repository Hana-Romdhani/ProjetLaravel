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
        Schema::create('plantes', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('nom'); // Common name of the plant
            $table->string('nom_scientifique')->nullable(); // Scientific name
            $table->text('description')->nullable(); // Detailed description
            $table->string('image_url')->nullable(); // Image URL
            $table->string('famille')->nullable(); // Plant family
            $table->string('origine')->nullable(); // Origin or native region
            $table->foreignId('categorie_plante_id')->constrained('categorie_plantes')->onDelete('cascade'); // Foreign key to categorie_plantes
            $table->string('type')->nullable(); // Type (e.g., annual, perennial)
            $table->string('exposition')->nullable(); // Sunlight requirements
            $table->string('arrosage')->nullable(); // Watering needs
            $table->string('type_sol')->nullable(); // Preferred soil type
            $table->string('periode_plantation')->nullable(); // Planting period
            $table->string('periode_floraison')->nullable(); // Flowering period
            $table->integer('hauteur_max')->nullable(); // Max height in cm
            $table->integer('largeur_max')->nullable(); // Max width in cm
            $table->string('croissance')->nullable(); // Growth rate
            $table->text('besoins_speciaux')->nullable(); // Special needs
            $table->text('utilisations')->nullable(); // Uses
            $table->text('conseils_entretien')->nullable(); // Care tips
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantes');
    }
};
