<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->date('date');
            $table->string('image');
            $table->unsignedBigInteger('classification_id'); // Define the classification_id column
               // Ajouter la colonne admin_user_id
            $table->unsignedBigInteger('admin_user_id');
            // Add foreign key constraint
            
            $table->foreign('classification_id')
                ->references('id')
                ->on('classifications')
                ->onDelete('cascade')
                ->onUpdate('cascade');

                 // Clé étrangère pour user
            $table->foreign('admin_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Si l'utilisateur est supprimé, la valeur est définie à null

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('evenements', function (Blueprint $table) {
            $table->dropForeign(['classification_id']);
            $table->dropIndex(['classification_id']);
            $table->dropForeign(['admin_user_id']);
            $table->dropIndex(['admin_user_id']);
        });
        Schema::dropIfExists('evenements');
    }
}